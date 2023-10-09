<?php

namespace App\Http\Controllers;

use App\Models\SecondaryRecords;
use DB;
use Illuminate\Http\Request;
use Validator;

class GoodsIssueController extends Controller
{
    public function generateUniqueID()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueID = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sid = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $sid = $sid . $uniqueID;

        if ($this->sidExists($sid) || $this->transactionCodeExists($sid)) {
            return $this->generateUniqueID();
        }

        return $sid;
    }

    public function sidExists($uid)
    {
        $checkSid = DB::table('secondary_inventory_store')->select('tCode')->where('tCode', '=', $uid)->first();
        if ($checkSid) {
            return $checkSid['tCode'];
        }
        return '';
    }

    public function transactionCodeExists($code)
    {
        $checkCode = DB::table('primaryInventoryStore')->select('tCode')->where('tCode', '=', $code)->first();
        if ($checkCode) {
            return $checkCode['tCode'];
        }
        return '';
    }

    public function store(Request $request)
    {

        $validationMessages = [

            
        ];

        $validator = Validator::make($request->all(), [

            
        ], $validationMessages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->items === null || count($request->items) == 0) {
            return redirect()->back()->with('message', 'Add item to the list.');
        }
        $s_id = $this->generateUniqueID();

        // \DB::table('activity_logs')->insert([
        //     'LogDate' => date('Y-m-d'),
        //     'Activity' => 'Goods Issue  Store',
        //     'userid' => $request->user_id,
        //     'ReferenceNo' => "$s_id",
        //     'AccountingDate' => date('Y-m-d'),
        //     'LogsTime' => date("Y-m-d h:i:sa"),
        // ]);
        $currentTime = now();

        foreach ($request->items as $item) {
            $itemData = explode('{#}', $item);
            $inventoryID = $itemData[0];
            $qty = $itemData[3];
            $instock = $itemData[3] * $itemData[8];
            $unitEqualsTo = $itemData[2];
            $inite_convert_standard = $itemData[8];
            $convert_type = $itemData[9];
            $amount = $itemData[5];
            $vat = $itemData[6];
            $unit_cost_rate = $itemData[4];

            DB::table('secondary_inventory_store')->insert([
                'tCode' => $s_id,
                'inventoryID' => $inventoryID,
                'instock' => $instock,
                'outstock' => 0,
                'cancel' => 0,
                'vat' => $vat,
                'amount' => $amount,
                'unit_cost_rate' => $unit_cost_rate,
                'unitEqualsTo' => $unitEqualsTo,
                'status' => 'issue',
                // 'inite_convert_standard' => $inite_convert_standard,
                // 'convert_type' => $convert_type,
                'unit_cost_rate' => $unit_cost_rate,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);

            DB::table('primaryInventoryStore')->insert([
                'tCode' => $s_id,
                'inventoryID' => $inventoryID,
                'instock' => 0,
                'status' => 'issue',
                'outstock' => $qty,
                'unitEqualsTo' => $unitEqualsTo,
                'unit_cost_rate' => $unit_cost_rate,
                'amount' => $amount,
                'vat' => $vat,
                'cancel' => 0,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
        }

        $totalVat = 0;
        $totalAmount = 0;
        $totalQuantity = 0;

        foreach ($request->items as $item) {
            $itemData = explode('{#}', $item);
            $vat = $itemData[6];
            $qty = $itemData[3];
            $amount = $itemData[7];
            $totalVat += $vat;
            $totalQuantity += $qty;
            $totalAmount += $amount;
        }
        $secondaryStore = new SecondaryRecords();
        $secondaryStore->transactionCode = $s_id;
        $secondaryStore->project_id = $request->project_id;
        $secondaryStore->date = $request->date;
        $secondaryStore->demand_sheet_number = $request->demand_sheet;
        $secondaryStore->userId = $request->user_id;
        $secondaryStore->vat = $totalVat;
        $secondaryStore->quantity = $totalQuantity;
        $secondaryStore->discount = 0;
        $secondaryStore->cancel = 0;
        $secondaryStore->status = 'issue';
        $secondaryStore->gtotal = $totalAmount;
        $secondaryStore->save();
        return redirect('/goodsissue')->with('message', 'Your data has been added successfully');
    }

    public function index(Request $request)
    {
        {
            $query = DB::table('secondary_records')
                ->join('projects', 'secondary_records.project_id', '=', 'projects.id')
                ->select('secondary_records.*','projects.project_name')
                ->where('secondary_records.cancel', 0)
                ->where('secondary_records.status', 'issue')
                ->orderBY('id', 'DESC');
            if ($request->filled('from') && $request->filled('to')) {
                $from = $request->input('from');
                $to = $request->input('to');

                $query->whereBetween('secondary_records.date', [$from, $to]);
            }
            if ($request->filled('project_name')) {
                $project_name = $request->input('project_name');
                $query->where('projects.project_name', 'like', '%' . $project_name . '%');
            }
            $list = $query->paginate(10);

            return view('frontend.inventory.goodsissue.list', compact('list'));
        }
    }

    public function edit($tCode, Request $request)
    {
        $list = DB::table('secondary_inventory_store')
            ->join('item_settings', 'item_settings.id', '=', 'secondary_inventory_store.inventoryID')
            ->select('secondary_inventory_store.*', 'item_settings.*')
            ->where('secondary_inventory_store.tCode', $tCode)
            ->get();
        $goodsIssue = DB::table('secondary_records')
            ->join('projects', 'secondary_records.project_id', '=', 'projects.id')
            ->select('secondary_records.*','projects.project_name')
            ->where('secondary_records.transactionCode', $tCode)
            ->first();
        return view('inventory.goodsissue.edit', compact('goodsIssue', 'list'));

    }

    public function forModal($tCode)
    {
        $list = DB::table('secondary_inventory_store')

            ->join('item_settings', 'item_settings.id', '=', 'secondary_inventory_store.inventoryID')
            ->select('secondary_inventory_store.*', 'item_settings.*')
            ->where('secondary_inventory_store.tCode', $tCode)
            ->get();

        $goodsReceived = DB::table('secondary_records')
            ->join('projects', 'secondary_records.project_id', '=', 'projects.id')
            ->select('secondary_records.*', 'projects.project_name')
            ->where('secondary_records.transactionCode', $tCode)
            ->first();

        return response()->json([
            'goodsReceived' => $goodsReceived,
            'list' => $list,
        ]);
    }
    public function update(Request $request, $tCode)
    {
        \DB::table('activity_logs')->insert([
            'LogDate' => date('Y-m-d'),
            'Activity' => 'Goods Issue  Cancel',
            'userid' => $request->user_id,
            'ReferenceNo' => "$tCode",
            'AccountingDate' => date('Y-m-d'),
            'LogsTime' => date("Y-m-d h:i:sa"),
        ]);
        $secondaryStore = DB::table('secondary_inventory_store')->where('tCode', $tCode)->first();
        if (!$secondaryStore) {
            return redirect()->back()->with('message', 'Tcode not found in the secondary inventory Store');
        }
        DB::table('secondary_inventory_store')
            ->where('tCode', $tCode)
            ->update([
                'cancel' => '1',
            ]);
        $primaryStore = DB::table('primaryInventoryStore')->where('tCode', $tCode)->first();
        if (!$primaryStore) {
            return redirect()->back()->with('message', 'Tcode not found in the primary inventory Store');
        }
        DB::table('primaryInventoryStore')
            ->where('tCode', $tCode)
            ->update([
                'cancel' => '1',
            ]);
        $secondaryRecords = DB::table('secondary_records')->where('transactionCode', $tCode)->first();
        if (!$secondaryRecords) {
            return redirect()->back()->with('message', 'Tcode not found in the Secondary Records');
        }
        DB::table('secondary_records')
            ->where('transactionCode', $tCode)
            ->update([
                'cancel' => '1',
                'cancelation_note' => $request->cancellation_reason,
            ]);
        return redirect('/goodsissue')->with('message', 'Your data has been updated successfully');
    }

    public function destroy(Request $request)
    {

        $tCode = $request->tCode;
        $goodsIssue = DB::table('secondary_inventory_store')->where('tCode', $tCode)->first();
        if (!$goodsIssue) {
            return redirect('/goodissue')->with('message', 'Goods received not found');
        }
        DB::table('secondary_inventory_store')->where('tCode', $tCode)->delete();
        $goodsIssue = DB::table('primaryInventoryStore')->where('tCode', $tCode)->first();
        if (!$goodsIssue) {
            return redirect('/goodissue')->with('message', 'Goods received not found');
        }
        DB::table('primaryInventoryStore')->where('tCode', $tCode)->delete();

        return redirect('/goodissue')->with('message', 'Your data has been deleted successfully');
    }

}
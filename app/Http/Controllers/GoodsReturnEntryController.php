<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceived;
use App\Models\PurchaseRecordReturn;
use DB;
use Validator;
use Illuminate\Http\Request;

class GoodsReturnEntryController extends Controller
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
        $checkSid = GoodsReceived::select('tCode')->where('tCode', '=', $uid)->first();
        if ($checkSid) {
            return $checkSid['tCode'];
        }
        return '';
    }

    public function transactionCodeExists($code)
    {
        $checkCode = PurchaseRecordReturn::select('transactionCode')->where('transactionCode', '=', $code)->first();
        if ($checkCode) {
            return $checkCode['transactionCode'];
        }
        return '';
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validationMessages = [
            'project_id.required' => 'Please select the Project.',
            
        ];
    
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            
        ], $validationMessages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->items === null || count($request->items) == 0) {
            return redirect()->back()->with('message', 'Add item to the list.');
        }

       

        $s_id = $this->generateUniqueID();
        // \DB::table('activity_logs')->insert([
        //     'LogDate' =>  date('Y-m-d'),
        //     'Activity' =>  'Goods Return ',
        //     'userid' => $request->user_id,
        //     'ReferenceNo' => "$s_id",
        //     'AccountingDate' =>   date('Y-m-d'),
        //     'LogsTime' => date("Y-m-d h:i:sa"),
        // ]);
        foreach ($request->items as $item) {
            $itemData = explode('{#}', $item);
            $goodsReceived = new GoodsReceived();
            $goodsReceived->tCode = $s_id;
            $goodsReceived->inventoryID = $itemData[0];
            if ($itemData[8] == 1) {
                $goodsReceived->instock = $itemData[3];
                $goodsReceived->outstock = $itemData[3];
            } else {
                $goodsReceived->outstock = $itemData[3];
                $goodsReceived->instock = 0;
            }
            $goodsReceived->cancel = 0;
            $goodsReceived->status = 'return';
            $goodsReceived->unitEqualsTo = $itemData[2];
            $goodsReceived->unit_cost_rate = $itemData[4];
            $goodsReceived->vat = $itemData[6];
            $goodsReceived->amount = $itemData[5];
            $goodsReceived->save();
        }

        $totalQuantity = 0;
        $totalVat = 0;
        $totalAmount = 0;

        foreach ($request->items as $item) {
            $itemData = explode('{#}', $item);
            $quantity = $itemData[3];
            $vat = $itemData[6];
            $amount = $itemData[7];

            $totalQuantity += $quantity;
            $totalVat += $vat;
            $totalAmount += $amount;
        }

        $purchaseRecords = new PurchaseRecordReturn();
        $purchaseRecords->transactionCode = $s_id;
        $purchaseRecords->project_id = $request->project_id;
        $purchaseRecords->date = $request->date;
        $purchaseRecords->quantity = $totalQuantity;
        $purchaseRecords->partyBillNo = $request->partyBillNo;
        $purchaseRecords->modOfPayment = 1;
        $purchaseRecords->userId = $request->user_id;
        $purchaseRecords->discount = 1;
        $purchaseRecords->cancel = 0;
        $purchaseRecords->vat = $totalVat;
        $purchaseRecords->gtotal = $totalAmount;
        $purchaseRecords->taxable = 1;
        $purchaseRecords->nontaxable = 1;
        $purchaseRecords->save();

        return redirect('/goodsreturn')->with('message', 'Your data has been added successfully');
    }
    public function index(Request $request)
    {
        $query = DB::table('purchase_record_returns')
            ->join('projects', 'purchase_record_returns.project_id', '=', 'projects.id')
            ->select('purchase_record_returns.*', 'projects.project_name')
            ->where('purchase_record_returns.cancel', 0)
            ->orderBy('id','DESC');
            

        if ($request->filled('from') && $request->filled('to')) {
            $from = $request->input('from');
            $to = $request->input('to');

            $query->whereBetween('purchase_record_returns.date', [$from, $to]);
        }

        if ($request->filled('project_name')) {
            $project_name = $request->input('project_name');
            $query->where('projects.project_name', 'like', '%' . $project_name . '%');
        }

        $list = $query->paginate(10);

        return view('frontend.inventory.goodsreturn.list', compact('list'));
    }
    public function destroy(Request $request)
    {
        $tCode = $request->tCode;

        $goodsReceived = GoodsReceived::where('tCode', $tCode)->first();
        if (!$goodsReceived) {
            return redirect('/goodsreturn')->with('message', 'Goods received not found');
        }
        $goodsReceived->delete();
        $purchaseRecords = PurchaseRecordReturn::where('transactionCode', $tCode)->first();
        if (!$purchaseRecords) {
            return redirect('/goodsreturn')->with('message', 'Purchase records not found');
        }
        $purchaseRecords->delete();

        return redirect('/goodsreturn')->with('message', 'Your data has been deleted successfully');
    }
    public function edit(GoodsReceived $goodsReceived, $tCode, Request $request)
    {
        {
            $list = DB::table('purchase_record_returns')
                ->join('primaryInventoryStore', 'primaryInventoryStore.tCode', '=', 'purchase_record_returns.transactionCode')
                ->join('projects', 'purchase_record_returns.project_id', '=', 'projects.id')
                ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
                ->select('purchase_record_returns.*', 'primaryInventoryStore.*', 'projects.project_name', 'item_settings.*')
                ->where('primaryInventoryStore.tCode', $tCode)->get();

            $goodsReturn = DB::table('primaryInventoryStore')
                ->join('purchase_record_returns', 'primaryInventoryStore.tCode', '=', 'purchase_record_returns.transactionCode')
                ->join('projects', 'purchase_record_returns.project_id', '=', 'projects.id')
                ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
                ->select('purchase_record_returns.*', 'primaryInventoryStore.*', 'projects.project_name', 'item_settings.*')
                ->where('tCode', $tCode)
                ->first();
            return view('inventory.goodsreturn.edit', compact('goodsReturn', 'list'));
        }
    }
    public function forModal(GoodsReceived $goodsReceived, $tCode, Request $request)
    {
        $list = DB::table('purchase_record_returns')
            ->join('primaryInventoryStore', 'primaryInventoryStore.tCode', '=', 'purchase_record_returns.transactionCode')
            ->join('projects', 'purchase_record_returns.project_id', '=', 'projects.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_record_returns.*', 'primaryInventoryStore.*', 'projects.project_name', 'item_settings.*')
            ->where('primaryInventoryStore.tCode', $tCode)->get();

        $goodsReceived = DB::table('primaryInventoryStore')
            ->join('purchase_record_returns', 'primaryInventoryStore.tCode', '=', 'purchase_record_returns.transactionCode')
            ->join('projects', 'purchase_record_returns.project_id', '=', 'projects.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_record_returns.*', 'primaryInventoryStore.*', 'projects.project_name', 'item_settings.*')
            ->where('tCode', $tCode)
            ->first();

        return response()->json([
            'goodsReceived' => $goodsReceived,
            'list' => $list,
        ]);
    }
    public function update(Request $request, $tCode)
    {
        {
            \DB::table('activity_logs')->insert([
                'LogDate' =>  date('Y-m-d'),
                'Activity' =>  'Goods Return  Cancel',
                'userid' => $request->user_id,
                'ReferenceNo' => "$tCode",
                'AccountingDate' =>   date('Y-m-d'),
                'LogsTime' => date("Y-m-d h:i:sa"),
            ]);

            $goodsReturn = DB::table('primaryInventoryStore')->where('tCode', $tCode)->first();
            if (!$goodsReturn) {
                return redirect()->back()->with('message', 'Goods return tcode  not found');
            }
            DB::table('primaryInventoryStore')
                ->where('tCode', $tCode)
                ->update([

                    'cancel' => 1,

                ]);
            $purchaseRecords = DB::table('purchase_record_returns')->where('transactionCode', $tCode)->first();
            if (!$purchaseRecords) {
                return redirect()->back()->with('message', ' Purchase records returns tcode not found');
            }
            DB::table('purchase_record_returns')
                ->where('transactionCode', $tCode)
                ->update([
                    'cancellation_note' => $request->cancellation_reason,
                    'cancel' => 1,

                ]);

            return redirect('/goodsreturn')->with('message', 'Your data has been updated successfully');
        }

    }
    public function searchProject($searchkey)
    {
        $data = DB::table('projects')->select('id', 'project_name','project_address',)
            ->where('project_name', 'like', $searchkey . '%')
            ->take(10)
            ->get();
        return json_encode($data);
    }
   

}

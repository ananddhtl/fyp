<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceived;
use App\Models\PurchaseRecords;
use DB;
use Illuminate\Http\Request;
use Validator;

class GoodsReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PurchaseRecords::join('suppliers', 'purchase_records.Sid', '=', 'suppliers.id')

            ->select('purchase_records.*', 'suppliers.fullname')
            ->where('purchase_records.cancel', 0)
            ->orderBy('id', 'DESC');

        if ($request->filled('from') && $request->filled('to')) {
            $from = $request->input('from');
            $to = $request->input('to');

            $query->whereBetween('purchase_records.date', [$from, $to]);
        }

        if ($request->filled('suppliers_name')) {
            $suppliersName = $request->input('suppliers_name');
            $query->where('suppliers.fullname', 'like', '%' . $suppliersName . '%');
        }

        $list = $query->paginate(10);
       
        return view('frontend.inventory.goodsreceived.list', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */

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
        $checkCode = PurchaseRecords::select('transactionCode')->where('transactionCode', '=', $code)->first();
        if ($checkCode) {
            return $checkCode['transactionCode'];
        }
        return '';
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            

            $validationMessages = [
                'party_id.required' => 'Please select the supplier.',
                
            ];

            $validator = Validator::make($request->all(), [
                'party_id' => 'required',
               
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
            //     'Activity' =>  'Goods Received  Store',
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
                    $goodsReceived->instock = $itemData[3];
                    $goodsReceived->outstock = 0;
                }

                $goodsReceived->cancel = 0;
                $goodsReceived->status = 'received';
                $goodsReceived->unitEqualsTo = $itemData[2];
                $goodsReceived->unit_cost_rate = $itemData[4];
                $goodsReceived->vat = $itemData[6];
                $goodsReceived->amount = $itemData[7];
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

            $purchaseRecords = new PurchaseRecords();
            $purchaseRecords->transactionCode = $s_id;
            $purchaseRecords->Sid = $request->party_id;
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

            return redirect('/goodsreceivedlist')->with('message', 'Your data has been added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GoodsReceived $goodsReceived)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoodsReceived $goodsReceived, $tCode)
    {

        $list = DB::table('purchase_records')
            ->join('primaryInventoryStore', 'primaryInventoryStore.tCode', '=', 'purchase_records.transactionCode')
            ->join('suppliers', 'purchase_records.Sid', '=', 'suppliers.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_records.*', 'primaryInventoryStore.*', 'suppliers.fullname', 'item_settings.*')
            ->where('primaryInventoryStore.tCode', $tCode)
            ->get();
        $goodsReceived = DB::table('primaryInventoryStore')
            ->join('purchase_records', 'primaryInventoryStore.tCode', '=', 'purchase_records.transactionCode')
            ->join('suppliers', 'purchase_records.Sid', '=', 'suppliers.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_records.*', 'primaryInventoryStore.*', 'suppliers.fullname', 'item_settings.*')
            ->where('tCode', $tCode)
            ->first();
        return view('inventory.goodsreceived.cancel', compact('goodsReceived', 'list'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tCode)
    {
        \DB::table('activity_logs')->insert([
            'LogDate' => date('Y-m-d'),
            'Activity' => 'Goods Received  Cancel',
            'userid' => $request->user_id,
            'ReferenceNo' => "$tCode",
            'AccountingDate' => date('Y-m-d'),
            'LogsTime' => date("Y-m-d h:i:sa"),
        ]);
        $goodsReceived = GoodsReceived::where('tCode', $tCode)->first();
        if (!$goodsReceived) {
            return redirect()->back()->with('message', 'Goods received not found');
        }
        DB::table('primaryInventoryStore')
            ->where('tCode', $tCode)
            ->update([
                'cancel' => 1,
            ]);
        $purchaseRecords = DB::table('purchase_records')->where('transactionCode', $tCode)->first();
        if (!$purchaseRecords) {
            return redirect()->back()->with('message', 'Goods received not found');
        }
        DB::table('purchase_records')
            ->where('transactionCode', $tCode)
            ->update([
                'cancelation_note' => $request->cancellation_reason,
                'cancel' => 1,

            ]);
        return redirect('/goodsreceived')->with('message', 'Your data has been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoodsReceived $goodsReceived)
    {
        //
    }
    public function searchSuppliers($searchkey)
    {
        $data = \DB::table('suppliers')->select('*')
            ->where('fullname', 'like', $searchkey . '%')
            ->take(10)
            ->get();
        return json_encode($data);
    }

    public function forModal(GoodsReceived $goodsReceived, $transactionCode, Request $request)
    {
        
        $list = DB::table('purchase_records')
            ->join('primaryInventoryStore', 'primaryInventoryStore.tCode', '=', 'purchase_records.transactionCode')
            ->join('suppliers', 'purchase_records.Sid', '=', 'suppliers.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_records.*', 'primaryInventoryStore.*', 'suppliers.fullname', 'item_settings.*')
            ->where('primaryInventoryStore.tCode', $transactionCode)
            ->get();
        $goodsReceived = DB::table('primaryInventoryStore')
            ->join('purchase_records', 'primaryInventoryStore.tCode', '=', 'purchase_records.transactionCode')
            ->join('suppliers', 'purchase_records.Sid', '=', 'suppliers.id')
            ->join('item_settings', 'item_settings.id', '=', 'primaryInventoryStore.inventoryID')
            ->select('purchase_records.*', 'primaryInventoryStore.*', 'suppliers.fullname', 'item_settings.*')
            ->where('tCode', $transactionCode)
            ->first();
        return response()->json([
            'goodsReceived' => $goodsReceived,
            'list' => $list,
        ]);
    }
}

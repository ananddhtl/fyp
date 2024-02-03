<?php

namespace App\Http\Controllers;

use App\Models\ItemSettings;
use DB;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Validator;

class ItemSettingsController extends Controller
{

    public function __construct(ItemSettings $itemSettings)
    {
        $this->itemSettings = $itemSettings;
    }
    /**
     * Your API route method with the @PathItem annotation.
     *
     * @OA\Get(
     *   path="/your-route-path",
     *   ...
     * )
     */
    public function generateuniqueid()
    {
        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('-10 days'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $uniqueid = $startDate + $rand;
        $length = 20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $Sid = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $Sid = $Sid . $uniqueid;

        if ($this->SidExists($Sid) == $Sid) {
            return generateuniqueid();
        }

        return $Sid;
    }
    public function SidExists($uid)
    {
        $CheckSid = ItemSettings::select('s_id')->where('s_id', '=', $uid)->first();
        if ($CheckSid) {
            $CheckSid = $CheckSid['Sid'];
        } else {
            $CheckSid = "";
        }
        return $CheckSid;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {{
        $category = DB::table('item_categories')->select('*')->orderBy('id', 'DESC')->get();

        $list = DB::table('item_settings')
            ->join('item_categories', 'item_settings.cat_id', '=', 'item_categories.id')
            ->where('item_settings.cancel', 0)
            ->select('item_settings.*', 'item_categories.cat_name')->orderBy('id', 'DESC');

        if ($request->has('item_name')) {
            $item_name = $request->item_name;
            $list->where('item_name', 'like', '%' . $item_name . '%');
        }

        $list = $list->paginate(10);
        $list->appends([
            'item_name' => $request->item_name,
        ]);
        return view('frontend.inventory.itemsettings.list', compact('list', 'category'));

    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'item_name' => 'required|string|max:255',
                'item_details' => 'required|string|max:255',
                'cat_id' => 'required|integer',
                'normal_rate' => 'required|numeric',
                'unit' => 'required|string',
                'sellrate' => 'required|integer',
                'equals' => 'required',
                'subunit' => 'required',
            ]);
            $s_id = $this->generateuniqueid();
            while ($this->SidExists($s_id)) {
                $s_id = $this->generateuniqueid();
            }
            // \DB::table('activity_logs')->insert([
            //     'LogDate' =>  date('Y-m-d'),
            //     'Activity' =>  'Item Settings Store',
            //     'userid' => $request->user_id,
            //     'ReferenceNo' => "$s_id",
            //     'AccountingDate' =>   date('Y-m-d'),
            //     'LogsTime' => date("Y-m-d h:i:sa"),
            // ]);
            $itemSetting = new ItemSettings();
            $itemSetting->s_id = $s_id;
            $itemSetting->item_name = $request->item_name;
            $itemSetting->item_details = $request->item_details;
            $itemSetting->cat_id = $request->cat_id;
            $itemSetting->normal_rate = $request->normal_rate;
            $itemSetting->unit = $request->unit;
            $itemSetting->equal = $request->equals;
            $itemSetting->subunit = $request->subunit;
            $itemSetting->equal_value = $request->equal_value;
            $itemSetting->vatable = $request->vatable;
            $itemSetting->stockable = $request->stockable;
            $itemSetting->cancel = 0;
            $itemSetting->discount_in_percent = $request->discount_in_percent;
            $itemSetting->sellrate = $request->sellrate;
            if ($cover_image = $request->file('cover_image')) {
                $img_name = hexdec(uniqid()) . '.' . $cover_image->getClientOriginalExtension();
                $cover_image->move('uploads/itemsettings/coverimage/', $img_name);
                $save_url = ('/uploads/itemsettings/coverimage/' . $img_name);
                $itemSetting->cover_image = $save_url;
            }
            $itemSetting->save();

            return redirect('/itemslist')->with('stored', 'Item has been added successfully');
        } catch (ValidationException $e) {

            $errors = $e->validator->errors();

            return redirect()->back()->withErrors($errors)->withInput();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemSettings  $itemSettings
     * @return \Illuminate\Http\Response
     */
    public function show(ItemSettings $itemSettings, $id)
    {{
        $itemSettings = ItemSettings::where('cancel', 0)->find($id);

        if (!$itemSettings) {
            $json_resp = [
                'status' => 'error',
                'message' => 'Item not found',
            ];
            return response()->json($json_resp, 404);
        }

        $json_resp = [
            'status' => 'success',
            'data' => $itemSettings,
        ];

        return response()->json($json_resp, 200);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemSettings  $itemSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemSettings $itemSettings, $id)
    {
        {
            $category = DB::table('item_categories')->select('*')->get();
            $list = DB::table('item_settings')
                ->join('item_categories', 'item_settings.cat_id', '=', 'item_categories.id')
                ->where('item_settings.cancel', 0)
                ->select('item_settings.*', 'item_categories.cat_name')
                ->orderBy('id', 'DESC')
                ->paginate();

            $itemSettings = DB::table('item_settings')
                ->where('id', $id)
                ->first();

            return view('frontend.inventory.itemsettings.edit', compact('itemSettings', 'list', 'category'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemSettings  $itemSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemSettings $itemSettings, $id)
    {{
        $itemSetting = ItemSettings::find($id);
        if (!$itemSetting) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [

            'item_name' => 'required|string|max:255',
            'item_details' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'normal_rate' => 'required|numeric',
            'unit' => 'required|string',
            'sellrate' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all(),
            ], 400);
        }
        // \DB::table('activity_logs')->insert([
        //     'LogDate' =>  date('Y-m-d'),
        //     'Activity' =>  'Item Settings Update',
        //     'userid' => $request->user_id,
        //     'ReferenceNo' => "$id",
        //     'AccountingDate' =>   date('Y-m-d'),
        //     'LogsTime' => date("Y-m-d h:i:sa"),
        // ]);
        $itemSetting->item_name = $request->item_name;
        $itemSetting->item_details = $request->item_details;
        $itemSetting->cat_id = $request->cat_id;
        $itemSetting->normal_rate = $request->normal_rate;
        $itemSetting->unit = $request->unit;
        $itemSetting->vatable = $request->vatable;
        $itemSetting->equal = $request->equals;
        $itemSetting->subunit = $request->subunit;
        $itemSetting->equal_value = $request->equal_value;
        $itemSetting->cancel = 0;
        $itemSetting->discount_in_percent = $request->discount_in_percent;
        $itemSetting->sellrate = $request->sellrate;
        if ($cover_image = $request->file('cover_image')) {

            $img_name = hexdec(uniqid()) . '.' . $cover_image->getClientOriginalExtension();

            $cover_image->move('uploads/itemsettings/coverimage/', $img_name);
            $save_url = ('/uploads/itemsettings/coverimage/' . $img_name);
            $itemSetting->cover_image = $save_url;
        }
        $itemSetting->save();

        return redirect('/itemslist')->with('updated', 'Item has been updated  successfully');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemSettings  $itemSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSettings $itemSettings, $id)
    {
        try {

            $itemSettings = ItemSettings::find($id);

            if (!$itemSettings) {
                $json_resp['status'] = 'error';
                $json_resp['message'] = "Item Not Found";
                return response()->json($json_resp, 404);
            }
            // \DB::table('activity_logs')->insert([
            //     'LogDate' => date('Y-m-d'),
            //     'Activity' => 'Item Settings Delete',
            //     'userid' => $user_id,
            //     'ReferenceNo' => "$id",
            //     'AccountingDate' => date('Y-m-d'),
            //     'LogsTime' => date("Y-m-d h:i:sa"),
            // ]);
            $itemSettings->delete();

            return redirect()->back()->with('deleted', 'Item has been deleted sucessfully');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}

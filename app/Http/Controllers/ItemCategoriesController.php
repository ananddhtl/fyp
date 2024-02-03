<?php

namespace App\Http\Controllers;

use App\Models\ItemCategories;
use DB;
use Illuminate\Http\Request;
use Validator;

class ItemCategoriesController extends Controller
{
    public function __construct(ItemCategories $itemCategories)
    {
        $this->itemCategories = $itemCategories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $CheckSid = ItemCategories::select('s_id')->where('s_id', '=', $uid)->first();
        if ($CheckSid) {
            $CheckSid = $CheckSid['Sid'];
        } else {
            $CheckSid = "";
        }
        return $CheckSid;
    }

    public function index(Request $request)
    {{
        $list = DB::table('item_categories')->orderBy('id', 'DESC');

        if ($request->has('cat_name')) {
            $cat_name = $request->cat_name;
            $list->where('cat_name', 'like', '%' . $cat_name . '%');
        }

        $list = $list->paginate(10);
        $list->appends([
            'cat_name' => $request->cat_name,
        ]);

        if ($list->isEmpty()) {
            $json_resp = [
                'status' => 'error',
                'message' => 'Item not found',
            ];
            return response()->json($json_resp, 404);
        }

        return view('frontend.inventory.itemcategory.list', compact('list'));

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
        $validator = Validator::make($request->all(), [

            'cat_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all(),
            ], 400);
        }

        $s_id = $this->generateuniqueid();
        while ($this->SidExists($s_id)) {
            $s_id = $this->generateuniqueid();
        }
        $itemCatagory = new ItemCategories();
        $itemCatagory->s_id = $s_id;
        $itemCatagory->cat_name = $request->cat_name;
        $itemCatagory->status = 0;
        $itemCatagory->save();

        return redirect('/itemcategorylist')->with('stored', 'Item has been added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemCategories  $itemCategories
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCategories $itemCategories, $id)
    {{
        $itemSettings = ItemCategories::find($id);

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
     * @param  \App\Models\ItemCategories  $itemCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            $list = DB::table('item_categories')
                ->paginate(10);
            $itemCategories = DB::table('item_categories')
                ->where('id', $id)
                ->first();
            return view('frontend.inventory.itemcategory.edit', compact('itemCategories', 'list'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemCategories  $itemCategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemCategories $itemCategories, $id)
    {
        $itemCategories = ItemCategories::find($id);
        if (!$itemCategories) {
            return redirect()->back()->with('message', 'Item not found');
        }
        $validator = Validator::make($request->all(), [

            'cat_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all(),
            ], 400);
        }
        $itemCategories->cat_name = $request->cat_name;
        $itemCategories->save();
        return redirect('/itemcategorylist')->with('updated', 'Item has been updated  successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemCategories  $itemCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategories $itemCategories, $id)
    {
        $itemSettings = ItemCategories::find($id);

        if (!$itemSettings) {
            return redirect()->back()->with('message', 'Category not found');
        }

        $status = $itemSettings->delete();

        if ($status) {

            return redirect()->back()->with('deleted', 'Item has been deleted  successfully');
        }

        return redirect()->back()->with('message', 'Failed to delete category');
    
    }
}
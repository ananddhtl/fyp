<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Exports\ActivtiesExport;
use App\Models\ActivityCatagory;
use App\Models\SubActivity;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ActivitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function activitiesCatagoriesForProjectEstimation()
    {

        $activitiescatagories = ActivityCatagory::select('*')->get();



        return view('frontend.projectestimation.add', compact('activitiescatagories'));
    }
    public function activitiesCatagoriesForProjectProgress()
    {

        $activitiescatagories = ActivityCatagory::select('*')->get();



        return view('frontend.projectprogress.add', compact('activitiescatagories'));
    }
    public function activitiesCatagories()
    {

        $activitiescatagories = ActivityCatagory::select('*')->get();



        return view('frontend.projectactivities.add', compact('activitiescatagories'));
    }

    public function index()
    {

        $activitiescatagories = ActivityCatagory::select('*')->get();



        return view('frontend.activities.add', compact('activitiescatagories'));
    }
    public function searchActivities($searchkey)
    {
        $Activity = Activity::select('id', 'activities_title',)->where('activities_title', 'like', '' . $searchkey . '%')->get()->take(10);
        return json_encode($Activity);
    }
    public function getActivityData()
    {
        $data = DB::table('activities',)
            ->join('activity_catagories', 'activities.activities_cat_ID', '=', 'activity_catagories.id')
            ->select('activities.*', 'activity_catagories.activity_catagories_name')
            ->where('activities.status', '=', 0)
            ->simplePaginate(10);
        return view('frontend.activities.list', compact('data'));
    }
    function postActivitiesData(Request $request)
    {

        $request->validate([

            'activities_title' => 'required  | min:3',
            // 'activities_subtitle' => 'required  | min:3',

        ]);
        $existingRecord = Activity::select("*")->where('activities_title', $request->activities_title)->get()->first();


        if (!empty($existingRecord)) {
            return json_encode(array(
                'text' => true, 'message' => " You already have that item"

            ));
        } else {

            $activities = new Activity;
            $activities->id = $request->id;
            $activities->activities_title = $request->activities_title;
            $activities->activities_subtitle = $request->activities_subtitle;
            $activities->activities_cat_ID = $request->activities_cat_ID;
            $activities->unit = $request->unit;
            $activities->status = 0;
            $activities->rate =  $request->rate;
            $activities->save();


            $id = Activity::select('id', 'activities_title')->orderBy('created_at', 'desc')->first();

            $activity_id = $id->id;



            $subActivity_array = explode(',', $request->subActivity);

            if ($request->subActivity != "") {
                for ($i = 0; $i < count($subActivity_array); $i++) {
                    $val = explode('{#}', $subActivity_array[$i]);
                    $subActivity = new SubActivity();
                    $subActivity->activity_id = $activity_id;
                    // $subActivity->title = $val[0];
                    // $subActivity->sub_unit = $val[1];
                    $subActivity->qty = $val[2];
                    $subActivity->rate = $val[3];
                    $subActivity->itemId = $val[4];


                    $subActivity->save();
                }
                return json_encode(array(
                    'status' => true, 'message' => "Successfully done.",
                ));
            }
        }
    }

    public function deleteActivities($id)
    {
        Activity::where('id', '=', $id)->update([
            'status' => 1,
        ]);
        SubActvity::where('id', '=', $id)->update([
            'status' => 1,
        ]);

        return redirect('/activities/list')->with('message', 'Your data has been deleted successfully');
    }
    public function editActivities($id)
    {

        $data = DB::table('activities',)
            ->select('activities.*', 'activity_catagories.activity_catagories_name')
            ->join('activity_catagories', 'activities.activities_cat_ID', '=', 'activity_catagories.id')
            ->select('activities.*', 'activity_catagories.activity_catagories_name', 'activity_catagories.id as activities_id')
            ->where('activities.status', '=', 0)
            ->where('activities.id', $id)
            ->get();

        $subactivity = DB::table('sub_activities',)

            ->select('*')
            ->where('activity_id', '=', $id)

            ->get();



        return view('frontend.activities.edit', compact('data', 'subactivity'));
    }
    public function updateActivities(Request $request)
    {

        $request->validate([

            'activities_title' => 'required  | min:3',
            // 'activities_subtitle' => 'required  | min:3',

        ]);
        $existingRecord = Activity::select("*")->where('activities_title', $request->activities_title)->get()->first();


        if (!empty($existingRecord)) {
            return json_encode(array(
                'text' => true, 'message' => " You already have that item"

            ));
        } else {


            $subActivity_array = explode(',', $request->subActivity);


            Activity::where('id', '=', $request->id)->update([
                'activities_title' => $request->activities_title,
                'activities_subtitle' => $request->activities_subtitle,
                'activities_cat_ID' => $request->activities_cat_ID,
                'unit' => $request->unit,
                'status' => 0,

            ]);
            SubActivity::where('activity_id', '=', $request->id)->update([
                'status' => 1,
            ]);



            if ($request->subActivity != "") {
                for ($i = 0; $i < count($subActivity_array); $i++) {
                    $val = explode('{#}', $subActivity_array[$i]);
                    $subActivity = new SubActivity();
                    $subActivity->activity_id =  $request->id;
                    $subActivity->qty = $val[2];
                    $subActivity->rate = $val[3];
                    $subActivity->itemId = $val[4];
                    $subActivity->save();
                }
                return json_encode(array(
                    'status' => true, 'message' => "Successfully done.",
                ));
            }
        }
    }
    public function search(Request $request,)
    {
        $get_name = $request->activities_title;
        $data = DB::table('activities',)
            ->join('activity_catagories', 'activities.activities_cat_ID', '=', 'activity_catagories.id')
            ->select('activities.*', 'activity_catagories.activity_catagories_name')
            ->where('activities.status', '=', 0)
            ->where('activities_title', 'like', '%' . $get_name . '%')
            ->simplePaginate(10);


        return view('frontend.activities.list', compact('data'));
    }
    public function export()
    {
        return  Excel::download(new ActivtiesExport, 'activity.xlsx');
    }


    public function searchSubActivity($id)
    {
        // dd($id);
        $subActivity = DB::table('activities',)
            ->join('sub_activities', 'activities.id', '=', 'sub_activities.activity_id')
            ->join('items','items.id','=','sub_activities.itemid')
            ->select('sub_activities.*','itemName','itemUnit')
            ->where('activity_id', '=', $id)
            ->get();


        return  json_encode($subActivity);
    }
}

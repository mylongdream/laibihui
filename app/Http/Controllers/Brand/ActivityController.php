<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeActivityModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Vinkla\Hashids\Facades\Hashids;

class ActivityController extends Controller
{
    public function index(){
        $activitys = HomeActivityModel::orderBy('created_at', 'desc')->paginate(15);
        foreach ($activitys as $activity) {
            $activity->hashid = Hashids::encode($activity->activity_id);
        }
        return view('home.activity.index', ['activitys' => $activitys]);
    }

    public function detail(Request $request){
        $id = Hashids::decode($request->id);
        if(!$id){
            abort(404);
        }
        $activity = HomeActivityModel::where('activity_id', $id)->firstOrFail();
        if($activity->city){
            return redirect()->route('subweb.activity.detail',[$activity->city['domain'], $request->id]);
        }else{
            //return view('home.activity.detail')->with('activity', $activity);
            return view('home.activity.custom.'.$activity->activity_id)->with('activity', $activity);
        }
    }

    public function appoint(Request $request){

    }
}

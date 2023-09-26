<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Joboffer;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobofferController extends Controller
{
    public function get_all_joboffers(){
        DebugBar::addMessage('Getting all joboffers');
        $joboffers = Joboffer::with('company')->orderBy('date', 'DESC')->get();
        return response()->json([
            'joboffers' => $joboffers
        ], 200);
    }

    public function get_joboffers(Request $request){
        $company_id = $request->get('id');
        DebugBar::addMessage('getting joboffers for employer..');
        // Debugbar::info($company_id);
        $joboffers = Joboffer::with('company')->where('company_id', 'LIKE', $company_id)->get();
        return response()->json([
            'joboffers' => $joboffers
        ], 200);
    }

    public function create(Request $request){
        $request->validate([
            'title' => ['required'],
            'date' => ['required'],
            'level' => ['required'],
            'description' => ['required'],
            'company_id' => ['required']
        ]);

        Joboffer::create([
            'title' => $request->title,
            'date' => $request->date,
            'level' => $request->level,
            'description' => $request->description,
            'company_id' => $request->company_id
        ]);

        return response('Success', 200);
    }

    public function update(Request $request){
        $id = $request->get('id');
        $request->validate([
            'title' => ['required'],
            'date' => ['required'],
            'level' => ['required'],
            'description' => ['required'],
            'company_id' => ['required']
        ]);

        $joboffer = Joboffer::find($id);

        $joboffer->title = $request->title;
        $joboffer->date = $request->date;
        $joboffer->level = $request->level;
        $joboffer->description = $request->description;

        $joboffer->save();
        
        return response('Success', 200);
    }

    public function show_joboffer($id){
        $joboffer = JobOffer::with('company')->find($id);
        return response()->json([
            'joboffer' => $joboffer
        ]);
    }

    public function add_joboffer_user(Request $request){
        $user = Auth::user();
        Debugbar::info($user->id);
        $joboffer = Joboffer::find($request->joboffer_id);

        $joboffer->users()->syncWithoutDetaching($user->id);
        return response('Success', 200);
    }

    public function get_all_candidates(Request $request){
        $id = $request->get('id');
        $joboffer = Joboffer::find($id);
        $users = $joboffer->users()->get();

        return response()->json([
            'users' => $users
        ]);
    }
    public function get_my_joboffers(Request $request){
        $id = $request->get('id');
        $user = User::find($id);
        $joboffers = $user->joboffers()->with('company')->get();

        return response()->json([
            'joboffers' => $joboffers
        ]);
    }
    public function toggle_invite(Request $request){
        $joboffer = Joboffer::find($request->joboffer_id);
        $joboffer->users()->updateExistingPivot($request->user_id, 
                                                ['invited'=>$request->invited]);
    }
}

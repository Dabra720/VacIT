<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Joboffer;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

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
        Debugbar::info($company_id);
        $joboffers = Joboffer::with('company')->where('company_id', 'LIKE', $company_id)->get();
        return response()->json([
            'joboffers' => $joboffers
        ], 200);
    }

    public function create(Request $request){

    }

    public function show_joboffer($id){
        $joboffer = JobOffer::with('company')->find($id);
        return response()->json([
            'joboffer' => $joboffer
        ]);
    }
}

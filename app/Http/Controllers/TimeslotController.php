<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeslotController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $timeslots = $request->all();

        foreach($timeslots as $slot){
            Timeslot::updateOrCreate([
                'company_id' => $slot['company_id'],
                'date' => $slot['date'],
                'start' => $slot['start'],
            ],
            [
                'duration' => $slot['duration'],
                'online' => $slot['online'],
                'joboffer_id' => $slot['joboffer_id'],
            ]);
        }

        return response('success', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $timeslots = Timeslot::where('company_id', 'LIKE', $id)->whereNull('user_id')->get();

        return response()->json([
            'timeslots' => $timeslots,
        ], 200);
    }

    public function get_appointments($id){
        $appointments = Timeslot::where('company_id', 'LIKE', $id)
                        ->whereNotNull('user_id')
                        ->whereNotNull('joboffer_id')
                        ->with('user')
                        ->with('joboffer')
                        ->get();
        
        return response()->json([
            'appointments' => $appointments,
        ]);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function delete(Request $request)
    {
        $timeslot = Timeslot::find($request->get('id'));
        if($timeslot->delete()){
            return response('Tijdslot verwijderd', 200);
        } else{
            return response('Niks verwijderd', 200);
        }
    }

    public function add_appointment(Request $request)
    {
        $slot_id = $request->slot;
        $user_id = $request->user;

        $timeslot = Timeslot::find($slot_id);

        $timeslot->user_id = $user_id;
        $timeslot->joboffer_id = $request->offer;

        $timeslot->save();

        return response('Appointment added!');
    }

    public function cleanup(Request $request)
    {
        $id = $request->get('id');
        $currentDate = Carbon::now()->format('Y-m-d');
        $timeslots = Timeslot::where('company_id', 'LIKE', $id)->whereDate('date', '<', $currentDate)->get();
        // dd($timeslots);
        foreach($timeslots as $slot){
            $slot->delete();
        }

        return response('Nice!');
    }
}

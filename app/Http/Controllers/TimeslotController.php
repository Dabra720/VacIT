<?php

namespace App\Http\Controllers;

use App\Models\Timeslot;
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
            Timeslot::create([
                'company_id' => $slot['company_id'],
                'date' => $slot['date'],
                'start' => $slot['start'],
                'duration' => $slot['duration'],
                'online' => $slot['online'],
                'joboffer_id' => $slot['joboffer'],
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function add_appointment(Request $request)
    {
        $slot_id = $request->slot;
        $user_id = $request->user;

        $timeslot = Timeslot::find($slot_id);

        $timeslot->user_id = $user_id;

        $timeslot->save();

        return response('Appointment added!');
    }
}

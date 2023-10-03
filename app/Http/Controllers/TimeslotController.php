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
        $timeslots = Timeslot::where('company_id', 'LIKE', $id)->get();

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

}

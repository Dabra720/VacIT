<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
// use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show_profile(Request $request){
        $user_id = $request->get('id');
        $profile = UserProfile::where('user_id','LIKE', $user_id)->first();
        // $debugbar = new DebugBar();
        // $debugbar->info($profile);
        // $debugbar->sendDataInHeaders();
        // Debugbar::info('profile', $profile); // Dit werkt niet voor ajax
        return response()->json([
            'profile' => $profile
        ], 200);
    }

    public function update_or_create(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'surname' => ['required'],
            'date_of_birth' =>['required'],
            'phone' =>['required'],
            'address' =>['required'],
            'postcode' =>['required'],
            'city' =>['required'],
        ]);

        UserProfile::createOrUpdate(
            ['user_id' => $request->user_id],
            [
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'city' => $request->city,
        ]);
    }
}

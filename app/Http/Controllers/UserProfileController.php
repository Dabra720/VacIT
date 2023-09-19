<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show_profile(Request $request){
        $user_id = $request->get('id');
        $profile = UserProfile::where('user_id','LIKE', $user_id)->first();
        // $debugbar = new DebugBar();
        // $debugbar->info($profile);
        // $debugbar->sendDataInHeaders();
        Debugbar::info('profile', $profile); // Dit werkt niet voor ajax
        return response()->json([
            'profile' => $profile
        ], 200);
    }
}

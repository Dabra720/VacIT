<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
// use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show_profile(Request $request){
        $user_id = $request->get('id');
        $profile = UserProfile::where('user_id','LIKE', $user_id)->first();
        return response()->json([
            'profile' => $profile
        ], 200);
    }

    public function get_email(Request $request){
        $user_id = $request->get('id');
        $email = User::where('id', $user_id)->get('email');

        return response()->json([
            'email' => $email[0]->email
        ], 200);
    }

    public function update_or_create(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'name' => ['required'],
            'surname' => ['required'],
            'date_of_birth' =>['required'],
            'phone' =>['required'],
            'address' =>['required'],
            'postcode' =>['required'],
            'city' =>['required'],
        ]);

        $profile = UserProfile::where('user_id', 'LIKE', $request->user_id)->first();
        if($profile){
            $this->authorize('update', $profile);
        }else{
            $this->authorize('create');
        }

        UserProfile::updateOrCreate(
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

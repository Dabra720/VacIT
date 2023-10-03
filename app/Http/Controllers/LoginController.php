<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;

// class LoginController extends Controller
// {
//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required']
//         ]);

//         if (Auth::attempt($request->only('email', 'password'))){
//             // $request->session()->regenerate();
//             return response()->json(Auth::user(), 200);
//         }
        // throw ValidationException::withMessages([
        //     'email' =>['The provided credentials are incorrect.']
        // ]);
//     }
//     public function logout()
//     {
//         Auth::logout();
//     }
// }
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)//: RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            // return redirect()->intended('dashboard');
            return response()->json(Auth::user(), 200);
        }
 
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorrect.']
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
    }
}
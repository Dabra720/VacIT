<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobofferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use Barryvdh\Debugbar\Facades\Debugbar;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Debugbar::info($request->user());
    Debugbar::addMessage('Got the user');
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

// Account routes
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

// Profile routes
Route::get('profile/user', [UserProfileController::class, 'show_profile']);
Route::post('profile/save', [UserProfileController::class, 'update_or_create']);
Route::get('profile/company', [CompanyController::class, 'show_company']);
Route::post('company/update', [CompanyController::class, 'update']);
Route::get('get_email', [UserProfileController::class, 'get_email']);
Route::get('my_joboffers', [JobofferController::class, 'get_my_joboffers']);
Route::get('my_invites', [JobofferController::class, 'get_invites']);

// Joboffer routes
Route::get('joboffers', [JobofferController::class, 'get_all_joboffers']);
Route::get('get_joboffers', [JobofferController::class, 'get_joboffers']);
Route::get('show_joboffer/{id}', [JobofferController::class, 'show_joboffer']);
Route::get('company_joboffers/{id}', [JobofferController::class, 'get_company_joboffers']);
Route::post('joboffer/create', [JobofferController::class, 'create']);
Route::post('joboffer/update', [JobofferController::class, 'update']);

Route::post('joboffer/apply', [JobofferController::class, 'add_joboffer_user']);
Route::post('joboffer/accept', [JobofferController::class, 'toggle_invite']);
Route::get('joboffer/get_candidates', [JobofferController::class, 'get_all_candidates']);
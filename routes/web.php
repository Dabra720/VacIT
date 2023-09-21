<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

// Route::middleware(['auth'])->group(function () {
//     // Laravel authenticated routes
//     Route::get('/logout', 'DashboardController@index')->name('dashboard');
//     // Add more authenticated routes as needed
// });

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/{pathMatch}', function(){
//     return view('welcome');
// })->where('pathMatch', '.*');
// Route::get('/{pathMatch}', [App\Http\Controllers\Controller::class, 'index'])
//     ->where('pathMatch', '.*');
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
// Route::get('{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
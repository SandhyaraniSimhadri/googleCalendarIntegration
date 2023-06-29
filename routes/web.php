<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [GoogleCalendarController::class, 'authenticate']);
Route::get('/auth/google/callback', [GoogleCalendarController::class, 'authenticate']);
Route::get('/events', [GoogleCalendarController::class, 'events'])->name('events');
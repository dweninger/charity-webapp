<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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

/*
    GET /projects (index)
    GET /projects (create)
    GET /projects/1 (show)
    POST /projets (store)
    GET /projects/1/edit (edit)
    PATCH /projects/1 (update)
    DELETE /projects/1 (destroy)
*/

/* Welcome and about pages */
Route::get('/', function () {
    return View::make('welcome');
});
Route::get('/about', function () {
    return View::make('about');
});

/* Programs */
Route::resource('programs', 'App\Http\Controllers\ProgramController');

/* Event creation and sign-up */
Route::resource('events', 'App\Http\Controllers\EventController');
Route::get('/events/{event}/volunteer', 'App\Http\Controllers\EventController@volunteer_edit');
Route::patch('/events/{event}/volunteer-confirm', 'App\Http\Controllers\EventController@volunteer_update');
Route::get('/events/{event}/donate', 'App\Http\Controllers\EventController@donate_edit');
Route::patch('/events/{event}/donate-confirm', 'App\Http\Controllers\EventController@donate_update');

/* Event Cancelation */
Route::get('/events/{event}/cancel', 'App\Http\Controllers\EventController@cancelEvent');
Route::patch('/events/{event}/cancel-confirm', 'App\Http\Controllers\EventController@cancelEventConfirm');

/* User Info */
Route::resource('user-events', 'App\Http\Controllers\UserEventController');
Route::get('/my-events', 'App\Http\Controllers\UserEventController@index');
Route::get('/my-donations', 'App\Http\Controllers\UserEventController@donation_index');
Route::get('/user-events/{user_event},{user},{event}/edit', 'App\Http\Controllers\UserEventController@edit');
Route::patch('/user-events/{user_event},{user},{event}', 'App\Http\Controllers\UserEventController@update');

/* Unrestricted donations */
Route::resource('unrestricted-donations', 'App\Http\Controllers\UnrestrictedDonationsController');

/* Admin - User Managment */
Route::get('/make-admin', 'App\Http\Controllers\UserController@index');
Route::get('/users', 'App\Http\Controllers\UserController@getAllUsers');
Route::get('/users/{user}/deactivate', 'App\Http\Controllers\UserController@deactivateUser');
Route::patch('/users/{user}/deactivate-confirm', 'App\Http\Controllers\UserController@deactivateUserConfirm');
Route::get('/users/{user}/activate', 'App\Http\Controllers\UserController@activateUser');
Route::patch('/users/{user}/activate-confirm', 'App\Http\Controllers\UserController@activateUserConfirm');
Route::get('/users/{user}', 'App\Http\Controllers\UserController@userInfo');

Auth::routes();

/* Home index */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
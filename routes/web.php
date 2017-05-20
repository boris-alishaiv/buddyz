<?php

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

// facebook and google auth links
Route::get('/auth/{driver}', [
    'uses' => 'UserController@redirectToProvider'
]);

Route::get('auth/{driver}/callback', [
    'uses' => 'UserController@handleCallback'
]);



/**
 * UserMedals
 */
Route::get('/userMedals/{userId}', 'UserMedalController@getBuddyMedals');
Route::post('/userMedals/{userId}', 'UserMedalController@addMedalToBody');
Route::get('/userMedals/{userId}/{medalId}', 'UserMedalController@getBuddyMedal');
Route::delete('/userMedals/{userId}/{medalId}', 'UserMedalController@deleteBuddyMedal');

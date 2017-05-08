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
 * Vouches
 */
Route::get('/vouch', 'VouchController@getAllVouches');
Route::get('/vouch/{userId}', 'VouchController@getVouchesByUser');
Route::post('/vouch/{userId}', 'VouchController@addVouchByUser');
Route::get('/vouch/{userId}/{vouchId}', 'VouchController@getVouch');
Route::delete('/vouch/{userId}/{vouchId}', 'VouchController@deleteVouch');
Route::get('/vouch/{userId}/getAllMyVouches', 'VouchController@getAllVouches');


/**
 * Area
 */
Route::get('/areas', 'AreaController@getAllAreas');
Route::post('/areas', 'AreaController@createArea');
Route::get('/areas/{areaId}', 'AreaController@getArea');
Route::post('/areas/{areaId}', 'AreaController@updateArea');
Route::delete('/areas/{areaId}', 'AreaController@deleteArea');


/**
 * UserMedals
 */
Route::get('/userMedals/{userId}', 'UserMedalController@getBuddyMedals');
Route::post('/userMedals/{userId}', 'UserMedalController@addMedalToBody');
Route::get('/userMedals/{userId}/{medalId}', 'UserMedalController@getBuddyMedal');
Route::delete('/userMedals/{userId}/{medalId}', 'UserMedalController@deleteBuddyMedal');


/**
 * UserCategories
 */
Route::get('/userCategories/{userId}', 'UserCategoryController@getUserCategories');
Route::post('/userCategories/{userId}', 'UserCategoryController@addUserCategories');
Route::get('/userCategories/{userId}/{categoryId}', 'UserCategoryController@getUserCategory');
Route::put('/userCategories/{userId}/{categoryId}', 'UserCategoryController@updateUserCategory');
Route::delete('/userCategories/{userId}/{categoryId}', 'UserCategoryController@deleteUserCategory');


/**
 * JobRequire
 */
Route::get('/JobRequires/{categoryId}/getTopUsers', 'JobRequireController@getTopUsers');
Route::get('/JobRequires/{categoryId}/getAllJobRequire', 'JobRequireController@getAllJobRequire');
Route::get('/JobRequires/{userId}', 'JobRequireController@getBuddyJobRequire');
Route::post('/JobRequires/{userId}', 'JobRequireController@addBuddyJobRequire');
Route::get('/JobRequires/{userId}/{jobRequireId}', 'JobRequireController@getJobRequire');
Route::put('/JobRequires/{userId}/{jobRequireId}', 'JobRequireController@updateJobRequire');
Route::delete('/JobRequires/{userId}/{jobRequireId}', 'JobRequireController@deleteJobRequire');


/**
 * User
 */
//Route::post('/user/{userId}', 'UserController@getUserCategories');
Route::put('/user', 'UserController@getUserCategories');
Route::get('/user/{userId}', 'UserController@getUserCategories');
Route::put('/user/{userId}', 'UserController@getUserCategories');
Route::delete('/user/{userId}', 'UserController@getUserCategories');
Route::get('/user/{userId}', 'UserController@getUserCategories');


/**
 * Static
 */
Route::get('/static', 'StaticController@getAllStatic');
Route::post('/static', 'StaticController@addStatic');
Route::get('/static/{staticId}', 'StaticController@getStatic');
Route::post('/static/{staticId}', 'StaticController@updateStatic');
Route::delete('/static/{staticId}', 'StaticController@deleteStatic');


/**
 * Activity
 */
Route::post('/activities/{userId}', 'ActivityController@addNewActivity');
Route::get('/activities/{userId}/getAllFutureActivities', 'ActivityController@getAllFutureActivities');
Route::get('/activities/{userId}/getAllMyActivities', 'ActivityController@getAllMyActivities');
Route::get('/activities/{userId}/{activityId}', 'ActivityController@getActivity');
Route::put('/activities/{userId}/{activityId}', 'ActivityController@updateActivity');
Route::delete('/activities/{userId}/{activityId}', 'ActivityController@deleteActivity');
Route::get('/activities/{userId}/{activityId}/getNumberOfViewer', 'ActivityController@getNumberOfViewer');
Route::get('/activities/{userId}/{activityId}/getNumberOfParticipates', 'ActivityController@getNumberOfParticipates');
Route::post('/activities/{userId}/{activityId}/addViewer', 'ActivityController@addViewer');


/**
 * Medals
 */
Route::get('/medals', 'MedalController@getAllMedals');
Route::post('/medals', 'MedalController@addMedal');
Route::get('/medals/{medalId}', 'MedalController@getMedal');
Route::post('/medals/{medalId}', 'MedalController@updateMedal');
Route::delete('/medals/{medalId}', 'MedalController@deleteMedal');
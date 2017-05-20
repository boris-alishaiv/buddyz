<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/

Route::post('/user', [
    'uses' => 'UserController@signup',
]);

Route::post('/user/signin', [
    'uses' => 'UserController@signin'
]);



/**
 * Category
 */
Route::get('/category', [
    'uses' => 'CategoryController@getAllCategory'
]);

Route::post('/category', [
    'uses' => 'CategoryController@addCategory',
    'middleware' => 'Admin'
]);

Route::get('/category/{categoryId}', [
    'uses' => 'CategoryController@getCategory',
]);

Route::put('/category/{categoryId}', [
    'uses' => 'CategoryController@updateCategory',
    'middleware' => 'Admin'
]);

Route::delete('/category/{categoryId}', [
    'uses' => 'CategoryController@deleteCategory',
    'middleware' => 'Admin'
]);


/**
 * BuddyCards
 */
Route::get('/buddyCards/forUser/{userId}', [
    'uses' => 'BuddyCardController@getAllBuddyCards',
    'middleware' => 'AdminOrUser'
]);

Route::post('/buddyCards/forUser/{userId}', [
    'uses' => 'BuddyCardController@addBuddyCards',
    'middleware' => 'AdminOrUser'
]);

Route::get('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@getBuddyCard'
]);

Route::put('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@updateBuddyCard',
    'middleware' => 'auth.jwt'
]);

Route::delete('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@deleteBuddyCard',
    'middleware' => 'auth.jwt'
]);

Route::get('/buddyCards/{cardType}/getTopBuddyCards', [
    'uses' => 'BuddyCardController@getTopBuddyCards',
    'middleware' => 'Admin'
]);

Route::get('/buddyCards/{cardType}/{categoryId}/getAllBuddyCards', [
    'uses' => 'BuddyCardController@getAllBuddyCards',
    'middleware' => 'Admin'
]);

Route::get('/buddyCards/{cardType}/{userId}/getBuddyRecentCards', [
    'uses' => 'BuddyCardController@getBuddyRecentCards',
    'middleware' => 'Admin'
]);


/**
 * Company
 */
Route::get('/company/{userId}', [
    'uses' => 'CompanyController@getAllCompanies',
    'middleware' => 'Admin'
]);

Route::post('/company/{userId}', [
    'uses' => 'CompanyController@addCompany',
    'middleware' => 'Admin'
]);

Route::get('/company/{userId}/{companyId}', [
    'uses' => 'CompanyController@getCompany',
    'middleware' => 'Admin'
]);

Route::put('/company/{userId}/{companyId}', [
    'uses' => 'CompanyController@updateCompany',
    'middleware' => 'Admin'
]);

Route::delete('/company/{userId}/{companyId}', [
    'uses' => 'CompanyController@deleteCompany',
    'middleware' => 'Admin'
]);


/**
 * Medals
 */
Route::get('/medals', 'MedalController@getAllMedals');
Route::post('/medals', 'MedalController@addMedal');
Route::get('/medals/{medalId}', 'MedalController@getMedal');
Route::post('/medals/{medalId}', 'MedalController@updateMedal');
Route::delete('/medals/{medalId}', 'MedalController@deleteMedal');


/**
 * Static
 */
Route::get('/static', 'StaticController@getAllStatic');
Route::post('/static', 'StaticController@addStatic');
Route::get('/static/{staticId}', 'StaticController@getStatic');
Route::post('/static/{staticId}', 'StaticController@updateStatic');
Route::delete('/static/{staticId}', 'StaticController@deleteStatic');


/**
 * Vouches
 */
Route::get('/vouch', 'VouchController@getAllVouches');
Route::get('/vouch/{userId}', 'VouchController@getVouchesByUser');
Route::post('/vouch/{userId}', 'VouchController@addVouchByUser');
Route::delete('/vouch/{userId}', 'VouchController@deleteVouch');
Route::get('/vouch/{userId}/getAllMyVouches', 'VouchController@getAllVouches2');


/**
 * UserCategories
 */
Route::get('/userCategories', 'UserCategoryController@getUserCategories');
Route::post('/userCategories', 'UserCategoryController@addUserCategories');
Route::get('/userCategories/{userCategoryId}', 'UserCategoryController@getUserCategory');
Route::put('/userCategories/{userCategoryId}', 'UserCategoryController@updateUserCategory');
Route::delete('/userCategories/{userCategoryId}', 'UserCategoryController@deleteUserCategory');


/**
 * Activity
 */
Route::post('/activities', [
    'uses' => 'ActivityController@addNewActivity',
    'middleware' => 'auth.jwt'
]);


Route::get('/activities/getActivities', 'ActivityController@getAllFutureActivities');
Route::get('/activities/getAllMyActivities', 'ActivityController@getAllMyActivities');
Route::get('/activities/activityId}', 'ActivityController@getActivity');
Route::put('/activities/{activityId}', 'ActivityController@updateActivity');
Route::delete('/activities/{activityId}', 'ActivityController@deleteActivity');
Route::get('/activities/{activityId}/getNumberOfViewer', 'ActivityController@getNumberOfViewer');
Route::get('/activities/{activityId}/getNumberOfParticipates', 'ActivityController@getNumberOfParticipates');
Route::post('/activities/{activityId}/addViewer', 'ActivityController@addViewer');


/**
 * User
 */
Route::put('/user', 'UserController@updateUser');
Route::get('/user/{userId}', 'UserController@getUserCategories');
Route::put('/user/{userId}', 'UserController@getUserCategories');
Route::delete('/user/{userId}', 'UserController@getUserCategories');
Route::get('/user/{userId}', 'UserController@getUserCategories');


/**
 * Comment
 */
Route::post('/comments/{userId}/(postId)/createComment', [
    'uses' => 'CommentController@createComment',
    'middleware' => 'AdminOrUser'
]);

Route::put('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@updateComment',
    'middleware' => 'AdminOrUser'
]);

Route::delete('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@deleteComment',
    'middleware' => 'AdminOrUser'
]);




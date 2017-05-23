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
//    'middleware' => 'Admin'
]);

Route::get('/category/{categoryId}', [
    'uses' => 'CategoryController@getCategory',
]);

Route::put('/category/{categoryId}', [
    'uses' => 'CategoryController@updateCategory',
//    'middleware' => 'Admin'
]);

Route::delete('/category/{categoryId}', [
    'uses' => 'CategoryController@deleteCategory',
//    'middleware' => 'Admin'
]);


/**
 * BuddyCards
 * BuddyCards
 */
Route::post('/buddyCards/{userId}/addBuddyCard', [
    'uses' => 'BuddyCardController@createBuddyCard',
//    'middleware' => 'AdminOrUser'
]);

Route::get('/buddyCards/getTopBuddyCards', [
    'uses' => 'BuddyCardController@getTopBuddyCards',
//    'middleware' => 'Admin'
]);

Route::get('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@getBuddyCard'
]);

Route::put('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@updateBuddyCard',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@deleteBuddyCard',
//    'middleware' => 'auth.jwt'
]);


Route::get('/buddyCards/{categoryId}/getBuddyCardsByCategory', [
    'uses' => 'BuddyCardController@getBuddyCardsByCategory',
//    'middleware' => 'Admin'
]);

Route::get('/buddyCards/{userId}/getBuddyCards', [
    'uses' => 'BuddyCardController@getBuddyCards',
//    'middleware' => 'Admin'
]);


/**
 * Company
 */
Route::get('/companies/{userId}', [
    'uses' => 'CompanyController@getAllCompanies',
//    'middleware' => 'Admin'
]);

Route::post('/companies/{userId}', [
    'uses' => 'CompanyController@addCompany',
//    'middleware' => 'Admin'
]);

Route::get('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@getCompany',
//    'middleware' => 'Admin'
]);

Route::put('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@updateCompany',
//    'middleware' => 'Admin'
]);

Route::delete('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@deleteCompany',
//    'middleware' => 'Admin'
]);


/**
 * Medals
 */
Route::get('/medals', [
    'uses' => 'MedalController@getAllMedals',
//    'middleware' => 'auth.jwt'
]);

Route::post('/medals', [
    'uses' => 'MedalController@addMedal',
//    'middleware' => 'auth.jwt'
]);

Route::get('/medals/{medalId}', [
    'uses' => 'MedalController@getMedal',
//    'middleware' => 'auth.jwt'
]);

Route::post('/medals/{medalId}', [
    'uses' => 'MedalController@updateMedal',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/medals/{medalId}', [
    'uses' => 'MedalController@deleteMedal',
//    'middleware' => 'auth.jwt'
]);


/**
 * Static
 */
Route::get('/static', [
    'uses' => 'StaticController@getAllStatic',
//    'middleware' => 'auth.jwt'
]);

Route::post('/static', [
    'uses' => 'StaticController@addStatic',
//    'middleware' => 'auth.jwt'
]);

Route::get('/static/{staticId}', [
    'uses' => 'StaticController@getStatic',
//    'middleware' => 'auth.jwt'
]);

Route::post('/static/{staticId}', [
    'uses' => 'StaticController@updateStatic',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/static/{staticId}', [
    'uses' => 'StaticController@deleteStatic',
//    'middleware' => 'auth.jwt'
]);


/**
 * Vouches
 */
Route::get('/vouches', [
    'uses' => 'VouchController@getAllVouches',
//    'middleware' => 'auth.jwt'
]);

Route::post('/vouch/{userId}', [
    'uses' => 'VouchController@createVouch',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/vouch/{userId}', [
    'uses' => 'VouchController@deleteVouch',
//    'middleware' => 'auth.jwt'
]);

Route::put('/vouch/{userId}/{vouchId}', [
    'uses' => 'VouchController@test',
//    'middleware' => 'auth.jwt'
]);

Route::post('/vouch/{userId}/{vouchId}', [
    'uses' => 'VouchController@changeVouchStatus',
//    'middleware' => 'auth.jwt'
]);


/**
 * UserCategories
 */
Route::get('/userCategories/{userId}/match', [
    'uses' => 'UserCategoryController@getUserCategories',
//    'middleware' => 'auth.jwt'
]);

Route::post('/userCategories/{userId}/match', [
    'uses' => 'UserCategoryController@addUserCategories',
//    'middleware' => 'auth.jwt'
]);

Route::get('/userCategories/{userCategoryId}', [
    'uses' => 'UserCategoryController@getUserCategory',
//    'middleware' => 'auth.jwt'
]);

Route::put('/userCategories/{userCategoryId}',[
    'uses' => 'UserCategoryController@updateUserCategory',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/userCategories/{userCategoryId}', [
    'uses' => 'UserCategoryController@deleteUserCategory',
//    'middleware' => 'auth.jwt'
]);


/**
 * Activity
 */
Route::post('/activities/{userId}/addActivity', [
    'uses' => 'ActivityController@addNewActivity',
//    'middleware' => 'auth.jwt'
]);

Route::get('/activities/getActivities', [
    'uses' => 'ActivityController@getAllActivities',
//    'middleware' => 'auth.jwt'
]);

Route::get('/activities/{userId}/getMyActivities', [
    'uses' => 'ActivityController@getUserActivities',
//    'middleware' => 'auth.jwt'
]);

Route::get('/activities/{activityId}', [
    'uses' => 'ActivityController@getActivity',
//    'middleware' => 'auth.jwt'
]);

Route::put('/activities/{activityId}', [
    'uses' => 'ActivityController@editActivity',
//    'middleware' => 'auth.jwt'
]);

Route::delete('/activities/{activityId}', [
    'uses' => 'ActivityController@deleteActivity',
//    'middleware' => 'auth.jwt'
]);

Route::post('/activities/{activityId}/setViewer', [
    'uses' => 'ActivityController@setViewer',
//    'middleware' => 'auth.jwt'
]);


/**
 * User
 */
Route::get('/users', [
    'uses' => 'UserController@getAllUsers',
//    'middleware' => 'AdminOrUser'
]);

Route::post('/user', [
    'uses' => 'UserController@signup',
]);

Route::post('/users/{userId}/profile/setFile', [
    'uses' => 'UserController@uploadFile',
]);

Route::post('/users/{userId}/profile/setCoverPicture', [
    'uses' => 'UserController@uploadCoverImage',
]);

Route::post('/users/{userId}/profile/about', [
    'uses' => 'UserController@setUserAbout',
]);

Route::get('/users/{userId}/profile/myProfile', [
    'uses' => 'UserController@setUserAbout',
]);

Route::post('/users/{userId}/profile/myProfile', [
    'uses' => 'UserController@setUserAbout',
]);

Route::put('/user', [
    'uses' => 'UserController@updateUser',
//    'middleware' => 'AdminOrUser'
]);

Route::put('/users/{activeUserId}/{userId}/watchProfile', [
    'uses' => 'UserController@watchProfile',
//    'middleware' => 'AdminOrUser'
]);

Route::put('/user/{userId}', [
    'uses' => 'UserController@editUser',
//    'middleware' => 'AdminOrUser'
]);

Route::delete('/user/{userId}', [
    'uses' => 'UserController@deleteUser',
//    'middleware' => 'AdminOrUser'
]);


Route::get('/users/{userId}/getCommunity', [
    'uses' => 'UserController@getCommunity',
//    'middleware' => 'AdminOrUser'
]);


/**
 * Comment
 */
Route::post('/comments/{userId}/{postId}/createComment', [
    'uses' => 'CommentController@createComment',
//    'middleware' => 'AdminOrUser'
]);

Route::put('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@updateComment',
//    'middleware' => 'AdminOrUser'
]);

Route::delete('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@deleteComment',
//    'middleware' => 'AdminOrUser'
]);

/**
 * Review
 */
Route::post('/setReview/{userId}', [
    'uses' => 'ReviewController@createReview',
//    'middleware' => ''
]);

Route::put('/setReview/{userId}/{reviewId}', [
    'uses' => 'ReviewController@editReview',
//    'middleware' => ''
]);


/**
 * Like
 */
Route::post('/setLike/{userId}/{postId}', [
    'uses' => 'LikeController@createLike',
//    'middleware' => ''
]);


/**
 * Post
 */
Route::post('/posts/{userId}', [
    'uses' => 'PostController@createPost',
//    'middleware' => ''
]);

Route::get('/post/{userId}/{postId}', [
    'uses' => 'PostController@getPost',
//    'middleware' => ''
]);

Route::put('/post/{userId}/{postId}', [
    'uses' => 'PostController@editPost',
//    'middleware' => ''
]);

Route::delete('/post/{userId}/{postId}', [
    'uses' => 'PostController@deletePost',
//    'middleware' => ''
]);


/**
 * User Medal
 */
Route::get('/userMedals/{userId}', [
    'uses' => 'UserMedalController@getAllBuddyMedal',
//    'middleware' => ''
]);

Route::post('/userMedals/{userId}', [
    'uses' => 'UserMedalController@createBuddyMedal',
//    'middleware' => ''
]);

Route::get('/userMedals/{userId}/{medalId}', [
    'uses' => 'UserMedalController@getBuddyMedal',
//    'middleware' => ''
]);

Route::delete('/userMedals/{userId}/{medalId}', [
    'uses' => 'UserMedalController@deleteBuddyMedal',
//    'middleware' => ''
]);


/**
 * User Activities
 */
Route::get('/userActivities/{userId}/getMyUserActivities', [
    'uses' => 'UserActivityController@getUsersUserActivity',
//    'middleware' => ''
]);

Route::post('/userActivities/{userId}/{activityId}/addUserActivity', [
    'uses' => 'UserActivityController@addUserActivity',
]);

Route::put('/userActivities/{userActivityId}/refuseToBuddyRequest', [
    'uses' => 'UserActivityController@refuseToBuddyRequest',
]);

Route::put('/userActivities/{userActivityId}/refuseToClientRequest', [
    'uses' => 'UserActivityController@refuseToClientRequest',
]);

Route::put('/userActivities/{userActivityId}/acceptBuddyRequest', [
    'uses' => 'UserActivityController@acceptBuddyRequest',
]);

Route::put('/userActivities/{userActivityId}/acceptClientRequest', [
    'uses' => 'UserActivityController@acceptClientRequest',
]);

Route::get('/userActivities/{userActivitiesId}', [
    'uses' => 'UserActivityController@getUserActivity',
//    'middleware' => ''
]);

Route::delete('/userActivities/{userActivitiesId}', [
    'uses' => 'UserActivityController@deleteUserActivity',
//    'middleware' => ''
]);

Route::get('/newsFeed', [
    'uses' => 'NewsFeedController@getNewsFeed',
//    'middleware' => ''
]);


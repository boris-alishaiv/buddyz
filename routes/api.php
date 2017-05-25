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
Route::post('/buddyCards/{userId}/addBuddyCard', [
    'uses' => 'BuddyCardController@createBuddyCard',
    'middleware' => 'AdminOrBuddy'
]);

Route::get('/buddyCards/getTopBuddyCards', [
    'uses' => 'BuddyCardController@getTopBuddyCards',
]);

Route::get('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@getBuddyCard'
]);

Route::put('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@updateBuddyCard',
    'middleware' => 'AdminOrBuddy'
]);

Route::delete('/buddyCards/{buddyCardId}', [
    'uses' => 'BuddyCardController@deleteBuddyCard',
    'middleware' => 'AdminOrBuddy'
]);


Route::get('/buddyCards/{categoryId}/getBuddyCardsByCategory', [
    'uses' => 'BuddyCardController@getBuddyCardsByCategory',
]);

Route::get('/buddyCards/{userId}/getBuddyCards', [
    'uses' => 'BuddyCardController@getBuddyCards',
    'middleware' => 'AdminOrUser'
]);


/**
 * Company
 */
Route::get('/companies/{userId}', [
    'uses' => 'CompanyController@getAllCompanies'
]);

Route::post('/companies/{userId}', [
    'uses' => 'CompanyController@addCompany',
    'middleware' => 'AdminOrClient'
]);

Route::get('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@getCompany',
]);

Route::put('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@updateCompany',
    'middleware' => 'AdminOrClient'
]);

Route::delete('/companies/{userId}/{companyId}', [
    'uses' => 'CompanyController@deleteCompany',
    'middleware' => 'AdminOrClient'
]);


/**
 * Medals
 */
Route::get('/medals', [
    'uses' => 'MedalController@getAllMedals'
]);

Route::post('/medals', [
    'uses' => 'MedalController@addMedal',
    'middleware' => 'Admin'
]);

Route::get('/medals/{medalId}', [
    'uses' => 'MedalController@getMedal'
]);

Route::post('/medals/{medalId}', [
    'uses' => 'MedalController@updateMedal',
    'middleware' => 'Admin'
]);

Route::delete('/medals/{medalId}', [
    'uses' => 'MedalController@deleteMedal',
    'middleware' => 'Admin'
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
    'middleware' => 'Admin'
]);

Route::get('/static/{staticId}', [
    'uses' => 'StaticController@getStatic',
//    'middleware' => 'auth.jwt'
]);

Route::post('/static/{staticId}', [
    'uses' => 'StaticController@updateStatic',
    'middleware' => 'Admin'
]);

Route::delete('/static/{staticId}', [
    'uses' => 'StaticController@deleteStatic',
    'middleware' => 'Admin'
]);


/**
 * Vouches
 */
Route::get('/vouches', [
    'uses' => 'VouchController@getAllVouches',
    'middleware' => 'auth.jwt'
]);

Route::post('/vouch/{userId}', [
    'uses' => 'VouchController@createVouch',
    'middleware' => 'AdminOrUser'
]);

Route::delete('/vouch/{userId}', [
    'uses' => 'VouchController@deleteVouch',
    'middleware' => 'AdminOrUser'
]);

Route::put('/vouch/{userId}/{vouchId}', [
    'uses' => 'VouchController@test',
    'middleware' => 'AdminOrUser'
]);

Route::post('/vouch/{userId}/{vouchId}', [
    'uses' => 'VouchController@changeVouchStatus',
    'middleware' => 'AdminOrUser'
]);


/**
 * UserCategories
 */
Route::get('/userCategories/{userId}/match', [
    'uses' => 'UserCategoryController@getUserCategories'
]);

Route::post('/userCategories/{userId}/match', [
    'uses' => 'UserCategoryController@addUserCategories',
    'middleware' => 'AdminOrBuddy'
]);

Route::get('/userCategories/{userCategoryId}', [
    'uses' => 'UserCategoryController@getUserCategory',
    'middleware' => 'auth.jwt'
]);

Route::put('/userCategories/{userCategoryId}',[
    'uses' => 'UserCategoryController@updateUserCategory',
    'middleware' => 'auth.jwt'
]);

Route::delete('/userCategories/{userCategoryId}', [
    'uses' => 'UserCategoryController@deleteUserCategory',
    'middleware' => 'auth.jwt'
]);


/**
 * Activity
 */
Route::post('/activities/{userId}/addActivity', [
    'uses' => 'ActivityController@addNewActivity',
    'middleware' => 'AdminOrClient'
]);

Route::get('/activities/getActivities', [
    'uses' => 'ActivityController@getAllActivities'
]);

Route::get('/activities/{userId}/getMyActivities', [
    'uses' => 'ActivityController@getUserActivities',
    'middleware' => 'AdminOrClient'
]);

Route::get('/activities/{activityId}', [
    'uses' => 'ActivityController@getActivity'
]);

Route::put('/activities/{activityId}', [
    'uses' => 'ActivityController@editActivity',
    'middleware' => 'auth.jwt'
]);

Route::delete('/activities/{activityId}', [
    'uses' => 'ActivityController@deleteActivity',
    'middleware' => 'auth.jwt'
]);

Route::post('/activities/{activityId}/setViewer', [
    'uses' => 'ActivityController@setViewer'
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
    'middleware' => 'AdminOrBuddy'
]);

Route::put('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@updateComment',
    'middleware' => 'AdminOrBuddy'
]);

Route::delete('/comments/{userId}/{commentId}', [
    'uses' => 'CommentController@deleteComment',
    'middleware' => 'AdminOrBuddy'
]);

/**
 * Review
 */
Route::post('/setReview/{userId}', [
    'uses' => 'ReviewController@createReview',
    'middleware' => 'AdminOrClient'
]);

Route::put('/setReview/{userId}/{reviewId}', [
    'uses' => 'ReviewController@editReview',
    'middleware' => 'AdminOrClient'
]);


/**
 * Like
 */
Route::post('/setLike/{userId}/{postId}', [
    'uses' => 'LikeController@createLike',
    'middleware' => 'AdminOrBuddy'
]);


/**
 * Post
 */
Route::post('/posts/{userId}', [
    'uses' => 'PostController@createPost',
    'middleware' => 'AdminOrBuddy'
]);

Route::get('/post/{userId}/{postId}', [
    'uses' => 'PostController@getPost',
    'middleware' => 'auth.jwt'
]);

Route::put('/post/{userId}/{postId}', [
    'uses' => 'PostController@editPost',
    'middleware' => 'AdminOrBuddy'
]);

Route::delete('/post/{userId}/{postId}', [
    'uses' => 'PostController@deletePost',
    'middleware' => 'AdminOrBuddy'
]);


/**
 * User Medal
 */
Route::get('/userMedals/{userId}', [
    'uses' => 'UserMedalController@getAllBuddyMedal',
    'middleware' => 'AdminOrUser'
]);

Route::post('/userMedals/{userId}', [
    'uses' => 'UserMedalController@createBuddyMedal',
    'middleware' => 'AdminOrUser'
]);

Route::get('/userMedals/{userId}/{medalId}', [
    'uses' => 'UserMedalController@getBuddyMedal',
    'middleware' => 'AdminOrUser'
]);

Route::delete('/userMedals/{userId}/{medalId}', [
    'uses' => 'UserMedalController@deleteBuddyMedal',
    'middleware' => 'AdminOrUser'
]);


/**
 * User Activities
 */
Route::get('/userActivities/{userId}/getMyUserActivities', [
    'uses' => 'UserActivityController@getUsersUserActivity',
    'middleware' => 'AdminOrBuddy'
]);

Route::post('/userActivities/{userId}/{activityId}/addUserActivity', [
    'uses' => 'UserActivityController@addUserActivity',
    'middleware' => 'auth.jwt'
]);

Route::put('/userActivities/{userActivityId}/refuseToBuddyRequest', [
    'uses' => 'UserActivityController@refuseToBuddyRequest'
]);

Route::put('/userActivities/{userActivityId}/refuseToClientRequest', [
    'uses' => 'UserActivityController@refuseToClientRequest'
]);

Route::put('/userActivities/{userActivityId}/acceptBuddyRequest', [
    'uses' => 'UserActivityController@acceptBuddyRequest'
]);

Route::put('/userActivities/{userActivityId}/acceptClientRequest', [
    'uses' => 'UserActivityController@acceptClientRequest'
]);

Route::get('/userActivities/{userActivitiesId}', [
    'uses' => 'UserActivityController@getUserActivity',
    'middleware' => 'auth.jwt'
]);

Route::delete('/userActivities/{userActivitiesId}', [
    'uses' => 'UserActivityController@deleteUserActivity',
    'middleware' => 'auth.jwt'
]);



/**
 * News Feed
 */
Route::get('/newsFeed', [
    'uses' => 'NewsFeedController@getNewsFeed',
    'middleware' => 'auth.jwt'
]);


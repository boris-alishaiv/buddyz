<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use App\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    public function getUsersUserActivity($userId)
    {
        $userActivities = UserActivity::where('user_id', $userId)->get();
        $result = [];
        foreach ($userActivities as $userActivity) {

            $activity = $userActivity->activity;

            $responseObject = new \stdClass();
            $responseObject->id = $userActivity->id;
            $responseObject->initializedBy = $userActivity->initiated_by;
            $responseObject->createdAt = $userActivity->created_at->toDateTimeString();
            $responseObject->status = $userActivity->status;
            $responseObject->activity = new \stdClass();
            $responseObject->activity->id = $activity->id;
            $responseObject->activity->type = $activity->type;
            $responseObject->activity->time = $activity->time;
            $responseObject->activity->location = $activity->location;
            $responseObject->activity->title = $activity->title;
            $responseObject->activity->body = $activity->body;
            $responseObject->activity->image = $activity->image;
            $responseObject->activity->price = $activity->price;
            $responseObject->activity->status = $activity->status;
            $responseObject->activity->createdAt = $activity->created_at->toDateTimeString();

            if ($activity->type != "job") {
                $participant = $activity->user;
                $responseObject->activity->paricipant = new \stdClass();
                $responseObject->activity->paricipant->userId = $participant->id;
                $responseObject->activity->paricipant->firstName = $participant->first_name;
                $responseObject->activity->paricipant->lastName = $participant->last_name;
                $responseObject->activity->paricipant->profilePicture = $participant->profile_picture;
                $responseObject->activity->paricipant->verification = $participant->verification;
            }

            $category = $activity->category;
            $responseObject->activity->category = new \stdClass();
            $responseObject->activity->category->categoryId = $category->id;
            $responseObject->activity->category->logo = $category->logo;
            $responseObject->activity->category->name = $category->name;

            if ($activity->type == "job") {
                $user = $activity->user;
                $responseObject->activity->user = new \stdClass();
                $responseObject->activity->user->userId = $user->id;
                $responseObject->activity->user->firstName = $user->first_name;
                $responseObject->activity->user->lastName = $user->last_name;
                $responseObject->activity->user->profilePicture = $user->profile_picture;
                $responseObject->activity->user->verification = $user->verification;
            }

            array_push($result, $responseObject);
        }
        return response()->json($result, 200);
    }

    public function addUserActivity($userId, $activityId, Request $request)
    {
        $sentByUser = JWTAuth::parseToken()->toUser();

        if ($sentByUser->type != 'admin' && !($sentByUser->type == 'admin' && $sentByUser->user_id == $userId) &&
            !($sentByUser->type != 'businessClient' && $userId == Activity::find($activityId)->user_id)) {
            return response()->json('Permission denied',404);
        }

        $userActivity = new UserActivity();
        $userActivity->user_id = $userId;
        $userActivity->activity_id = $activityId;
        $userActivity->initiated_by = User::find($userId)->type;
        $userActivity->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $userActivity
        ],200);
    }

    public function getUserActivity($userActivityId)
    {
        if (! $userActivity = UserActivity::find($userActivityId)) {
            return response()->json('Invalid UserActivity id',404);
        }

        $userActivity->activity = Activity::find($userActivity->activity_id);
        return response()->json($userActivity, 200);
    }

    public function deleteUserActivity($userActivityId)
    {
        if (! $userActivity = UserActivity::find($userActivityId)) {
            return response()->json('Invalid UserActivity id',404);
        }

        $userActivity->delete();
        return response()->json('successful operation',202);
    }








    public function refuseToBuddyRequest($userActivityId, Request $request)
    {
        return response()->json('Missing Implementation',400);
    }

    public function refuseToClientRequest($userActivityId, Request $request)
    {
        return response()->json('Missing Implementation',400);
    }

    public function acceptBuddyRequest($userActivityId, Request $request)
    {
        return response()->json('Missing Implementation',400);
    }

    public function acceptClientRequest($userActivityId, Request $request)
    {
        return response()->json('Missing Implementation',400);
    }

}

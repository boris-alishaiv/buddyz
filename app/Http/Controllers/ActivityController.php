<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function addNewActivity(Request $request, $userId)
    {
        $this->validate($request, [
            'categoryId' => 'required',
            'time' => 'required',
            'body' => 'required',
            'location' => 'required'
        ]);

        $activity = new Activity();
        $activity->user_id = $userId;
        $activity->category_id = $request['categoryId'];
        $activity->time = $request['time'];
        $activity->body = $request['body'];
        $activity->location = $request['location'];
        if (isset($request['type'])) $activity->type = $request['type'];
        if (isset($request['title'])) $activity->title = $request['title'];
        if (isset($request['price'])) $activity->price = $request['price'];
        if (isset($request['status'])) $activity->status = $request['status'];
        if (isset($request['maxParticipants'])) $activity->max_participants = $request['maxParticipants'];
        $activity->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $activity
        ],200);
    }


    public function getAllActivities(Request $request)
    {
        if (!isset($request['activityType'])) {
            return response()->json('Missing Input',404);
        }

        $activities = Activity::where("type", $request['activityType'])
            ->where("permission", "public")
            ->get();

        $result = [];
        if ($request['activityType'] == 'job') {

            foreach ($activities as $activity) {

                $user = $activity->user;
                $category = $activity->category;

                $responseObject = new \stdClass();
                $responseObject->id = $activity->id;
                $responseObject->user = new \stdClass();
                $responseObject->user->userId = $user->id;
                $responseObject->user->firstName = $user->first_name;
                $responseObject->user->lastName = $user->last_name;
                $responseObject->user->profilePicture = $user->profile_picture;
                $responseObject->user->verification = $user->verification;
                $responseObject->category = new \stdClass();
                $responseObject->category->categoryId = $category->id;
                $responseObject->category->logo = $category->logo;
                $responseObject->category->name = $category->name;
                $responseObject->time = $activity->time;
                $responseObject->body = $activity->body;
                $responseObject->price = $activity->price;
                $responseObject->location = $activity->location;
                $responseObject->createdAt = $activity->created_at->toDateTimeString();
                $responseObject->updatedAt = $activity->updated_at->toDateTimeString();

                array_push($result, $responseObject);
            }

        } elseif ($request['activityType'] == 'event' || $request['activityType'] == 'volunteering') {

            foreach ($activities as $activity) {


                $category = $activity->category;
                $responseObject = new \stdClass();
                $responseObject->id = $activity->id;
                $responseObject->category = new \stdClass();
                $responseObject->category->categoryId = $category->id;
                $responseObject->category->logo = $category->logo;
                $responseObject->category->name = $category->name;
                $responseObject->time = $activity->time;
                $responseObject->body = $activity->body;
                $responseObject->head = $activity->title;
                $responseObject->image = $activity->image;
                $responseObject->price = $activity->price;
                $responseObject->maxParticipants = $activity->max_participants;
                $responseObject->location = $activity->location;
                $responseObject->createdAt = $activity->created_at->toDateTimeString();
                $responseObject->updatedAt = $activity->updated_at->toDateTimeString();
                $responseObject->participants = [];

                foreach ($activity->userActivities as $userActivity) {
                    $participant = User::find($userActivity->user_id);
                    $temp = new \stdClass();
                    $temp->userId = $participant->id;
                    $temp->firstName = $participant->first_name;
                    $temp->lastName = $participant->last_name;
                    $temp->profilePicture = $participant->profile_picture;
                    $temp->verification = $participant->verification;
                    array_push($responseObject->participants, $temp);
                }

                array_push($result, $responseObject);
            }
        }

        return response()->json($result,200);
    }


    public function getUserActivities($userId)
    {
        $activities = Activity::where("user_id", $userId)->get();
        $result = [];


        foreach ($activities as $activity) {

            $category = $activity->category;

            $responseObject = new \stdClass();
            $responseObject->id = $activity->id;
            $responseObject->time = $activity->time;
            $responseObject->body = $activity->body;
            $responseObject->price = $activity->price;
            $responseObject->location = $activity->location;
            $responseObject->createdAt = $activity->created_at->toDateTimeString();
            $responseObject->updatedAt = $activity->updated_at->toDateTimeString();
            $responseObject->category = new \stdClass();
            $responseObject->category->categoryId = $category->id;
            $responseObject->category->logo = $category->logo;
            $responseObject->category->name = $category->name;
            $responseObject->userActivities = [];

            foreach ($activity->userActivities as $userActivity) {

                $participant = User::find($userActivity->user_id);

                $temp = new \stdClass();
                $temp->id = $userActivity->id;
                $temp->initizlizedBy = $userActivity->initiated_by;
                $temp->createdAt = $userActivity->created_at->toDateTimeString();
                $temp->status = $userActivity->status;
                $temp->buddy = new \stdClass();
                $temp->buddy->userId = $participant->id;
                $temp->buddy->firstName = $participant->first_name;
                $temp->buddy->lastName = $participant->last_name;
                $temp->buddy->profilePicture = $participant->profile_picture;
                $temp->buddy->verification = $participant->verification;

                array_push($responseObject->userActivities, $temp);
            }

            array_push($result, $responseObject);
        }

        return response()->json($result,200);
    }

    public function getActivity($activityId)
    {
        if ($activity = Activity::find($activityId)) {
            $activity->user = $activity->user;
            $activity->category = $activity->category;

            return response()->json([
                'message' => "successful operation",
                'data'    => $activity
            ],200);
        }

        return response()->json('Activity not found',404);
    }

    public function editActivity(Request $request, $activityId)
    {
        if (! $activity = Activity::find($activityId)) {
            return response()->json('Activity not found',404);
        }

        if (isset($request['categoryId']))  $activity->category_id = $request['categoryId'];
        if (isset($request['userId']))  $activity->user_id = $request['userId'];
        if (isset($request['time'])) $activity->time = $request['time'];
        if (isset($request['title'])) $activity->title = $request['title'];
        if (isset($request['body'])) $activity->body = $request['body'];
        if (isset($request['image'])) $activity->image = $request['image'];
        if (isset($request['price'])) $activity->price = $request['price'];
        if (isset($request['location'])) $activity->location = $request['location'];
        if (isset($request['status'])) $activity->status = $request['status'];
        if (isset($request['numberOfBuddyzRefusals'])) $activity->number_of_buddyz_refusals = $request['numberOfBuddyzRefusals'];
        if (isset($request['numberOfViews'])) $activity->number_of_views = $request['numberOfViews'];
        if (isset($request['numberOfParticipants'])) $activity->number_of_participants = $request['numberOfParticipants'];
        if (isset($request['maxParticipants'])) $activity->max_participants = $request['maxParticipants'];
        if (isset($request['permission'])) $activity->permission = $request['permission'];
        $activity->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $activity
        ],200);

    }

    public function deleteActivity($activityId)
    {
        if (! $activity = Activity::find($activityId)) {
            return response()->json('Activity not found',404);
        }

        $activity->delete();
        return response()->json('successful operation',202);
    }

    public function setViewer($activityId)
    {
        return response()->json('Missing implementation',400);
    }

}

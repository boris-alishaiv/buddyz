<?php

namespace App\Http\Controllers;

use App\Activity;
use App\BuddyCard;
use App\Post;
use App\User;
use App\Vouch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

class NewsFeedController extends Controller
{
    public function getNewsFeed(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        if ($user->type != "admin" && $user->type != "privateClient" && $user->type != "buddy") {
            return response()->json(['error' => 'Permission denied'], 400);
        }

//        $fromDate = "2017-05-03 00:00:00";
//        $user = User::find(1);

        // request params
        $amount = $request['amount'] ? $request['amount'] : 25;
        $fromDate = $request['fromDate'] ? $request['fromDate'] : Carbon::create()->toDateTimeString();

        $idArr = [];
        $collection = [];
        $vouchedUsersIdArr = Vouch::where("user_id_post", $user->id)->get(['user_id_get']);
        foreach ($vouchedUsersIdArr as $id) array_push($idArr, $id->user_id_get);


        $activitiesEvent = Activity::whereIn('type', ['event', 'volunteering'])->where('created_at', '<', $fromDate)->get();
        foreach ($activitiesEvent as $activity) {
            $category = $activity->category;
            $temp = new \stdClass();
            $temp->type= "event/volunteering";
            $temp->id = $activity->id;
            $temp->time = $activity->time;
            $temp->body = $activity->body;
            $temp->head = $activity->title;
            $temp->image = $activity->image;
            $temp->price = $activity->price;
            $temp->maxParticipations = $activity->max_participants;
            $temp->location = $activity->location;
            $temp->createdAt = $activity->created_at->toDateTimeString();

            $temp->category = new \stdClass();
            $temp->category->id = $category->id;
            $temp->category->name = $category->name;
            $temp->category->logo = $category->logo;

            $temp->participants = [];
            foreach ($activity->userActivities as $userActivity) {
                $tempUser = User::find($userActivity->user_id);
                $participant = new \stdClass();
                $participant->id = $tempUser->id;
                $participant->firstName = $tempUser->first_name;
                $participant->lastName = $tempUser->last_name;
                $participant->profilePicture = $tempUser->profile_picture;
                $participant->vouch = Vouch::where('user_id_post', $user->id)->where('user_id_get', $tempUser->id)->first() ? true : false;
                $participant->verification = $tempUser->verification;
                array_push($temp->participants, $participant);
            }

            array_push($collection, $temp);
        }

        $buddyCards = BuddyCard::where("permission", "public")->where('created_at', '<', $fromDate);
        if ($user->type == 'buddy') {
            $buddyCards = $buddyCards->whereIn('user_id', $idArr);
        }
        $buddyCards = $buddyCards->get();

        foreach ($buddyCards as $buddyCard) {
            $category = $buddyCard->category;
            $tempUser = $buddyCard->user;

            $temp = new \stdClass();
            $temp->type= "buddyCard";
            $temp->id = $buddyCard->id;
            $temp->price = $buddyCard->price;
            $temp->schedule = $buddyCard->schedule;
            $temp->createdAt = $buddyCard->created_at->toDateTimeString();
            $temp->description = $buddyCard->description;
            $temp->category = new \stdClass();
            $temp->category->id = $category->id;
            $temp->category->name = $category->name;
            $temp->category->logo = $category->logo;
            $temp->user = new \stdClass();
            $temp->user->id = $tempUser->id;
            $temp->user->firstName = $tempUser->first_name;
            $temp->user->lastName = $tempUser->last_name;
            $temp->user->profilePicture = $tempUser->profile_picture;
            $temp->user->vouch = Vouch::where('user_id_post', $user->id)->where('user_id_get', $tempUser->id)->first() ? true : false;
            $temp->user->verification = $tempUser->verification;
            array_push($collection, $temp);
        }


        if ($user->type == 'buddy') {

            // get posts
            $posts = Post::where('status_in_table', 'active')->whereIn('user_id', $idArr)->where('created_at', '<', $fromDate)->get();
            foreach ($posts as $post) {
                $tempUser = $post->user;

                $temp = new \stdClass();
                $temp->type= "post";
                $temp->id = $post->id;
                $temp->content = $post->content;
                $temp->status = $post->status_in_table;
                $temp->createdAt = $post->created_at->toDateTimeString();
                $temp->likes = $post->likes;
                $temp->user = new \stdClass();
                $temp->user->id = $tempUser->id;
                $temp->user->firstName = $tempUser->first_name;
                $temp->user->lastName = $tempUser->last_name;
                $temp->user->profilePicture = $tempUser->profile_picture;
                $temp->user->vouch = $tempUser->vouch;
                $temp->user->verification = $tempUser->verification;
                array_push($collection, $temp);
            }

            // get job activities
            $activitiesJob = Activity::where('type', 'job')->where('permission', 'public')->where('created_at', '<', $fromDate)->get();
            foreach ($activitiesJob as $activity) {
                $category = $activity->category;
                $tempUser = $activity->user;

                $temp = new \stdClass();
                $temp->type= "job";
                $temp->id = $activity->id;
                $temp->time = $activity->time;
                $temp->body = $activity->body;
                $temp->price = $activity->price;
                $temp->location = $activity->location;
                $temp->createdAt = $activity->created_at->toDateTimeString();

                $temp->category = new \stdClass();
                $temp->category->id = $category->id;
                $temp->category->name = $category->name;
                $temp->category->logo = $category->logo;

                $temp->user = new \stdClass();
                $temp->user->id = $tempUser->id;
                $temp->user->firstName = $tempUser->first_name;
                $temp->user->lastName = $tempUser->last_name;
                $temp->user->profilePicture = $tempUser->profile_picture;
                $temp->user->vouch = Vouch::where('user_id_post', $user->id)->where('user_id_get', $tempUser->id)->first() ? true : false;
                $temp->user->verification = $tempUser->verification;

                array_push($collection, $temp);
            }

        }

        // sort
        $result = collect($collection)->sortBy(function($col)
        {
            return $col->createdAt;
        })->values()->take($amount)->all();

        return response()->json($result, 200);
    }

}

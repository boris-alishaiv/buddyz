<?php

namespace App\Http\Controllers;

use App\Activity;
use App\BuddyCard;
use App\Post;
use App\User;
use App\Vouch;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    public function getNewsFeed()
    {
//        $user = JWTAuth::parseToken()->toUser();
        $user = User::find(1);

        $idArr = [];
        $vouchedUsersIdArr = Vouch::where("user_id_post", $user->id)->get(['user_id_get']);
        foreach ($vouchedUsersIdArr as $id) array_push($idArr, $id->user_id_get);

        $collection = [];

        $activities1 = Activity::whereIn('type', ['event', 'volunteering'])->get();
        foreach ($activities1 as $activity) {
            $category = $activity->category;
            $temp = new \stdClass();
            $temp->type= "\"event/volunteering\"";
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

            dd($activity->userActivities);

            $temp->participants = [];

            array_push($collection, $temp);
        }




        if ($user->type == 'buddy') {

            $buddyCards = BuddyCard::where("permission", "public")->whereIn('user_id', $idArr)->get();
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
                $temp->user->vouch = $tempUser->vouch;
                $temp->user->verification = $tempUser->verification;
                array_push($collection, $temp);
            }

            $posts = Post::where('status_in_table', 'active')->whereIn('user_id', $idArr)->get();
            foreach ($posts as $post) {
                $tempUser = $post->user;
                $temp = new \stdClass();
                $temp->type= "post";
                $temp->id = $post->id;
                $temp->content = $post->content;
                $temp->status = $post->status_in_table;
                $temp->createdAt = $post->created_at->toDateTimeString();
                $temp->user = new \stdClass();
                $temp->user->id = $tempUser->id;
                $temp->user->firstName = $tempUser->first_name;
                $temp->user->lastName = $tempUser->last_name;
                $temp->user->profilePicture = $tempUser->profile_picture;
                $temp->user->vouch = $tempUser->vouch;
                $temp->user->verification = $tempUser->verification;
                array_push($collection, $temp);
            }



            $activities2 = Activity::where('type', 'job')->where('permission', 'public')->get();

            $merged = $buddyCards->merge($posts);
//            dd($merged->toArray());



//            dd($posts->toArray());
//            dd($buddyCards->toArray());

        }

        return response()->json($collection, 200);
    }

}

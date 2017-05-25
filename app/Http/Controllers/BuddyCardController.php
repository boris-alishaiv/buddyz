<?php

namespace App\Http\Controllers;

use App\BuddyCard;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class BuddyCardController extends Controller
{
    public function createBuddyCard($userId, Request $request)
    {
        $this->validate($request, [
            'categoryId' => 'required',
            'description' => 'required',
            'price' => 'required',
            'schedule' => 'required'
        ]);

        $buddyCard = new BuddyCard();
        $buddyCard->user_id = $userId;
        $buddyCard->category_id = $request['categoryId'];
        $buddyCard->description = $request['description'];
        $buddyCard->price = $request['price'];
        $buddyCard->schedule = $request['schedule'];
        if (isset($request['permission'])) $buddyCard->permission = $request['permission'];

        $buddyCard->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $buddyCard
        ],200);
    }


    public function getBuddyCard($buddyCardId)
    {
        $buddyCard = BuddyCard::find($buddyCardId);
        if ($buddyCard) {
            return response()->json($buddyCard->with('user')->get(),200);
        }

        return response()->json('Buddy Card not found',404);
    }

    public function updateBuddyCard(Request $request, $buddyCardId)
    {
        if (! $buddyCard = BuddyCard::find($buddyCardId)) {
            return response()->json('Buddy Card not found',404);
        }

        if (isset($request['categoryId']))  $buddyCard->category_id = $request['categoryId'];
        if (isset($request['description'])) $buddyCard->description = $request['description'];
        if (isset($request['price'])) $buddyCard->price = $request['price'];
        if (isset($request['schedule'])) $buddyCard->schedule = $request['schedule'];
        if (isset($request['permission'])) $buddyCard->permission = $request['permission'];
        $buddyCard->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $buddyCard
        ],200);
    }


    public function deleteBuddyCard($buddyCardId)
    {
        if (! $buddyCard = BuddyCard::find($buddyCardId)) {
            return response()->json('Buddy Card not found',404);
        }

        $buddyCard->delete();
        return response()->json('successful operation',202);
    }

    public function getTopBuddyCards()
    {

        $categories = [];
        $result = [];
        $buddyCards = BuddyCard::where("permission", "public")->with('user')->get();

        foreach ($buddyCards as $buddyCard) {

            $user = $buddyCard->user;
            $card = new \stdClass();
            $card->cardId = $buddyCard->id;
            $card->createAt = $buddyCard->created_at->toDateTimeString();
            $card->price = $buddyCard->price;
            $card->description = $buddyCard->description;
            $card->schedule = $buddyCard->schedule;
            $card->user = new \stdClass();
            $card->user->userId = $user->id;
            $card->user->profilePicture = $user->profile_picture;
            $card->user->firstName = $user->first_name;
            $card->user->lastName = $user->last_name;
            $card->user->score = $user->score;
            $card->user->verification = $user->verification;

            if (array_key_exists($buddyCard->category_id, $categories)) {

                if (count($categories[$buddyCard->category_id]->topCards) > 4) {
                    continue;
                }
                array_push($categories[$buddyCard->category_id]->topCards, $card);

            } else {

                $category = $buddyCard->category;

                // create new category
                $categoryObject = new \stdClass();
                $categoryObject->categoryId = $category->id;
                $categoryObject->name = $category->name;
                $categoryObject->logo = $category->logo;
                $categoryObject->image = $category->image;
                $categoryObject->description = $category->description;
                $categoryObject->topCards = [];
                array_push($categoryObject->topCards, $card);

                $categories[$buddyCard->category_id] = $categoryObject;
            }
        }

        foreach ($categories as $key => $value) {
            array_push($result, $value);
        }

        return response()->json($result,200);
    }



    public function getBuddyCardsByCategory($categoryId)
    {
        $buddyCards = BuddyCard::where("category_id", $categoryId)->get();
        $category = Category::find($categoryId);

        $result = new \stdClass();
        $result->categoryId = $category->id;
        $result->name = $category->name;
        $result->logo = $category->logo;
        $result->image = $category->image;
        $result->description = $category->description;
        $result->topCards = [];

        foreach ($buddyCards as $buddyCard) {
            $user = $buddyCard->user;
            $card = new \stdClass();
            $card->cardId = $buddyCard->id;
            $card->createAt = $buddyCard->created_at->toDateTimeString();
            $card->price = $buddyCard->price;
            $card->description = $buddyCard->description;
            $card->schedule = $buddyCard->schedule;
            $card->user = new \stdClass();
            $card->user->userId = $user->id;
            $card->user->profilePicture = $user->profile_picture;
            $card->user->firstName = $user->first_name;
            $card->user->lastName = $user->last_name;
            $card->user->score = $user->score;
            $card->user->verification = $user->verification;
            array_push($result->topCards, $card);
        }
        
        return response()->json($result,200);
    }

    public function getBuddyCards($userId)
    {
        $result = [];
        foreach (BuddyCard::where("user_id", $userId)->get() as $buddyCard) {
            $category = $buddyCard->category;
            $responseObject = new \stdClass();
            $responseObject->cardId = $buddyCard->id;
            $responseObject->createAt = $buddyCard->id;
            $responseObject->price = $buddyCard->id;
            $responseObject->description = $buddyCard->id;
            $responseObject->schedule = $buddyCard->id;
            $responseObject->category = new \stdClass();;
            $responseObject->category->categoryId = $category->id;
            $responseObject->category->logo = $category->logo;
            $responseObject->category->name = $category->name;
            array_push($result, $responseObject);
        }

        return response()->json($result,200);
    }

}

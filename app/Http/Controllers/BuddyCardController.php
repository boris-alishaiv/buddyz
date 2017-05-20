<?php

namespace App\Http\Controllers;

use App\BuddyCard;
use Illuminate\Http\Request;
use JWTAuth;

class BuddyCardController extends Controller
{
    public function getAllBuddyCards($userId)
    {
        $buddyCards = BuddyCard::where('user_id', $userId);
        return response()->json($buddyCards, 200);
    }

    public function addBuddyCards($userId)
    {

    }

    public function getBuddyCard()
    {

    }

    public function updateBuddyCard()
    {

    }

    public function deleteBuddyCard()
    {

    }

    public function getTopBuddyCards()
    {

    }

    public function getBuddyRecentCards()
    {

    }

}

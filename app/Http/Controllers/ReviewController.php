<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function createReview(Request $request, $userId)
    {
        $this->validate($request, [
            'getUserId' => 'required',
            'content' => 'required',
            'rating' => 'required'
        ]);

        if (User::find($request['getUserId'])->type != "buddy") {
            return response()->json('Reviewed user must be of type buddy',404);
        }

        $review = new Review();
        $review->post_user_id = $userId;
        $review->get_user_id = $request['getUserId'];
        $review->content = $request['content'];
        $review->rating = $request['rating'];
        $review->save();

        return response()->json(
            [
                'message'=> 'successful operation',
                'data' => $review
            ],200);
    }

    public function editReview(Request $request, $userId, $reviewId)
    {
        if (! $review = Review::find($reviewId)) {
            return response()->json('Review not found',404);
        }

        if ($review->post_user_id != $userId) {
            return response()->json('Permission denied',404);
        }

        if (isset($request['content']))  $review->content = $request['content'];
        if (isset($request['getUserId'])) $review->get_user_id = $request['getUserId'];
        if (isset($request['rating'])) $review->rating = $request['rating'];
        $review->save();

        return response()->json(
            [
                'message'=> 'successful operation',
                'data' => $review
            ],200);
    }

}

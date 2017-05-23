<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function createLike(Request $request, $userId, $postId)
    {
        if ($like = Like::where('user_id', $userId)->where('post_id', $postId)->first()) {

            if ($like->status == 'like') {
                $like->status = "unlike";
            }
            else {
                $like->status = "like";
            }

            return response()->json(
                [
                    'message'=> 'successful operation',
                    'data' => $like
                ],200);
        }

        $this->validate($request, [
            'type' => 'required',
            'status' => 'required'
        ]);

        $like = new Like();
        $like->post_id = $postId;
        $like->user_id = $userId;
        $like->type = $request['type'];
        $like->status = $request['status'];
        $like->save();

        return response()->json(
            [
                'message'=> 'successful operation',
                'data' => $like
            ],200);
    }
}

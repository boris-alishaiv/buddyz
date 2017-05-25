<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;

class PostController extends Controller
{

    public function createPost(Request $request, $userId)
    {
        $this->validate($request, [
            'content' => 'required',
            'likes' => 'required'
        ]);

        $post = new Post();
        $post->user_id = $userId;
        $post->content = $request['content'];
        $post->likes = $request['likes'];
        $post->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $post
        ],200);
    }

    public function getPost($userId, $postId)
    {
        $userType = JWTAuth::parseToken()->toUser()->type;
        if ($userType != "privateClient" && $userType != "buddy" && $userType != "admin" ) {
            return response()->json(['error' => 'Permission denied'], 400);
        }

        if (! $post = Post::find($postId) ) {
            return response()->json('Post not found',404);
        }

        return response()->json([
            'message' => "successful operation",
            'data'    => $post->with('comments', 'user', 'media')->get()
        ],200);

    }

    public function editPost(Request $request, $userId, $postId)
    {
        $post = Post::where('id', $postId)->where('user_id', $userId)->first();
        if (!$post) {
            return response()->json('Post not found',404);
        }

        if (isset($request['content']))  $post->content = $request['content'];
        if (isset($request['likes'])) $post->likes = $request['likes'];
        $post->save();

        return response()->json(
            [
                'message'=> 'successful operation',
                'data' => $post
            ],200);
    }

    public function deletePost($userId, $postId)
    {
        if (! $post = Post::where('id', $postId)->where('user_id', $userId)->first()) {
            return response()->json('Post not found',404);
        }

        $post->delete();
        return response()->json('successful operation',202);
    }

}

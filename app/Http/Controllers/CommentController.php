<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function createComment(Request $request, $userId, $postId)
    {
        //TODO: check if private client has permission to create comments

        if (!isset($request['content']) || !isset($request['status'])){
            return response()->json('missing parameters',400);
        }

        $comment = new Comment();
        $comment->userId = $userId;
        $comment->postId = $postId;
        $comment->content = $request['content'];
        $comment->status = $request['status'];
        $comment->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $comment
        ],200);
    }

    public function updateComment(Request $request, $userId, $commentId)
    {
        if (! $comment = Comment::find($commentId)) {
            return response()->json('Comment not found',404);
        }

        if (isset($request['content']))  $comment->content = $request['content'];
        if (isset($request['status'])) $comment->status = $request['status'];
        $comment->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $comment
        ],200);
    }

    public function deleteComment(Request $request, $userId, $commentId)
    {
        if (! $comment= Category::find($commentId)) {
            return response()->json('Comment not found',404);
        }

        $comment->delete();
        return response()->json('successful operation',202);
    }



}

<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function createComment(Request $request, $userId, $postId)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->user_id = $userId;
        $comment->post_id = $postId;
        $comment->content = $request['content'];
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

        if ($comment->user_id != $userId) {
            return response()->json('Comment not found',404);
        }

        if (isset($request['content']))  $comment->content = $request['content'];
        $comment->save();

        return response()->json([
            'message' => "successful operation",
            'data'    => $comment
        ],200);
    }

    public function deleteComment(Request $request, $userId, $commentId)
    {
        if (! $comment= Comment::find($commentId)) {
            return response()->json('Comment not found',404);
        }

        if ($comment->user_id != $userId) {
            return response()->json('Comment not found',404);
        }

        $comment->delete();
        return response()->json('successful operation',202);
    }



}

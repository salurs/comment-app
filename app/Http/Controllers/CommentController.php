<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments()
    {
        $comments = Comment::with('allChildren')->whereParentId(null)->orderByDesc('created_at')->get();
        return response()->json($comments,200);
    }
    public function saveComments(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'message'=>'required',
        ]);
        $comment = new Comment;
        $comment->name = $request->name;
        $comment->body = $request->message;
        $comment->parent_id = isset($request->parent_id) ? $request->parent_id : null;
        $comment->post_id = 1;
        $is_save = $comment->save();

        if($is_save)
            return response()->json("Successfull",200);

        return response()->json("Error",403);
    }
}

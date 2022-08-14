<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = User::with('comments')->findOrFail($id);
        // return $user;

        return view('index', compact('user'));
    }

    public function userCommentForm(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->password === $user->password) {
            $comment = Comment::where('user_id', $request->id)->findOrFail();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $request->comment;
            $comment->comment = $new_comment;
            $comment->update();
        }
    }

    public function userCommentJson(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->password === $user->password) {
            $comment = Comment::where('user_id', $request->id)->findOrFail();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $request->comment;
            $comment->comment = $new_comment;
            $comment->update();
        }
    }
}

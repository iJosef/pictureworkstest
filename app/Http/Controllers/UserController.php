<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addComment(Request $request)
    {
        return view('add-comment');
    }

    public function index(Request $request, $id)
    {
        $user = User::with('comments')->findOrFail($id);

        return view('index', compact('user'));
    }

    public function userCommentForm(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($request->password === $user->password) {
            $comment = Comment::where('user_id', $request->id)->first();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $request->comment;
            $comment->comment = $new_comment;
            if ($comment->update()) {
                return redirect()->route('show_user', ['id' => $request->id]);
            } else {
                return redirect()->back()->withInput();
            }

        }
    }

    public function userCommentJson(Request $request)
    {
        $user = User::findOrFail($request->id);

        if ($request->password === $user->password) {
            $comment = Comment::where('user_id', $request->id)->first();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $request->comment;
            $comment->comment = $new_comment;
            if ($comment->update()) {
                $data = [
                    'status' => 'success',
                    'message' => 'comment appened successfully'
                ];
                return response()->json($data, 201);
            }else {
                $data = [
                    'status' => 'error',
                    'message' => 'An error occured'
                ];
                return response()->json($data, 500);
            }
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Password'
            ];
            return response()->json($data, 400);
        }
    }
}

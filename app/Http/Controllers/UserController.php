<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppendCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function userCommentForm(AppendCommentRequest $request)
    {
        $validator = $request->validated()->withInput();

        $user = User::where('id',$request->id)->first();

        if ($user == null) {
            return redirect()->back()->withErrors(['invalid user id'])->withInput();
        }

        if (strtoupper($request->password) === $user->password) {
            $comment = Comment::where('user_id', $request->id)->first();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $request->comment;
            $comment->comment = $new_comment;
            if ($comment->update()) {
                return redirect()->route('show_user', ['id' => $request->id]);
            } else {
                return redirect()->back()->withInput();
            }

        } else {
            return redirect()->back()->withErrors('wrong password')->withInput();
        }
    }

    public function userCommentJson(AppendCommentRequest $request)
    {
        $request->validated();

        $user = User::where('id',$request->id)->first();

        if (!$user) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid user id'
            ];
            return response()->json($data, 400);
        }

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

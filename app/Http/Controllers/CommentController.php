<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        $request->validate([
            'comment_body' . $post_id => 'required|max:150'
        ],
        [
            'comment_body' . $post_id . '.required' =>  'You cannot submit an empty comment.',
            'comment_body' . $post_id . '.max'      =>  'The comment must not have more than 150 characters.'
        ]
    );

        $this->comment->body = $request->input('comment_body' . $post_id); //input allows you to be specific in finding the value.
        $this->comment->user_id = Auth::user()->id; //id in auth user means the user id of the logged in user.
        $this->comment->post_id = $post_id;
        $this->comment->save();

        return redirect()->route('post.show', $post_id);
    }

    public function destroy($id)
    {
        $this->comment->destroy($id);
        return redirect()->back();
    }
}

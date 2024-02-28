<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id; 
        $comment->parent_id = $request->parent_id;
        $comment->course_id = $courseId;

        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Comment;
use Illuminate\Validation\ValidationException;



class CommentController extends Controller
{
    public function store(Request $request, $courseId)
    {
        try {
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

        } catch(ValidationException $e) {
            Log::error('Error while sending comment: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while sending comment: '. $e->getMessage());
        
        } catch(\Exception $e) {
            Log::error('Error while sending comment: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error sending comment');
        }
    }
}

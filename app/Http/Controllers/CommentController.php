<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\PostJob;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Save binh luan
        $comment = new Comment;
        $comment->customer_id = $request->customer_id;
        $comment->customer_name = $request->customer_name;

        $comment->comment_content = $request->comment_content;
        $comment->rating = $request->rating;

        $product = PostJob::find($request->post_job_id);   
     
        $product->comments()->save($comment);
        return $product->comments;
    } 
}

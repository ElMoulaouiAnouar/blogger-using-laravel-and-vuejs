<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    //
   

    public function store(CommentRequest $request){
        if(Comment::create([
            'comment_content' => $request->content,
             'post_id' => $request->post_id,
             'user_id' => $request->user_id
            ])){

                return response()->json([
                    'success' => true
                ]);
        }
    }


    public function all(){
        return Comment::all();
    }
}

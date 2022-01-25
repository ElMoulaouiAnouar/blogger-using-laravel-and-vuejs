<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_content'];


    //////////////////// begin relationShip /////////////////////////////////

    public function post(){
        return $this->belongsTo(Post::class,'comment_id','id');
    }

    //////////////////// end relationShip /////////////////////////////////
}

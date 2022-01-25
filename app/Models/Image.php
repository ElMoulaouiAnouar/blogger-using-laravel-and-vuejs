<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'];

     //////////////////// begin relationShip /////////////////////////////////

    public function post(){
        return $this->hasOne(Post::class,'image_id','id');
    }

     //////////////////// end relationShip ////////////////////////////////
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post_title','post_content','image_id','user_id','visitor'];

     //////////////////// begin relationShip /////////////////////////////////

     //relation between post and image (one to one)
    public function image(){
        return $this->belongsTo(Image::class,'image_id','id');
    }

    //relation between post and user (one to many)
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //relation between post and comment (one to many)
    public function comment(){
        return $this->hasMany(Comment::class,'comment_id','id');
    }


    //relation between post and tag (many to many)
    public function tag(){
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id');
    }

    public function categorie(){
        return $this->belongsToMany(Categorie::class,'post_categories','post_id','categorie_id');
    }

     //////////////////// end relationShip ////////////////////////////////


}

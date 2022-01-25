<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['categorie_title'];
    
    public function post(){
        return $this->belongsToMany(Post::class,'post_categories','categorie_id','post_id');
    }

    public function tag(){
        return $this->belongsToMany(Tag::class,'categorie_tags','categorie_id','tag_id');
    }
}
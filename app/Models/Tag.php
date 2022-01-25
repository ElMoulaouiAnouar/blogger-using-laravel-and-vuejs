<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_title'];

    public function post(){
        return $this->belongsToMany(Post::class,'post_tags','tag_id','post_id');
    }

    public function categorie(){
        return $this->belongsToMany(Categorie::class,'categorie_tags','tag_id','categorie_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieTag extends Model
{
    use HasFactory;
    protected $fillable = ['categorie_id','tag_id'];
}

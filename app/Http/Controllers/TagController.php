<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Categorie;
use App\Models\CategorieTag;
use App\Models\Tag;
use App\Traits\AuthAndVerfiedTrait;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use AuthAndVerfiedTrait;
    //
    public function __construct()
    {
        $this->AuthAndVerfied();
    }

    public function create(){
        return view('tags.create1');
    }

    public function store(TagRequest $request){
        $tag = Tag::create([
            'tag_title' =>$request->title 
        ]);
        CategorieTag::create([
            'categorie_id' => $request->categorie,
            'tag_id' => $tag->id
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    public function all(Request $request){
        return Categorie::find($request->id)->tag;
    }
}

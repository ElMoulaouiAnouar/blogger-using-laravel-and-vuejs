<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use App\Traits\AuthAndVerfiedTrait;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    use AuthAndVerfiedTrait;
    //

    public function __construct()
    {
        $this->AuthAndVerfied();
    }

    public function create(){
        return view('categories.create');
    }

    public function store(CategorieRequest $request){
        Categorie::create(['categorie_title' => $request->title]);
        return response()->json([
            'success' => true
        ]);
    }

    public function all(){
        return Categorie::all();
    }
}

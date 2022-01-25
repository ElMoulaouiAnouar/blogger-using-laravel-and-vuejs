<?php 

namespace App\Traits;

trait AuthAndVerfiedTrait{
    public function AuthAndVerfied(){
        $this->middleware('auth');
        $this->middleware('verified');
    }
}
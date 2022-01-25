<?php 

namespace App\Traits;

trait ImageTrait{

    public function MoveImage($path_image = null , $image = null){
        if(is_null($path_image) || is_null($image))
            return ;
        else{
            $file_name = $path_image.'/'. time().'.'.$image->getClientOriginalExtension();
            $image->move($path_image,$file_name);
            return $file_name;
        }
    }

    public function DeleteImage($path = null){
        if(is_null($path))
            return;
        else{
            $imagesExtentions = ['png','jpg','jpeg'];
            if(in_array(strtolower(explode('.',$path)[count(explode('.',$path))-1]),$imagesExtentions)){
                unlink($path);
            }  
            else{
                return;
            }
        }
    }

}
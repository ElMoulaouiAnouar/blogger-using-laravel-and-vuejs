<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Traits\AuthAndVerfiedTrait;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use AuthAndVerfiedTrait,ImageTrait;

    public function __construct()
    {
       $this->AuthAndVerfied();
    }
    public function index()
    {
         $posts = Post::with('image')->paginate(PAGINATION_NUMBER);
        return view('posts.index',['posts'=>$posts,'populare'=>$this->getPopularePosts(),'page'=>'Home']);
    }
    //
    public function create(){
        return view('posts.create1');
    }

    public function store(PostRequest $request){
       DB::beginTransaction();
       try{
            $file_name = $this->MoveImage('images/posts',$request->image);
            $image = Image::create([
                'image_path' => $file_name
            ]);

            $post = Post::create([
                'post_title' => $request->title,
                'post_content' => $request->content,
                'image_id' => $image->id,
                'user_id' => auth()->id()
            ]);

            $post->categorie()->syncWithoutDetaching($request->categorie);
            $post->tag()->syncWithoutDetaching($request->tag);

            DB::commit();

            return response()->json([
                'success' => true
            ]);
       }
       catch(Exception $ex){
            DB::rollback();
            return $ex;
       }

    }

    public function all(){
        return Post::all();
    }

    public function show($id){

        //incremet visitor
        Post::find($id)->increment('visitor');

        /**
         * select p.post_title,p.post_content,a.image_path,c.categorie_title,t.tag_title
         * from posts as p INNER join images as a
         * on p.image_id = a.id inner JOIN post_categories as pc
         * on pc.post_id = p.id inner join categories as c
         * on c.id = pc.categorie_id inner join post_tags as pt
         * on pt.post_id = p.id INNER JOIN tags as t
         * on t.id = pt.tag_id WHERE p.id = $id
         */

        $post = Post::join('images','images.id','posts.image_id')
        ->join('post_categories','posts.id','post_categories.post_id')
        ->join('categories','post_categories.categorie_id','categories.id')
        ->join('post_tags','post_tags.post_id','posts.id')
        ->join('tags','tags.id','post_tags.tag_id')->where('posts.id',$id)
        ->join('users','users.id','posts.user_id')
        ->get([
            'posts.id',
            'posts.post_title',
            'posts.post_content',
            'images.image_path',
            'categories.categorie_title',
            'tags.tag_title',
            'posts.created_at',
            'users.name',
            'posts.visitor'
            ]);
        return view('posts.show',[
            'post' => $post[0],
            'page'=>'Post Details',
            'populare'=>$this->getPopularePosts(),
            'comments' => $this->PostComments($id)
            ]);
    }

    private function getPopularePosts(){
        return Post::orderBy('visitor','DESC')->limit(3)->get();
    }

    public function PostComments($id){
        return Comment::where('post_id',$id)->get();
    }
}

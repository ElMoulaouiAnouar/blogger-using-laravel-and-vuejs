<div class="card mt-3">
    <div class="card-header ">
        <div class="card-title bg-light">
            <h4 class="text-center">Popular Posts</h4>
        </div>
    </div>
    <div class="card-body d-flex align-items-center flex-column">
        <!-- post  -->
        @forelse ($populare as $post)
        <div class="post-aside" style="width:200px">
            <img src="{{asset($post->image->image_path)}}" alt="" class="card-img-top">
            <p class="card-text pt-1 fs-6 fw-bold">
                <a href="" class="text-decoration-none">
                    {{$post->post_title}}
                </a>
            </p>
           </div>
           <hr>
           <!-- end post -->

           @empty
           <h1>Aucan populare posts</h1>
        @endforelse
    
    </div>
</div>
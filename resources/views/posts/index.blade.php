@extends('layouts.app')

@section('content')


<div class="bg-light">
    <div class="header"></div>
    <div class="container d-flex">
        <!-- main -->
        <div class="main">
            <!-- nav -->
            @include('includes.nav')
            <!-- posts container -->
            <div class="posts bg-white p-4 justify-content-start d-flex flex-wrap">
                <!-- singel post -->
                @foreach($posts as $post)
                <div class="card" style="width: 15rem; border:none">
                    <div class="card-body">
                        <div class="post_img_container">
                            <img src="{{asset($post->image->image_path)}}" style="width: 100%;height: 100%;" alt="" class="card-img-top">
                            <span class="post_date">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                        <p class="card-text pt-1 fs-6">
                            <a href="{{route('post.show',['id' => $post->id])}}" class="text-decoration-none">
                                {{$post->post_title}}
                            </a>
                        </p>
                    </div>
                </div>
                @endforeach

               <div class="container m-3 d-flex justify-content-center">
                {!! $posts->links() !!}
               </div>
            </div>

        </div>
        <!-- aside -->
        <div class="aside p-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>

           @include('includes.aside')
        </div>

    </div>


    {{-- end first div --}}
</div>


@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-6 mx-auto">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-white text-center">
                        <h5>Add Post</h5>
                    </div>
                    <div class="card-body">
                        <form id="form" enctype="multipart/form-data">
                            @csrf
                            <div class="m-3">
                                <input type="text" name="title" placeholder="Title Of Post" value="{{old('title')}}" class="form-control">
                                <div class="m-1 text-danger" id="error_title"></div>
                            </div>
                            <div class="m-3">
                                <textarea name="content" placeholder="Content Of Post" class="form-control" rows="7">{{old('content')}}</textarea>
                                <div class="m-1 text-danger" id="error_content"></div>
                            </div>
                            <div class="m-3">
                                <select name="categorie" id="categorie" class="form-select">
                                    <option selected>Chose Categorie...</option>
                                </select>
                                <div>
                                    <a href="#">Add Categories</a>
                                </div>
                            </div>
                            <div class="m-3">
                                <select name="tag" id="tag" class="form-select">
                                    <option selected>Chose Tag...</option>
                                </select>
                            </div>
                            <div class="m-3">
                                <input type="file" name="image" class="form-control">
                                <div class="m-1 text-danger" id="error_image"></div>
                            </div>
                            <div class="m-3" style="display: none">
                                <img src="" alt="">
                            </div>
                            <div class="m-3">
                                <button type="button" class="form-control btn btn-outline-primary" id="btn_add">Add Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            getCategories();
            getTags();
            $('#btn_add').on('click',function(e){
                e.preventDefault();
                PostData(new FormData($('#form')[0]));
            });
        });

        function PostData(data){
            $.ajax({
                type : 'post',
                data : data,
                enctype : 'multipart/form-data',
                processData : false,
                contentType : false,
                cache : false,
                url : "{{route('post.store')}}",
                success : function(response){
                    console.log(response);
                },
                error : function(response){
                    Object.keys(response.responseJSON.errors).forEach(function(key){
                        $('#error_'+key).text(response.responseJSON.errors[key]);
                    });
                }
            });
        }

        function getCategories(){
            $.ajax({
                type : 'get',
                data : {},
                url : "{{route('categorie.all')}}",
                success : function(response){
                    var options = '<option selected value="0">Chose Categorie...</option>';
                    response.forEach(item => {
                        options += '<option value='+item.id+'>'+item.categorie_title+'</option>';
                    });
                    $('#categorie').html(options);
                },
                error : function(response){
                    toastr.error('not Categories');
                }
            });
        }

        function getTags(){
            $.ajax({
                type : 'get',
                data : {},
                url : "{{route('tag.all')}}",
                success : function(response){
                    var options = '<option selected value="0">Chose Tag...</option>';
                    response.forEach(item => {
                        options += '<option value='+item.id+'>'+item.tag_title+'</option>';
                    });
                    $('#tag').html(options);
                },
                error : function(response){
                    toastr.error('not tag');
                }
            });
        }
       
    </script>
@endsection
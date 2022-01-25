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
                                <div class="m-1">
                                    <a href="{{route('categorie.create')}}">Add Categories</a>
                                </div>
                            </div>
                            <div class="m-3">
                                <select name="tag" id="tag" class="form-select">
                                    <option selected>Chose Tag...</option>
                                </select>
                                <div class="m-1">
                                    <a href="{{route('tag.create')}}">Add Tags</a>
                                </div>
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
            //getTags();
            $('#btn_add').on('click',function(e){
                e.preventDefault();
                //PostData(new FormData($('#form')[0]));
                MyFunctionSendDataWithAjax('post',"{{route('post.store')}}",new FormData($('#form')[0]),
                (res) => {
                    console.log(res);
                },
                (res) => {
                    Object.keys(res.responseJSON.errors).forEach(function(key){
                        $('#error_'+key).text(res.responseJSON.errors[key]);
                    });
                }
                );
            });

            // get tags on change categorie
            $('#categorie').on('change',function(){
                getTagWithCatgorieSelect( $('#categorie').val());
            });

        });


        //function get all categories 
        function getCategories(){
            MyFunctionSendDataWithAjax('get',"{{route('categorie.all')}}",{},
            (response)=>{
                var options = '<option selected value="0">Chose Categorie...</option>';
                    response.forEach(item => {
                        options += '<option value='+item.id+'>'+item.categorie_title+'</option>';
                    });
                    $('#categorie').html(options);
            },
            (response) => {
                toastr.error('not Categories');
            }
            );
        }

        function getTagWithCatgorieSelect(id){
            $.ajax({
                type : 'get',
                data : {
                    id : id
                },
                url : '{{route("tag.all")}}',
                success : function(response){
                    var options = '';
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
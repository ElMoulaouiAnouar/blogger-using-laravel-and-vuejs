@extends('layouts.app')
@section('content')

   <div class="container bg-light">
    <div class="row">
        <div class="col-11 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center">
                        <h4>Add Tag</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form">
                        @csrf
                        <div class="m-3">
                            <select name="categorie">
                                <option value="0" selected>Chose Categories</option>
                            </select>
                        </div>
                        <div class="mx-3">
                            <input type="text" name="title" placeholder="Title" value="{{old('title')}}" id="" class="form-control">
                            <span class="text-danger m-1" id="title_error"></span>
                        </div>
                        <div class="mx-3">
                            <button type="button" id="btn_add" class="form-control btn btn-outline-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#btn_add').on('click',function(){
            $.ajax({
                type : 'post',
                data : {'title':$('input[name="title"]').val() , '_token' : '{{csrf_token()}}'},
                url : "{{route('tag.store')}}",
                success : function(res){
                    if(res.success == true){
                        $('input[name="title"]').val('');
                        toastr.success('Adding Tag is success');
                    }
                },
                error : function(response){
                    toastr.error('Faild Adding Categorie Verfier champs');
                    $('#title_error').text(response.responseJSON.errors.title);
                }
            });
        });
        $('input[name="text"]').on('change',function(){
            $(error_title).text('');
        });
    });
</script>
@endsection
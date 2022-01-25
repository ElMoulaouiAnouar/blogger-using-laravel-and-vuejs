@extends('layouts.app')
@section('content')

   <div class="container bg-light">
    <div class="row">
        <div class="col-11 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center">
                        <h4>Add Categorie</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form">
                        @csrf
                        <div class="mx-3">
                            <input type="text" name="title" placeholder="Title" value="{{old('title')}}" id="" class="form-control">
                            <span class="text-danger m-2" id="title_error"></span>
                        </div>
                        <div class="mx-3">
                           <button type="button" id="btn_add" class="form-control btn-outline-primary">Add</button>
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
        $('#btn_add').on('click',function(e){
            e.preventDefault();
            MyFunctionSendDataWithAjax('post',"{{route('categorie.store')}}",new FormData($('#form')[0]),
                (res) => {
                    if(res.success == true){
                       toastr.success('Adding Categorie is success');
                       $('input[name="title"]').val('');
                    }
                },
                (response) => {
                    toastr.error('Faild Adding Categorie Verfier champs');
                    $('#title_error').text(response.responseJSON.errors.title)
                }
            );
        });
        
        $('input[type="text"]').on('keyup',function(){
            $('#title_error').text('');
        });
    });

  </script>
@endsection
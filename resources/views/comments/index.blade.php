 <!-- Comments section-->
 <section class="mb-5">
  <div class="card bg-light">
      <div class="card-body">
          <!-- Comment form-->
          <form class="mb-4" id="form">
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <textarea class="form-control" name="content" id="txt_comment" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
          </form>
          
          @forelse ($comments as $comment)
          <div class="d-flex m-2">
            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
            <div class="ms-3">
                <div class="fw-bold">{{Auth::user()->name}}</div>
               {{$comment->comment_content}}
            </div>
        </div>
          @empty
            <h2 class="alert alert-warning">Aucan comment</h2>
          @endforelse
          
    </div>
  </div>
</section>

@section('script')
<script>
  $(document).ready(function(){
    $('#txt_comment').on('change',function(){
      // var data = {
      //   content: $('#txt_comment')[0].value,
      //   post_id : "{{$post->id}}",
      //   user_id : "{{Auth::id()}}",
      //   _token : "{{csrf_token()}}"
      // }
      
      
      MyFunctionSendDataWithAjax('post','{{route('comment.store')}}',new FormData($('#form')[0]),
        (res) =>{
            console.log(res);
        },
        (error) => {
          console.log(error.responseJSON.message);
        }
      );
    });
  })
</script>
@stop
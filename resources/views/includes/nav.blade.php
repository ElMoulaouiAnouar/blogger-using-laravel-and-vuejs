<div class="nav">
    <div class="navbar navbar-light bg-light">  

        <ul class="d-flex">
            <li class="nav-item">
              <a class="nav-link text-primary" id='Home' href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary" id="Abouts" href="{{route('about')}}">Abouts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-primary" href="#">Services</a>
            </li>
        </ul>
    </div>
</div>


@section('script')
<script>
    let page_name = document.title;
    $(document).ready(function(){
        $('#'+page_name).addClass('active');
    });
</script>

@endsection
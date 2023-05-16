@extends('layouts.app')
@section('content')
<div class=" container">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <h4 class="align-self-center mb-0">Blog Title: {{$blog->title}}</h4>
                <span>
                    <a href="{{ route('home')}}" class="btn btn-outline-primary"><i data-feather='skip-back'></i>
                        {{__("Back")}}</a>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card p-5">
            <div class="card-body">
                <div class="card mb-3">
                    <img src="{{$blog->getImage()}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$blog->title}}</h5>
                        {!! strip_tags($blog->description) !!}
                        <p class="card-text"><small class="text-muted">Updated:
                                {{$blog->updated_at->diffInMinutes(\Carbon\Carbon::now()) }} minutes ago</small></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    $(document).ready(function () {
        var quill = new Quill('#description', {
            theme: 'snow'
        });

        quill.on('text-change', function (delta, oldDelta, source) {
            document.getElementById("quill-editor-description").value = quill.root.innerHTML;
        });

    });

</script>

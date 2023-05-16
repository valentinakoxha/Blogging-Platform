@extends('layouts.app')
@section('content')
<div class=" container">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <h4 class="align-self-center mb-0">{{__("Create blog")}}</h4>
                <span>
                    <a href="{{ route('blog.index')}}" class="btn btn-outline-primary"><i data-feather='skip-back'></i>
                        {{__("Back")}}</a>
                </span>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
            <div class="card content-height">
                <div class="card-body p-5">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                        action="{{ route('blog.update', $blog)}}" autocomplete="off">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Title</label>
                                    <div class="col-md-10">
                                        <input id="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{old('title', $blog->title)}}" autofocus>
                                    </div>
                                    @error('name')
                                    <div class="alert text-danger ms-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group py-2 col-md-10">
                                    <label for="description" class="col-md-4 control-label">{{__("Description1")}}</label>
                                    <div id="description"
                                        class="description  @error('description') is-invalid @enderror">
                                        {!! old('price', $blog->description) !!}
                                    </div>
                                    
                                    <input type="hidden" name="description"
                                        value="{{ old('description', $blog->description) }}"
                                        id="quill-editor-description">
                                    @error('description')
                                    <div class="alert text-danger ms-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <div class="d-flex">
                                        <label for="image" class="me-2 col-md-8 control-label">Blog Image</label>
                                    </div>
                                    <img src="{{ $blog->getImage() }}" alt="" class="img-fluid ml-3 mt-1" width="50" height="50" />

                                    <div class="col-md-10 mt-1">
                                        <input type="file" id="blogFile" name="blogFile[]" class="form-control"
                                            multiple data-buttonname="btn-secondary">
                                    </div>
                                </div>

                                <div class="col-md-10 col-md-offset-4 mt-3">
                                    <div class="d-flex justify-content-end">
                                       
                                        <button type="submit" class="btn btn-outline-primary"><i data-feather='save'></i>
                                            Update</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                            </div>
                        </div>
                    </form>
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

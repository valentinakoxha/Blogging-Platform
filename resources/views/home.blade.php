@extends('layouts.app')

@section('content')
<div class=" container">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="align-self-center mb-0">Blogs</h4>
                </div>
                <p class="card-title-desc mt-2">List of blogs in the application</p>
                <div class="container">
                    @if(count($blogs) == 0)
                        There are no blogs posted.
                    @endif
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-sm-4 mb-4">
                            <div class="card">
                                <img class="card-img blog-img" src="{{ $blog->getImage() }}" alt="Bologna">
                                <div class="card-body">
                                    <h4 class="card-title">{{$blog->title}}</h4>
                                    <div>
                                        {!! strip_tags(Str::limit($blog->description, 150)) !!}
                                    </div>
                                    
                                    <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-info mt-3 cursor-pointer text-white">Read</a>
                                </div>
                                <div
                                    class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                                    <div class="views">Created at: {{$blog->formatDate()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 3 == 0)
                    </div>
                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    function deleteRow(rowId) {
        // Display the SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms the delete, redirect to the delete route
                window.location.href = '/delete/' + rowId;
            }
        })
    }

</script>

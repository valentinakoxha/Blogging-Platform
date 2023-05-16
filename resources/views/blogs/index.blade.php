@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="align-self-center mb-0">blogs</h4>
                    <span class="float-right">
                        <a href="{{ route('blog.create') }}" class="btn btn-success">

                            <svg width="18" height="18" viewBox="0 -0.5 21 21" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">
                                    <title>plus [#1512]</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs> </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-379.000000, -240.000000)"
                                            fill="#ffffff">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <polygon id="plus-[#1512]"
                                                    points="344 89 344 91 334.55 91 334.55 100 332.45 100 332.45 91 323 91 323 89 332.45 89 332.45 80 334.55 80 334.55 89">
                                                </polygon>
                                            </g>
                                        </g>
                                    </g>
                                </g>

                            </svg>
                            Create blog
                        </a>
                    </span>
                </div>
                <p class="card-title-desc mt-2">List of blogs in the application</p>
                <div class="">
                    <table class="table table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ttile</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{!! strip_tags(Str::limit($blog->description, 50)) !!}</td>
                                <td>{{ $blog->formatDate() }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class="me-1 text-primary" href="{{ route('blog.edit', $blog->id) }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg" fill="#2c58a0">

                                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round" />

                                                <g id="SVGRepo_iconCarrier">
                                                    <title />
                                                    <g id="Complete">
                                                        <g id="edit">
                                                            <g>
                                                                <path
                                                                    d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                                                    fill="none" stroke="#148e90" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2" />
                                                                <polygon fill="none"
                                                                    points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                                                    stroke="#148e90" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>

                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('blog.destroy', $blog) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="" onclick="deleteBlogById({{ $blog->id }})">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">

                                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round" />

                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M4 7H20" stroke="#cb0606" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M6 7V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V7"
                                                            stroke="#cb0606" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                                            stroke="#cb0606" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </g>

                                                </svg>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex">
                {!! $blogs->links() !!}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    function deleteBlogById(rowId) {
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

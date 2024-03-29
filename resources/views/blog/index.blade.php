@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'All Blogs')
@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="btn-group mt-2" role="group" aria-label="Record Filter">
                                <button type="button" class="btn rounded-pill btn-primary mx-2 filter-btn" value="all">All
                                    ({{ $blogs->count() }})</button>
                                <button type="button" class="btn rounded-pill btn-success mx-2 filter-btn"
                                    value="featured">Featured ({{ $blogs->where('featured', true)->count() }})</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <a class="btn btn-primary add-btn mx-2" href="{{ route('add-blog.create') }}">Add Blog</a>
                            </div>
                            <div class="mx-2">
                                <button class="btn btn-soft-danger" id="bulkDeleteBtn" onClick="deleteMultiple()">
                                    <i class="ri-delete-bin-2-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <table id="example" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Category</th>
                                <th scope="col">Featured</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            @forelse ($blogs as $blog)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input mass-action-checkbox" type="checkbox"
                                                name="chk_child" value="{{ $blog->id }}">
                                        </div>
                                    </th>
                                    <td>
                                        <img src="{{ isset($blog) && $blog->blog_media_id ? asset('storage/' . $blog->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
                                            alt="blog_image" class="img-45">
                                    </td>
                                    <td>
                                        <a href="" class="btn-link">{{ $blog->name }}</a>
                                    </td>

                                    <td>
                                        {{ $blog->author->name }}
                                    </td>

                                    <td>
                                        @forelse ($blog->categories as $category)
                                        @if($loop->last)
                                            {{ $category->name }}
                                        @else
                                            {{ $category->name }} , <br>
                                        @endif
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input feature-toggle" type="checkbox"
                                                {{ $blog->featured ? 'checked' : '' }}
                                                data-blog-id="{{ $blog->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class='bx bx-message-rounded-detail fs-22'></i>
                                            <span
                                                class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span
                                                    class="visually-hidden">unread messages</span></span>
                                        </button>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="badge
                                                @if ($blog->status == 'published') badge-soft-success text-uppercase
                                                @elseif($blog->status == 'pending')
                                                    badge-soft-warning text-uppercase
                                                @elseif($blog->status == 'draft')
                                                    badge-soft-primary text-uppercase @endif rounded-pill">
                                                    {{ $blog->status }}
                                            </span>
                                            <span class="text-muted text-xs mt-1">
                                                {{ Carbon\Carbon::parse($blog->created_at)->format('d-m-Y h:i A') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-primary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('add-blog.edit', $blog->id) }}"
                                                        class="dropdown-item"> <i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <a onclick="deleteBlog('{{ route('add-blog.destroy', $blog->id) }}')"
                                                        class="dropdown-item" role="button"> <i
                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No Category Found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>



                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- <script>
        $(document).ready(function() {

            // $('#categoriesTable').DataTable();

            var searchDelayTimer;

            $('#search-options').on('input', function() {
                clearTimeout(searchDelayTimer);
                var searchText = $(this).val();
                searchDelayTimer = setTimeout(function() {
                    fetchData(searchText);
                }, 1000);
            });



            function fetchData(searchText, filter) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog.category.search-blog-categories') }}",
                    data: {
                        searchText: searchText,
                        filter: filter,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#filteredCategoriesContent').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }



            function handleInputChange(searchText) {
                if (searchText.trim() === '') {
                    fetchData(null, $('#filterBtn').val());
                } else {
                    clearTimeout(searchDelayTimer);
                    searchDelayTimer = setTimeout(function() {
                        fetchData(searchText, $('#filterBtn').val());
                    }, 1000);
                }
            }

            $('#search-options').on('input', function() {
                var searchText = $(this).val();
                handleInputChange(searchText);
            });

            $(window).on('load', function() {
                var searchText = $('#search-options').val();
                handleInputChange(searchText);
            });

            document.getElementById('search-options').addEventListener('input', function() {
                var searchText = this.value.trim();
                var searchCloseIcon = document.getElementById('search-close-options');
                if (searchText !== '') {
                    searchCloseIcon.classList.remove('d-none');
                } else {
                    searchCloseIcon.classList.add('d-none');
                }
            });

            document.getElementById('search-close-options').addEventListener('click', function() {
                var searchInput = document.getElementById('search-options');
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
                this.classList.add('d-none');
            });



            $(document).on('click', '#pagination-container a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                var pageNumber = url.substring(url.indexOf('page=') + 5);

                fetchData(searchText, filter);
            });
        });
    </script> --}}

    <script>
        var checkedIds = [];

        function updateCheckedIds() {
            checkedIds = [];
            $('.mass-action-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
        }

        $('.feature-toggle').change(function() {
            var blogId = $(this).data('blog-id');
            var newToggleStatus = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('blog.update-toggle-status') }}',
                method: 'POST',
                data: {
                    id: blogId,
                    toggleStatus: newToggleStatus
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        'Featured Status has been updated.',
                        'success'
                    ).then(function() {
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Failed to update featured status. Please try again later.',
                        'error'
                    ).then(() => {
                        location.reload();
                    });
                }
            });

        });
        $(document).ready(function() {


            $('.mass-action-checkbox').change(function() {
                updateCheckedIds();
            });

            $('#checkAll').change(function() {
                var isChecked = $(this).prop('checked');
                $('.mass-action-checkbox').prop('checked', isChecked);
                updateCheckedIds();
            });

            $('.filter-btn').click(function() {
                var filter = $(this).val();
                console.log(filter);
                var searchText = $('#search-options').val();
                fetchData(searchText, filter);
            });

            $(document).on('click', '#pagination-container a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                var pageNumber = url.substring(url.indexOf('page=') + 5);

                fetchData(searchText, filter);
            });

            function fetchData(searchText, filter) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog.category.search-blog-categories') }}",
                    data: {
                        searchText: searchText,
                        filter: filter,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {

                        $('#categoryTableBody').html(response);



                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        function deleteMultiple() {
            if (checkedIds.length === 0) {
                Swal.fire(
                    'No item selected!',
                    'Please select at least one item to delete.',
                    'warning'
                );
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover deleted items!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('blog.category.mass-delete') }}',
                        method: 'POST',
                        data: {
                            ids: checkedIds
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your items have been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete items. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function deleteBlog(blogSlug) {
            console.log(blogSlug)
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover deleted items!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: categorySlug,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Blog Have Been Deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete items. Please try again later.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

@endsection

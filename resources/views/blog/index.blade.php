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
                                    ({{ $categories->count() }})</button>
                                <button type="button" class="btn rounded-pill btn-success mx-2 filter-btn"
                                    value="featured">Featured ({{ $categories->where('featured', true)->count() }})</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <a class="btn btn-primary add-btn mx-2" href="{{ route('blog-category.create') }}">Add Blog
                                    Category</a>
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
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input mass-action-checkbox" type="checkbox"
                                                name="chk_child" value="{{ $category->id }}">
                                        </div>
                                    </th>
                                    <td data-sort="{{ $category->name }}">{{ $category->name }}</td>
                                    <td data-sort="{{ $category->parentCategory->name ?? '' }}">
                                        {{ $category->parentCategory->name ?? '-' }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input feature-toggle" type="checkbox"
                                                {{ $category->featured ? 'checked' : '' }}
                                                data-category-id="{{ $category->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                {{ $category->status ? 'checked' : '' }}
                                                data-category-id="{{ $category->id }}">
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
                                                    <a href="{{ route('blog-category.edit', $category->id) }}"
                                                        class="dropdown-item">Edit</a>
                                                </li>
                                                <li>
                                                    <a onclick="deleteCategory('{{ route('blog-category.destroy', $category->id) }}')"
                                                        class="dropdown-item" role="button">Remove</a>
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

        $('.status-toggle').change(function() {
            var categoryId = $(this).data('category-id');
            var newStatus = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('blog.category.update-status') }}',
                method: 'POST',
                data: {
                    id: categoryId,
                    status: newStatus
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        'Status has been updated.',
                        'success'
                    ).then(function() {
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Failed to update status. Please try again later.',
                        'error'
                    ).then(() => {
                        location.reload();
                    });
                }
            });
        });

        $('.feature-toggle').change(function() {
            var categoryId = $(this).data('category-id');
            var newToggleStatus = $(this).prop('checked') ? 1 : 0;
            console.log(newToggleStatus, categoryId)

            $.ajax({
                url: '{{ route('blog.category.update-status') }}',
                method: 'POST',
                data: {
                    id: categoryId,
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

        function deleteCategory(categorySlug) {
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
    </script>

@endsection

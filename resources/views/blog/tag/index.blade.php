@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Tags')
@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">


                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="btn-group mt-2" role="group" aria-label="Record Filter">
                                <button type="button" class="btn rounded-pill btn-primary mx-2 filter-btn" value="all">All
                                    ({{ $tags->count() }})</button>
                                <button type="button" class="btn rounded-pill btn-success mx-2 filter-btn"
                                    value="published">Published ({{ $tags->where('published', true)->count() }})</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div>
                                <a class="btn btn-primary add-btn mx-2" href="{{ route('tag.create') }}">Add Tag</a>
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
                    <div>

                        <table id="example" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tagTableBody">
                                @forelse ($tags as $tag)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input mass-action-checkbox" type="checkbox"
                                                    name="chk_child" value="{{ $tag->id }}">
                                            </div>
                                        </th>
                                        <td data-sort="{{ $tag->name }}">{{ $tag->name }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input publish-toggle" type="checkbox"
                                                    {{ $tag->published ? 'checked' : '' }}
                                                    data-tag-id="{{ $tag->id }}">
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
                                                        <a href="{{ route('tag.edit', $tag->id) }}"
                                                            class="dropdown-item">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="deleteCategory('{{ route('tag.destroy', $tag->id) }}')"
                                                            class="dropdown-item" role="button">Remove</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No Tag Found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var checkedIds = [];

        function updateCheckedIds() {
            checkedIds = [];
            $('.mass-action-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
        }

        $('.publish-toggle').change(function() {
            var tagId = $(this).data('tag-id');
            var newToggleStatus = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('blog.tag.update-status') }}',
                method: 'POST',
                data: {
                    id: tagId,
                    toggleStatus: newToggleStatus
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        'Publish Status has been updated.',
                        'success'
                    ).then(function() {
                        window.location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Failed to update published status. Please try again later.',
                        'error'
                    );
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
                    url: "{{ route('blog.tag.search-tags') }}",
                    data: {
                        searchText: searchText,
                        filter: filter,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        console.log(response)

                        $('#tagTableBody').html(response);



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
                        url: '{{ route('blog.tag.mass-delete') }}',
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

@extends('layouts.app')

@section('page-title', 'Users')
@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <div>
                            <a class="btn btn-primary add-btn mx-2" href="{{ route('users.create') }}">Add User</a>
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
        <!--end col-->
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <table id="example" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="orm-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input mass-action-checkbox" type="checkbox"
                                                name="chk_child" value="{{ $user->id }}">
                                        </div>
                                    </th>
                                    <td>

                                        <img src="{{ isset($user) && $user->profile_media_id && isset($user->media->url) ? asset('storage/' . $user->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
                                            alt="blog_image" class="img-45">
                                    </td>
                                    <td>
                                        <a href="" class="btn-link">{{ $user->name }}</a>
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

                                    <td> Roles
                                        {{-- @forelse ($user->categories as $category)
                                            @if ($loop->last)
                                                {{ $category->name }}
                                            @else
                                                {{ $category->name }} , <br>
                                            @endif
                                        @empty
                                            -
                                        @endforelse --}}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input feature-toggle" type="checkbox"
                                                {{ $user->active ? 'checked' : '' }} data-blog-id="{{ $user->id }}">
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
                                                    <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <a onclick="deleteUser('{{ route('users.destroy', $user->id) }}')"
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
                                    <td colspan="9">No Blog Found.</td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                fetchData(filter);
            });



            function fetchData(filter) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog.search-blog') }}",
                    data: {
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
                        url: '{{ route('user.mass-delete') }}',
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

        function deleteUser(slug) {
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
                        url: slug,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message,
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

@endsection

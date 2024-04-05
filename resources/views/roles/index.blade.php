@extends('layouts.app')

@section('page-title', 'Roles')
@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <div>
                            <a class="btn btn-primary add-btn mx-2" href="{{ route('roles.create') }}">Add Role</a>
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
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            @forelse ($roles as $role)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input mass-action-checkbox" type="checkbox"
                                                name="chk_child" value="{{ $role->id }}">
                                        </div>
                                    </th>
                                    <td>
                                        <a href="" class="btn-link">{{ $role->name }}</a>
                                    </td>

                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-primary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="dropdown-item">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a>
                                                </li>
                                                <li>
                                                    <a onclick="deleteRole('{{ route('roles.destroy', $role->id) }}')"
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
                                    <td colspan="9">No Role Found.</td>
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
                        url: '{{ route('role.mass-delete') }}',
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

        function deleteRole(slug) {
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

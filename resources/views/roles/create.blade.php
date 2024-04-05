@extends('layouts.app')

@section('page-title', 'Roles')
@section('sub-page-title', 'Add New Role')
@section('content')


    <div class="row">
        <div class="col-xl-8">
            <form id="roleForm"
                action="{{ isset($role) ? route('roles.update', ['role' => $role->id]) : route('roles.store') }}"
                method="POST">
                @csrf

                @if (isset($role))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add Role</h4>
                    </div>
                    <div class="card-body form-steps">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div>
                                    <div class="row">



                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name" id="name" value="{{ $role->name ?? '' }}">
                                            </div>
                                        </div>



                                        <div class="card card-body my-5 col-lg-12">
                                            <h4 class="font-16 mb-2">Permissions</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Module</th>
                                                            <th>Create</th>
                                                            <th>Show</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($permissions as $index => $permissionGroup)
                                                            <tr>
                                                                <td>{{ ucfirst($index) }}</td>
                                                                <td>
                                                                    @if (checkPermission($permissionGroup, 'create_' . strtolower($index)))
                                                                        <div class="form-check text-center">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[create_{{ strtolower($index) }}]">
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check text-center">-</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (checkPermission($permissionGroup, 'show_' . strtolower($index)))
                                                                        <div class="form-check text-center">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[show_{{ strtolower($index) }}]">
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check text-center">-</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (checkPermission($permissionGroup, 'edit_' . strtolower($index)))
                                                                        <div class="form-check text-center">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[edit_{{ strtolower($index) }}]">
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check text-center">-</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (checkPermission($permissionGroup, 'delete_' . strtolower($index)))
                                                                        <div class="form-check text-center">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[delete_{{ strtolower($index) }}]">
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check text-center">-</div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                        <button type="submit" class="btn btn-primary">
                            {{ isset($role) ? 'Update' : 'Save' }}
                        </button>
            </form>
        </div>
        <!-- end card body -->

    </div>

    <!-- end card -->
    </div>
    <!-- end col -->
    </div>

    </div>

    <div class="modal fade modal-xl" id="mediaUploadModal" tabindex="-1" role="dialog"
        aria-labelledby="mediaUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <x-media :modalOpenedFlag=true />
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $('#roleForm').on('submit', function(event) {
                    event.preventDefault();

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        '{{ route('roles.index') }}';
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let field in errors) {
                                if (errors.hasOwnProperty(field)) {
                                    errorMessage += `${errors[field].join('\n')}\n`;
                                }
                            }

                            Swal.fire(
                                'Error!',
                                errorMessage + '\n',
                                'error'
                            );
                        }

                    });
                });
            });


            document.getElementById('chooseFileBtn').addEventListener('click', function() {
                $('#mediaUploadModal').modal('show');
            });

        });
    </script>
@endsection

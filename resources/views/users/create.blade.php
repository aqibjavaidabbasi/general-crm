@extends('layouts.app')

@section('page-title', 'Users')
@section('sub-page-title', 'Add New User')
@section('content')


    <div class="row">
        <div class="col-xl-8">
            <form id="userForm"
                action="{{ isset($user) ? route('users.update', ['user' => $user->id]) : route('users.store') }}"
                method="POST">
                @csrf

                @if (isset($user))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add User</h4>
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
                                                    placeholder="Enter Name" id="name" value="{{ $user->name ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter Email" id="email"
                                                    value="{{ $user->email ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="card-body form-steps">
                                            <p class="mb-1">Assign Role</p>

                                            <select class="js-example-basic-multiple mt-2" id="roleSelect2" name="roles[]"
                                                multiple="multiple" data-placeholder="Select Role...">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ isset($user) && $user->categories->contains($role->id) ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="card card-body my-5 col-lg-12">
                                            <h4 class="font-16 mb-2">Status</h4>
                                            <div class="form-group row my-2">
                                                <label for="active" class="col-sm-4 font-14 bold black">Active
                                                    Status</label>
                                                <div class="col-sm-8">
                                                    <div class="form-check form-switch form-switch-right form-switch-md">
                                                        <input type="hidden" id="active" name="active" value="off">
                                                        <input class="form-check-input code-switcher" type="checkbox"
                                                            name="active"
                                                            {{ isset($user) && $user->active == true ? 'checked' : '' }}
                                                            id="tables-small-showcode" {{ !isset($user) ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Enter Password" id="password">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="password_confirmation">Confirm Password<span
                                                        class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Enter Password" id="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Profile Picture</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        class="form-group row justify-content-center align-items-center mt-4">
                                                        <div class="col-sm-4">
                                                            <input type="hidden" name="profile_media_id" id="page_image_id"
                                                                value="{{ $user->profile_media_id ?? '' }}">
                                                            <div class="image-box">
                                                                <div class="d-flex flex-wrap gap-10 mb-3">
                                                                    <div class="preview-image-wrapper">
                                                                        <a type="button" title="Remove image"
                                                                            class="remove-btn style--three black d-none"
                                                                            id="page_image_remove"
                                                                            onclick="removeSelection('#page_image_preview')">
                                                                            <i class="ri-close-circle-fill"></i>
                                                                        </a>
                                                                        <img src="{{ isset($user) && $user->profile_media_id ? asset('storage/' . $user->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
                                                                            alt="page_image" width="150"
                                                                            class="preview_image" id="page_image_preview">
                                                                    </div>
                                                                </div>
                                                                <div class="image-box-actions mb-3">
                                                                    <a type="button" class="btn-link"
                                                                        id="chooseFileBtn">
                                                                        Choose File
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                        <button type="submit" class="btn btn-primary">
                            {{ isset($user) ? 'Update' : 'Save' }}
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
        function removeSelection(selector) {
            $(selector).attr('src', 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg');
            $('#page_image_remove').addClass('d-none');
            $('#page_image_id').val('');
        }

        $('#chooseFileBtn').on('click', function() {
            $('#mediaUploadModal').modal('show');
        });

        if ($('#page_image_id').val()) {
            $('#page_image_remove').removeClass('d-none');
        } else {
            $('#page_image_remove').addClass('d-none');
        }
    </script>



    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            $(document).ready(function() {
                $('#userForm').on('submit', function(event) {
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
                                        '{{ route('users.index') }}';
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

@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Categories')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ isset($blogCategory) ? 'Edit' : 'Add' }} Blog Category</h4>
                </div>
                <div class="card-body form-steps">
                    <form id="blogCategoryForm"
                        action="{{ isset($blogCategory) ? route('blog-category.update', ['blog_category' => $blogCategory->id]) : route('blog-category.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($blogCategory))
                            @method('PUT')
                        @endif
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-email-input">Name <span
                                                        class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" id="gen-info-email-input"
                                                    placeholder="Enter Name" name="name" required
                                                    value="{{ isset($blogCategory) ? $blogCategory->name : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12" id="permalink-section" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label" for="permalink">Permalink <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="permalink" name="slug"
                                                        readonly required>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#editSlugCollapse"
                                                        aria-expanded="false" aria-controls="editSlugCollapse">Edit</button>
                                                </div>
                                                <div class="collapse" id="editSlugCollapse">
                                                    <div class="mt-2">
                                                        <input type="text" class="form-control" id="slug"
                                                            name="slug"
                                                            value="{{ isset($blogCategory) ? $blogCategory->slug : '' }}">
                                                        <div class="mt-2">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#editSlugCollapse"
                                                                aria-expanded="false"
                                                                aria-controls="editSlugCollapse">Cancel</button>
                                                            <button class="btn btn-primary" type="button"
                                                                id="saveSlug">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="parent">Parent</label>
                                                <select class="form-control" name="parent_id" id="parent">
                                                    <option value="" selected diabled>Select Parent Category</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ isset($blogCategory) && $blogCategory->parent_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-password-input">Short
                                                    Description</label>
                                                <textarea class="form-control" name="description" id="summernote" rows="3" placeholder="Enter Short Description">{{ isset($blogCategory) ? $blogCategory->description : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-email-input">Meta Title </label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    id="gen-info-email-input" placeholder="Enter Name"
                                                    value="{{ isset($blogCategory) ? $blogCategory->meta_title : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Meta
                                                    Description</label>
                                                <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea5" rows="3"
                                                    placeholder="Enter Short Description">{{ isset($blogCategory) ? $blogCategory->meta_description : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">Blog Image</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        class="form-group row justify-content-center align-items-center mt-4">
                                                        <div class="col-sm-4">
                                                            <input type="hidden" name="meta_media_id" id="page_image_id"
                                                                value="{{ $blogCategory->meta_media_id ?? '' }}">
                                                            <div class="image-box">
                                                                <div class="d-flex flex-wrap gap-10 mb-3">
                                                                    <div class="preview-image-wrapper">
                                                                        <a type="button" title="Remove image"
                                                                            class="remove-btn style--three black d-none"
                                                                            id="page_image_remove"
                                                                            onclick="removeSelection('#page_image_preview')">
                                                                            <i class="ri-close-circle-fill"></i>
                                                                        </a>
                                                                        <img src="{{ isset($blogCategory) && $blogCategory->meta_media_id ? asset('storage/' . $blogCategory->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
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
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($blogCategory) ? 'Update' : 'Save' }}
                        </button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="modal fade modal-xl" id="mediaUploadModal" tabindex="-1" role="dialog"
            aria-labelledby="mediaUploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <x-media />
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#blogCategoryForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();


                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        console.log(response)
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    '{{ route('blog-category.index') }}';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Operation failed!',
                            'error'
                        );
                    }
                });
            });
        });
    </script>

    <script>
        var baseURL = '{{ url('blog/category/') }}';
        document.getElementById('gen-info-email-input').addEventListener('blur', function() {
            var name = this.value.trim();
            var permalinkSection = document.getElementById('permalink-section');
            var permalinkInput = document.getElementById('permalink');
            var slugInput = document.getElementById('slug');

            if (name !== '') {
                permalinkSection.style.display = 'block';
                var slug = name.toLowerCase().replace(/\s+/g, '-');
                var fullURL = baseURL + '/' + slug;
                permalinkInput.value = fullURL;
                slugInput.value = slug;
            } else {
                permalinkSection.style.display = 'none';
            }
        });

        document.getElementById('saveSlug').addEventListener('click', function() {
            var permalinkInput = document.getElementById('permalink');
            var slugInput = document.getElementById('slug');

            permalinkInput.value = baseURL + '/' + slugInput.value;
            document.getElementById('editSlugCollapse').classList.remove('show');
        });
    </script>

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

@endsection

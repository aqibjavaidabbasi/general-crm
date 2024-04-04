@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Add New Blog')
@section('content')


    <div class="row">
        <div class="col-xl-8">
            <form id="blogForm"
                action="{{ isset($addBlog) ? route('add-blog.update', ['add_blog' => $addBlog->id]) : route('add-blog.store') }}"
                method="POST">
                @csrf

                @if (isset($addBlog))
                    @method('PUT')
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add Blog</h4>
                    </div><!-- end card header -->
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
                                                    placeholder="Enter Name" id="name" required
                                                    value="{{ $addBlog->name ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Short
                                                    Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" name="description" rows="3"
                                                    placeholder="Enter Short Description">{{ $addBlog->description ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-password-input">Content</label>
                                                <textarea class="form-control" id="summernote" name="content" rows="3" placeholder="Enter Short Description"> {{ $addBlog->content ?? '' }} </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->

                    </div>
                    <!-- end card body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">SEO Meta Tags</h4>
                    </div><!-- end card header -->
                    <div class="card-body form-steps">


                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-email-input">Meta Title </label>
                                                <input type="text" class="form-control" name="meta_title"
                                                    id="gen-info-email-input" placeholder="Enter Name"
                                                    value="{{ $addBlog->meta_title ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta_description">Meta
                                                    Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" rows="3"
                                                    placeholder="Enter Short Description">{{ $addBlog->meta_description ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Publish</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">


                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="btn-group" id="blog-status" role="group">
                                <input type="checkbox" id="draftCheckbox" name="status" value="draft" class="btn-check"
                                    autocomplete="off">
                                <label class="btn btn-primary rounded-pill" for="draftCheckbox">Draft</label>

                                <input type="checkbox" id="pendingCheckbox" name="status" value="pending" class="btn-check"
                                    autocomplete="off">
                                <label class="btn btn-warning rounded-pill" for="pendingCheckbox">Pending</label>

                                <input type="checkbox" id="previewCheckbox" value="preview" class="btn-check"
                                    autocomplete="off">
                                <label class="btn btn-info rounded-pill" for="previewCheckbox">Preview</label>
                            </div>
                        </div>
                    </div>

                    <!-- Visibility Section -->
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <label class="form-label">
                                <i class="ri-eye-line me-2"></i>Visibility :
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <p class="col-lg-12 visibility-input"></p>

                        </div>
                        <div class="input-group">
                            <a class="btn btn-secondary" data-bs-toggle="collapse" href="#visibilityOptions"
                                aria-expanded="false" aria-controls="visibilityOptions">Edit</a>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="collapse mt-2" id="visibilityOptions">
                                    <div class="card card-body">
                                        <div class="form-check mb-1">
                                            <input checked class="form-check-input visibility-radio" type="radio"
                                                name="visibility" id="visibilityOptionPublic" value="Public">
                                            <label class="form-check-label" for="visibilityOptionPublic">
                                                Public
                                            </label>
                                            <div class="additional-option-public form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="front-page-blog"
                                                    id="stickToBlogList">
                                                <label class="form-check-label" for="stickToBlogList">
                                                    Stick this post to the front of blog list page
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input visibility-radio" type="radio"
                                                name="visibility" id="visibilityOptionPasswordProtected"
                                                value="Password Protected">
                                            <label class="form-check-label" for="visibilityOptionPasswordProtected">
                                                Password Protected
                                            </label>
                                            <div class="additional-option-password" style="display: none;">
                                                <div class="input-group mt-2">
                                                    <input type="password" class="form-control"
                                                        name="protection-password" id="passwordField"
                                                        placeholder="Enter Password">
                                                </div>
                                                <div class="mt-2">
                                                    <span class="text-danger">If password field remain empty then
                                                        visibility will be saved as Public</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input visibility-radio" type="radio"
                                                name="visibility" id="visibilityOptionPrivate" value="Private">
                                            <label class="form-check-label" for="visibilityOptionPrivate">
                                                Private
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 mt-3">
                            <div>
                                <label class="form-label mb-0">
                                    <i class=" ri-calendar-line" for="publish-date"></i>
                                    Publish</label>
                                <input type="text" id="datepicker" class="form-control " data-enable-time="true"
                                    data-date-format="Y-m-d H:i:S" name="published_date_time"
                                    placeholder="Select date and time">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <button id="publishBtn" class="btn btn-primary rounded-pill" name="status"
                            value="publish">Publish</button>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Format</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="format" id="format-standard"
                            value="standard" {{ isset($addBlog) && $addBlog->format === 'standard' ? 'checked' : '' }}
                            checked>
                        <label class="form-check-label" for="format-standard">
                            Standard
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="format" id="format-audio" value="audio"
                            {{ isset($addBlog) && $addBlog->format === 'audio' ? 'checked' : '' }}>
                        <label class="form-check-label" for="format-audio">
                            Audio
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="format" id="format-video" value="video"
                            {{ isset($addBlog) && $addBlog->format === 'video' ? 'checked' : '' }}>
                        <label class="form-check-label" for="format-video">
                            Video
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="format" id="format-gallery"
                            value="gallery" {{ isset($addBlog) && $addBlog->format === 'gallery' ? 'checked' : '' }}>
                        <label class="form-check-label" for="format-gallery">
                            Gallery
                        </label>
                    </div>
                </div>
            </div>
            <!-- end card body -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categories</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <p class="mb-1">Only Active Categories</p>

                    <select class="js-example-basic-multiple mt-2" id="categorySelect2" name="category_ids[]"
                        multiple="multiple" data-placeholder="Select Categories...">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($addBlog) && $addBlog->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#categoryFields"
                        aria-expanded="false" aria-controls="categoryFields">Add New Category</a>

                    <div class="collapse mt-2" id="categoryFields">
                        <div class="form-check mb-1">
                            <input type="text" class="form-control mt-2" id="categoryNameInput"
                                placeholder="Enter Category">
                            <input type="hidden" class="form-control" id="categorySlug" name="categorySlug">
                            <select name="parent_id" class="form-control mt-2" id="parentCategorySelect">
                                <option value="" selected disabled>Select Parent Category</option>
                                @foreach ($parentCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary mt-2" id="addCategoryBtn">Add</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tags</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <select class="js-example-basic-multiple mt-2" id="tagsSelect2" name="tag_ids[]" multiple="multiple"
                        data-placeholder="Select Tags...">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ isset($addBlog) && $addBlog->tags->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#addTag"
                        aria-expanded="false" aria-controls="categoryFields">Add New Tag</a>
                    <div class="collapse mt-2" id="addTag">
                        <div class="form-check mb-1">
                            <input type="text" class="form-control mt-2" id="tagNameInput" placeholder="Enter Tag">
                            <input type="hidden" class="form-control mt-2" id="tagSlug">
                            <button class="btn btn-primary mt-2" id="addTagBtn">Add</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Blog Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row justify-content-center align-items-center mt-4">
                            <div class="col-sm-4">
                                <input type="hidden" name="blog_media_id" id="page_image_id"
                                    value="{{ $addBlog->blog_media_id ?? '' }}">
                                <div class="image-box">
                                    <div class="d-flex flex-wrap gap-10 mb-3">
                                        <div class="preview-image-wrapper">
                                            <a type="button" title="Remove image"
                                                class="remove-btn style--three black d-none" id="page_image_remove"
                                                onclick="removeSelection('#page_image_preview')">
                                                <i class="ri-close-circle-fill"></i>
                                            </a>
                                            <img src="{{ isset($addBlog) && $addBlog->blog_media_id ? asset('storage/' . $addBlog->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
                                                alt="page_image" width="150" class="preview_image"
                                                id="page_image_preview">
                                        </div>
                                    </div>
                                    <div class="image-box-actions mb-3">
                                        <a type="button" class="btn-link" id="chooseFileBtn">
                                            Choose File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-body mt-5 mt-md-5 col-12">
                <h4 class="font-16 mb-2">Blog Status</h4>
                <div class="form-group row my-2">
                    <label for="page_parent" class="col-sm-4 font-14 bold black">Featured Status</label>
                    <div class="col-sm-8">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <input type="hidden" name="featured" value="0">
                            <!-- Hidden field to ensure a value is always submitted -->
                            <input class="form-check-input code-switcher" type="checkbox" name="featured" value="1"
                                {{ isset($addBlog) && $addBlog->featured ? 'checked' : '' }} id="tables-small-showcode">
                        </div>
                    </div>
                </div>
            </div>


            </form>
            <!-- end card body -->
        </div>

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
            $('#summernote').summernote({
                placeholder: '',
                tabsize: 5,
                height: 320,
                theme: 'bs4-dark'
            });

            $('.js-example-basic-multiple').select2();
            $("#datepicker").flatpickr();

            var baseURL = '{{ url('blog/category/') }}';
            var categoryNameInput = $('#categoryNameInput');
            var categorySlugInput = $('#categorySlug');

            categoryNameInput.blur(function() {
                var name = categoryNameInput.val().trim();
                if (name !== '') {
                    var slug = name.toLowerCase().replace(/\s+/g, '-');
                    var fullURL = baseURL + '/' + slug;
                    categorySlugInput.val(slug);
                }
            });

            $('#addCategoryBtn').click(function(event) {
                event.preventDefault();
                var categoryName = categoryNameInput.val();
                var parentId = $('#parentCategorySelect').val();
                var slug = categorySlugInput.val();

                $.ajax({
                    url: '{{ route('category.store') }}',
                    method: 'POST',
                    data: {
                        name: categoryName,
                        parent_id: parentId,
                        slug: slug
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        $('#categoryNameInput').val('');
                        $('#parentCategorySelect').val('');
                        $('#categorySlug').val('');

                        var option = $('<option>', {
                            value: response.category.id,
                            text: response.category.name
                        });
                        $('#categorySelect2').append(option);
                        $('#categorySelect2').select2('destroy').select2();

                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })

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

            var tagNameInput = $('#tagNameInput');
            var tagSlugInput = $('#tagSlug');

            tagNameInput.blur(function() {
                var name = tagNameInput.val().trim();
                if (name !== '') {
                    var slug = name.toLowerCase().replace(/\s+/g, '-');
                    var fullURL = baseURL + '/' + slug;
                    tagSlugInput.val(slug);
                }
            });

            $('#addTagBtn').click(function(event) {
                event.preventDefault();
                var tagName = tagNameInput.val();
                var slug = tagSlugInput.val();

                $.ajax({
                    url: '{{ route('tag.store') }}',
                    method: 'POST',
                    data: {
                        name: tagName,
                        slug: slug
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#tagNameInput').val('');
                        $('#tagSlug').val('');

                        var option = $('<option>', {
                            value: response.tag.id,
                            text: response.tag.name
                        });
                        $('#tagsSelect2').append(option);
                        $('#tagsSelect2').select2('destroy').select2();

                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })

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
        $(document).ready(function() {
            function updateVisibility(value) {
                $('.visibility-input').text(value);

                if (value === 'Password Protected') {
                    $('.additional-option-password').show();
                    $('.additional-option-public').hide();
                } else if (value === 'Public') {
                    $('.additional-option-public').show();
                    $('.additional-option-password').hide();
                } else if (value === 'Private') {
                    $('.additional-option-password').hide();
                    $('.additional-option-public').hide();
                } else {
                    $('.additional-option').hide();
                }
            }

            document.querySelectorAll('.visibility-radio').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    document.querySelector('.visibility-input-field').value = this.value;
                });
            });

            $('.visibility-radio').change(function() {
                var selectedValue = $(this).val();
                updateVisibility(selectedValue);
            });

            var initialValue = $('input[name="visibility"]:checked').val();
            updateVisibility(initialValue);

            // function sendFormData(formData, successMessage, errorMessage) {
            //     console.log($(this).attr('action'))
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         var method = $(this).find('input[name="_method"]').length > 0 ? 'PUT' : 'POST';
            //         console.log(type, url)
            //         dataType: 'json',
            //         data: formData,
            //         success: function(response) {
            //             Swal.fire(
            //                 'Success!',
            //                 successMessage,
            //                 'success'
            //             ).then((result) => {
            //                 if (result.isConfirmed) {
            //                     window.location.href =
            //                         '{{ route('add-blog.index') }}';
            //                 }
            //             });
            //         },
            //         error: function(xhr, status, error) {
            //             Swal.fire(
            //                 'Error!',
            //                 errorMessage,
            //                 'error'
            //             );
            //         }
            //     });
            // }

            function sendFormData(url, method, formData, successMessage, errorMessage) {
                $.ajax({
                    url: url,
                    method: method, // Assign the method here
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        Swal.fire(
                            'Success!',
                            successMessage,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    '{{ route('add-blog.index') }}';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            errorMessage,
                            'error'
                        );
                    }
                });
            }

            $('.btn-check').click(function() {
                console.log("rtyuiop")
                var formData = $('#blogForm').serializeArray();
                var status = $(this).val();
                formData.push({
                    name: 'status',
                    value: status
                });

                var method = $('#blogForm').find('input[name="_method"]').length > 0 ? 'PUT' : 'POST';
                var url = $('#blogForm').attr('action');

                sendFormData(url, method, formData, 'Your Blog Post Has Been Added.',
                    'An error occurred while adding the blog post.');
            });


            document.getElementById('chooseFileBtn').addEventListener('click', function() {
                $('#mediaUploadModal').modal('show');
            });

            // $('#publishBtn').click(function() {
            //     event.preventDefault();
            //     var formData = $('#blogForm').serializeArray();
            //     formData.push({
            //         name: 'status',
            //         value: 'published'
            //     });

            //     sendFormData(formData, 'Your Blog Post Has Been Published.',
            //         'An error occurred while publishing the blog post.');
            // });

            $('#publishBtn').click(function() {
                event.preventDefault();
                var formData = $('#blogForm').serializeArray();
                var datePickerValue = $('#datepicker').val();

                var statusValue = datePickerValue ? 'scheduled' : 'published';

                formData.push({
                    name: 'status',
                    value: statusValue
                });

                var method = $('#blogForm').find('input[name="_method"]').length > 0 ? 'PUT' : 'POST';

                var url = $('#blogForm').attr('action');

                sendFormData(url, method, formData, 'Your Blog Post Has Been Published.',
                    'An error occurred while publishing the blog post.');
            });
        });
    </script>
@endsection

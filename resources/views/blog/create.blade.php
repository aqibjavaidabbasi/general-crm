@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Add New Blog')
@section('content')


    <div class="row">
        <div class="col-xl-8">
            <form action="{{ route('add-blog.store') }}" method="POST">
                @csrf
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
                                                        class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter Name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Short
                                                    Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" name="description" rows="3"
                                                    placeholder="Enter Short Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-password-input">Content <span
                                                        class="text-danger">*</span> </label>
                                                <textarea class="form-control" id="summernote" name="content" rows="3" placeholder="Enter Short Description"></textarea>
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
                                                    id="gen-info-email-input" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta_description">Meta
                                                    Description</label>
                                                <textarea class="form-control" name="meta_description" id="meta_description" rows="3"
                                                    placeholder="Enter Short Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload Image</label>
                                                <input class="form-control" type="file" id="formFile">
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

                                <input type="checkbox" id="pendingCheckbox" name="status" value="pending"
                                    class="btn-check" autocomplete="off">
                                <label class="btn btn-warning rounded-pill" for="pendingCheckbox">Pending</label>

                                <input type="checkbox" id="previewCheckbox" name="status" value="preview"
                                    class="btn-check" autocomplete="off">
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
                                                name="visibilityOption" id="visibilityOptionPublic" value="public">
                                            <label class="form-check-label" for="visibilityOptionPublic">
                                                Public
                                            </label>
                                            <div class="additional-option-public form-check mt-2">
                                                <input class="form-check-input" type="checkbox" id="stickToBlogList">
                                                <label class="form-check-label" for="stickToBlogList">
                                                    Stick this post to the front of blog list page
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input visibility-radio" type="radio"
                                                name="visibilityOption" id="visibilityOptionPasswordProtected"
                                                value="password-protected">
                                            <label class="form-check-label" for="visibilityOptionPasswordProtected">
                                                Password Protected
                                            </label>
                                            <div class="additional-option-password" style="display: none;">
                                                <div class="input-group mt-2">
                                                    <input type="password" class="form-control" name="password"
                                                        id="passwordField" placeholder="Enter Password">
                                                </div>
                                                <div class="mt-2">
                                                    <span class="text-danger">If password field remain empty then
                                                        visibility will be saved as Public</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input visibility-radio" type="radio"
                                                name="visibilityOption" id="visibilityOptionPrivate" value="private">
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
                                <input type="text" id="datepicker" class="form-control" data-enable-time="true"
                                    data-date-format="d.m.y H:i" name="published_date_time"
                                    placeholder="Select date and time">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                        <button type="submit" class="btn btn-primary rounded-pill">Publish</button>
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
                        <input checked class="form-check-input" type="radio" name="format" id="format-standard"
                            value="standard">
                        <label class="form-check-label" for="format-standard">
                            Standard
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="format" id="format-audio" value="audio">
                        <label class="form-check-label" for="format-audio">
                            Audio
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="format" id="format-video" value="video">
                        <label class="form-check-label" for="format-video">
                            Video
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="format" id="format-gallery"
                            value="gallery">
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


                    <select class="js-example-basic-multiple mt-2" name="category_ids[]" multiple="multiple"
                        data-placeholder="Select Categories...">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                    <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#categoryFields"
                        aria-expanded="false" aria-controls="categoryFields">Add New Category</a>

                    <div class="collapse mt-2" id="categoryFields">
                        <div class="form-check mb-1">
                            <input type="text" class="form-control mt-2" placeholder="Enter Category">
                            <select name="" class="form-control mt-2" id="">
                                <option value="" selected disabled>Select Parent Category</option>
                                @foreach ($parentCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary mt-2">Add</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tags</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">


                    <select class="js-example-basic-multiple mt-2" name="tag_ids[]" multiple="multiple"
                        data-placeholder="Select Tags...">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach

                    </select>
                    <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#addTag"
                        aria-expanded="false" aria-controls="categoryFields">Add New Tag</a>

                    <div class="collapse mt-2" id="addTag">
                        <div class="form-check mb-1">
                            <input type="text" class="form-control mt-2" placeholder="Enter Category">
                            <button class="btn btn-primary mt-2">Add</button>
                        </div>
                    </div>


                </div>

            </div>
            <div class="card card-body mt-5 mt-md-5 col-12">
                <h4 class="font-16 mb-2">Blog Status</h4>
                <div class="form-group row my-2">
                    <label for="page_parent" class="col-sm-4 font-14 bold black">Featured Status
                    </label>
                    <div class="col-sm-8">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <input class="form-check-input code-switcher" type="checkbox" name="featured" value="1"
                                id="tables-small-showcode">
                        </div>
                    </div>
                </div>
            </div>

            </form>
            <!-- end card body -->
        </div>

    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to update the visibility value
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

            var initialValue = $('input[name="visibilityOption"]:checked').val();
            updateVisibility(initialValue);
        });
    </script>
@endsection

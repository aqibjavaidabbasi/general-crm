@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Add New Blog')
@section('content')


    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Blog</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form action="#">

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
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Short
                                                    Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" placeholder="Enter Short Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-password-input">Content <span
                                                        class="text-danger">*</span> </label>
                                                <textarea class="form-control" id="summernote" rows="3" placeholder="Enter Short Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">SEO Meta Tags</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form action="#">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-email-input">Meta Title </label>
                                                <input type="text" class="form-control" id="gen-info-email-input"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Meta
                                                    Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" placeholder="Enter Short Description"></textarea>
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
                    </form>
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
                    <form action="#">

                        <!-- Buttons -->
                        <div class="row mt-3 ">
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-primary rounded-pill ">Draft</button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-warning rounded-pill ">Pending</button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-info rounded-pill ">Preview</button>
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
                                                    name="visibilityOption" id="visibilityOptionPublic" value="Public">
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
                                                    value="Password Protected">
                                                <label class="form-check-label" for="visibilityOptionPasswordProtected">
                                                    Password Protected
                                                </label>
                                                <div class="additional-option-password" style="display: none;">
                                                    <div class="input-group mt-2">
                                                        <input type="text" class="form-control" id="passwordField"
                                                            placeholder="Enter Password">
                                                    </div>
                                                    <div class="mt-2">
                                                        <span class="text-danger">If Password Field is remain Empty then
                                                            visibility will be saved as Public</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input visibility-radio" type="radio"
                                                    name="visibilityOption" id="visibilityOptionPrivate" value="Private">
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
                                        data-date-format="d.m.y H:i" placeholder="Select date and time">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Format</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form action="#">
                        <!-- Visibility Section -->

                        <div class="form-check mb-2">
                            <input checked class="form-check-input" type="radio" name="visibilityOption"
                                id="format-standard" value="Public">
                            <label class="form-check-label" for="format-standard">
                                Standard
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="visibilityOption" id="format-audio"
                                value="Password Protected">
                            <label class="form-check-label" for="format-audio">
                                Audio
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="visibilityOption" id="format-video"
                                value="Private">
                            <label class="form-check-label" for="format-video">
                                Video
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibilityOption" id="format-gallery"
                                value="Private">
                            <label class="form-check-label" for="format-gallery">
                                Gallery
                            </label>
                        </div>
                </div>
                </form>
            </div>
            <!-- end card body -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categories</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <p class="mb-1">Only Active Categories</p>
                    <form action="#">
                        <!-- Visibility Section -->

                        {{-- <div class="col-lg-4"> --}}
                        <select class="js-example-basic-multiple mt-2" name="states[]" multiple="multiple"
                            data-placeholder="Select Categories...">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                        <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#categoryFields"
                            aria-expanded="false" aria-controls="categoryFields">Add New Category</a>
                        {{-- </div> --}}

                        {{-- <div class="row"> --}}
                        {{-- <div class="col-lg-12"> --}}
                        <div class="collapse mt-2" id="categoryFields">
                            <div class="form-check mb-1">
                                <input type="text" class="form-control mt-2" placeholder="Enter Category">
                                <select name="" class="form-control mt-2" id="">
                                    <option value="" selected disabled>Select Parent Category</option>
                                    @foreach ($parentCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    <option value="">3</option>
                                </select>
                                <button class="btn btn-primary mt-2">Add</button>
                            </div>
                        </div>
                        {{-- </div> --}}
                        {{-- </div> --}}

                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tags</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form action="#">
                        <!-- Visibility Section -->

                        {{-- <div class="col-lg-4"> --}}
                        <select class="js-example-basic-multiple" name="states[]" multiple="multiple"
                            data-placeholder="Select Tags...">
                            <optgroup label="UK">
                                <option value="London">London</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Liverpool">Liverpool</option>
                            </optgroup>
                            <optgroup label="FR">
                                <option value="Paris">Paris</option>
                                <option value="Lyon">Lyon</option>
                                <option value="Marseille">Marseille</option>
                            </optgroup>
                            <optgroup label="SP">
                                <option value="Madrid">Madrid</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Malaga">Malaga</option>
                            </optgroup>
                            <optgroup label="CA">
                                <option value="Montreal">Montreal</option>
                                <option value="Toronto">Toronto</option>
                                <option value="Vancouver">Vancouver</option>
                            </optgroup>
                        </select>

                        <a class="btn btn-primary rounded-pill mt-3" data-bs-toggle="collapse" href="#tagFields"
                            aria-expanded="false" aria-controls="categoryFields">Add New Tag</a>
                        {{-- </div> --}}

                        {{-- <div class="row"> --}}
                        {{-- <div class="col-lg-12"> --}}
                        <div class="collapse mt-2" id="tagFields">
                            <div class="form-check mb-1">
                                <input type="text" class="form-control mt-2" placeholder="Enter Tag">
                                <button class="btn btn-primary mt-2">Add</button>
                            </div>
                        </div>
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}

                    </form>
                </div>
            </div>
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


            $('.visibility-radio').change(function() {
                var selectedValue = $(this).val();
                updateVisibility(selectedValue);
            });

            var initialValue = $('input[name="visibilityOption"]:checked').val();
            updateVisibility(initialValue);
        });
    </script>
@endsection
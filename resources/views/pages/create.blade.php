@extends('layouts.app')
@section('page-title', 'Page-create')
@section('sub-page-title', 'Add New Page')

@section('content')
    <form action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Create Page</h4>
                    </div><!-- end card header -->
                    <div class="card-body form-steps">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel"
                                aria-labelledby="pills-gen-info-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-email-input">Page Title<span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" class="form-control" id="gen-info-email-input"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-password-input">Page
                                                Description<span class="text-danger">*</span> </label>
                                            <textarea class="form-control" id="page_description" name="page_description" rows="3"
                                                placeholder="Enter Short Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="gen-info-password-input">Content <span
                                                    class="text-danger">*</span> </label>
                                            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter Short Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                                <label class="form-label" for="gen-info-username-input">Meta
                                                    Description</label>
                                                <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea5" rows="3"
                                                    placeholder="Enter Short Description"></textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Feature image</label>
                                                <input class="form-control" name="featured_image_link" type="file"
                                                    id="formFile">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
            {{--  --}}
            <div class="col-xl-4">
                {{-- Category sec --}}
                <div class="card">
                    <div class="card card-body mt-5 mt-md-5 col-12">
                        <h4 class="font-16 mb-2">Publish</h4>
                        <div class="form-group row my-2">
                            <label for="page_parent" class="col-sm-4 font-14 bold black">Visibility
                            </label>
                            <div class="py-6">
                                <label>
                                    <input type="radio" name="visibility" value="public" checked>
                                    Public
                                </label>
                                <label>
                                    <input type="radio" name="visibility" value="private">
                                    Private
                                </label>
                            </div>


                            <div class="row my-2 mx-1">
                                <i class="icofont-ui-calendar icofont-1x mt-2"></i>
                                <span class="font-14 black ml-1 mt-2">Publish :</span>
                                <input type="datetime-local" name="published_date_time"
                                    class="theme-input-style w-75 ml-2 py-0" value="">
                            </div>
                        </div>
                    </div>
                    {{-- Category sec --}}
                    <div class="card card-body mt-5 mt-md-5 col-12">
                        <h4 class="font-16 mb-2">Categories</h4>
                        <div class="form-group row my-2">
                            <label for="page_parent" class="col-sm-4 font-14 bold black">Category
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category_id">
                                    <option value="">select category</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- toggle button for make homepage --}}
                    <div class="card card-body mt-5 mt-md-5 col-12">
                        <h4 class="font-16 mb-2">Page status</h4>
                        <div class="form-group row my-2">
                            <label for="page_parent" class="col-sm-4 font-14 bold black">simple page / home page
                            </label>
                            <div class="col-sm-8">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="tables-small-showcode" class="form-label text-muted">home page</label>
                                    <input class="form-check-input code-switcher" type="checkbox" name="make_homepage"
                                        value="1" id="tables-small-showcode">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- toggle button for make Simple Page --}}
                    <div class="card card-body mt-5 mt-md-5 col-12">
                        <h4 class="font-16 mb-2">Page Data</h4>
                        <div class="form-group row my-2">
                            <label for="page_parent" class="col-sm-4 font-14 bold black">simple page / content only
                            </label>
                            <div class="col-sm-8">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="tables-small-showcode" class="form-label text-muted">simple page</label>
                                    <input class="form-check-input code-switcher" type="checkbox" name="togle_status"
                                        value="1" id="tables-small-showcode">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- featured image --}}
                <div class="card">
                    <div class="card card-body mt-5 col-12 page_image">
                        <h4 class="font-16">Featured Image</h4>
                        <div class="form-group row justify-content-center align-items-center mt-4">
                            <div class="col-sm-4">
                                <input type="hidden" name="page_image" id="page_image_id" value="">
                                <div class="image-box">
                                    <div class="d-flex flex-wrap gap-10 mb-3">
                                        <div class="preview-image-wrapper">
                                            <img src="https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg"
                                                alt="page_image" width="150" class="preview_image"
                                                id="page_image_preview">
                                            <button type="button" title="Remove image"
                                                class="remove-btn style--three black d-none" id="page_image_remove"
                                                onclick="removeSelection('#page_image_preview,#page_image_id,#page_image_remove')"><i
                                                    class="icofont-close"></i></button>
                                        </div>

                                    </div>
                                    <div class="image-box-actions">
                                        <button type="button" class="btn-link" data-toggle="modal"
                                            data-target="#mediaUploadModal" id="page_image_choose"
                                            onclick="setDataInsertableIds('#page_image_preview,#page_image_id,#page_image_remove')">
                                            Choose File
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button>Submit thi form only</button>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <script>
        // for page description
        ClassicEditor
            .create(document.querySelector('#page_description'), {
                ckfinder: {
                    uploadUrl: '{{ route('img.upload') . '?_token=' . csrf_token() }}'
                }
            })
            .catch(error => {
                console.error(error);
            });
        // for content
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('img.upload') . '?_token=' . csrf_token() }}'
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection

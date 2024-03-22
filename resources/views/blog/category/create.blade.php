@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Blog Categories')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add/Edit Blog Category</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form
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
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Upload Image</label>
                                                <input class="form-control" name="meta_media_id" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

@endsection

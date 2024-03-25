@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Tags')
@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ isset($tag) ? 'Edit' : 'Add' }} Tag</h4>
                </div><!-- end card header -->
                <div class="card-body form-steps">
                    <form
                        action="{{ isset($tag) ? route('tag.update', ['tag' => $tag->id]) : route('tag.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($tag))
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
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="gen-info-email-input"
                                                    placeholder="Enter Name" name="name"
                                                    value="{{ isset($tag) ? $tag->name : '' }}">
                                                    @error('name')
                                                    {{-- @dd("yeahhhhhhhhhhhhhhhhh",$message) --}}
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12" id="permalink-section" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label" for="permalink">Permalink <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="permalink" name="slug"
                                                        readonly >
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#editSlugCollapse"
                                                        aria-expanded="false" aria-controls="editSlugCollapse">Edit</button>
                                                </div>
                                                <div class="collapse" id="editSlugCollapse">
                                                    <div class="mt-2">
                                                        <input type="text" class="form-control" id="slug"
                                                            name="slug"
                                                            value="{{ isset($tag) ? $tag->slug : '' }}">
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
                                                <label class="form-label" for="gen-info-email-input">Meta Title </label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    id="gen-info-email-input" placeholder="Enter Name"
                                                    value="{{ isset($tag) ? $tag->meta_title : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="gen-info-username-input">Meta
                                                    Description</label>
                                                <textarea class="form-control" name="meta_description" id="exampleFormControlTextarea5" rows="3"
                                                    placeholder="Enter Short Description">{{ isset($tag) ? $tag->meta_description : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Meta Image</label>
                                                <input class="form-control" name="meta_media_id" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($tag) ? 'Update' : 'Save' }}
                        </button>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <script>
        var baseURL = '{{ url('blog/tag/') }}';
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


@endsection

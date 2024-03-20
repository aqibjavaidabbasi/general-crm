@if ($files->isNotEmpty())
    @foreach ($files as $index => $file)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="file-thumbnail-container">
                <div class="file-thumbnail" data-file-id="{{ $file->id }}"
                    onclick="toggleSelection(event, {{ $file->id }})">
                    @if (Str::startsWith($file->type, 'image'))
                        <img src="{{ asset('storage/' . $file->url) }}" alt="{{ $file->alt ?? $file->name }}"
                            class="img-fluid mb-3 clickable-image">
                    @else
                        <img src="{{ asset('galaxy-theme/assets/images/new-document.png') }}" alt="file"
                            class="img-fluid mb-3 clickable-image">
                    @endif
                    <i class="ri-checkbox-circle-fill file-tick" id="tick{{ $file->id }}"></i> <!-- Tick icon -->
                </div>
            </div>




            <!-- Image Modal -->
            <div class="modal fade top" id="imageModal{{ $file->id }}" tabindex="-1"
                aria-labelledby="imageModalLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel{{ $index }}">Image Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Image -->
                                <div class="col-md-6">
                                    @if (Str::startsWith($file->type, 'image'))
                                        <img src="{{ asset('storage/' . $file->url) }}" alt="{{ $file->name }}"
                                            class="img-fluid mb-3">
                                        <img src="{{ public_path($file->url) }}" alt="">
                                    @else
                                        <img src="{{ asset('galaxy-theme/assets/images/new-document.png') }}"
                                            alt="file" class="img-fluid mb-3">
                                    @endif
                                </div>
                                <!-- Image Details -->
                                <div class="col-md-6">
                                    <p>Name: {{ $file->name }}</p>
                                    <p>Size: {{ $file->size }} KB</p>
                                    <p>Type: {{ $file->type }}</p>
                                    <p>Uploaded By: {{ $file->user->name }}</p>
                                    <p>Created At: {{ $file->created_at }}</p>
                                    <p>Updated At: {{ $file->updated_at }}</p>
                                    <!-- Input to Copy URL -->
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                            id="imageUrlInput{{ $index }}"
                                            value="{{ asset('storage/' . $file->url) }}" readonly>
                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="copyImageUrl({{ $index }})">Copy URL</button>
                                    </div>
                                    <!-- Download Button -->
                                    <a href="{{ asset('storage/' . $file->url) }}" download="{{ $file->name }}"
                                        class="btn btn-primary">Download</a>
                                    <!-- Delete Button -->
                                    <form id="deleteForm{{ $file->id }}"
                                        action="{{ route('media.destroy', $file->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <br>
                                    <form action="{{ route('media.update', ['medium' => $file->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mt-3">
                                            <input type="text" name="alt" class="form-control mb-2"
                                                placeholder="Alt Text" value="{{ $file->alt }}">
                                            <input type="text" name="title" class="form-control mb-2"
                                                placeholder="Title" value="{{ $file->title }}">
                                            <input type="text" name="caption" class="form-control mb-2"
                                                placeholder="Caption" value="{{ $file->caption }}">
                                            <textarea name="description" class="form-control mb-2" rows="3" placeholder="Description">{{ $file->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No files found.</p>
@endif

</div>

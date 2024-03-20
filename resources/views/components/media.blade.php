<div>
    @push('styles')
        <!-- dropzone css -->
        <link href="{{ asset('galaxy-theme/assets/libs/dropzone/dropzone.css') }}" type="text/css" />

        <!-- Filepond css -->
        <link href="{{ asset('galaxy-theme/assets/libs/filepond/filepond.min.css') }}" type="text/css" />
        <link
            href="{{ asset('galaxy-theme/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    @endpush

    {{-- @props(['files']) --}}


    <div class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary mb-2" data-bs-toggle="collapse" href="#collapseDropzone" role="button"
                aria-expanded="false" aria-controls="dropzone">Upload File</a>
            <div class="card collapse multi-collapse" id="collapseDropzone">
                <div class="card-header">
                    <h4 class="card-title mb-0">Dropzone</h4>
                </div>

                <div class="card-body">
                    <div id="dropzone" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>
                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Gallery</h4>
                        </div>
                        <div class="card-header">
                            <h4 class="card-title mb-0">Filter Media</h4>
                            <div class="mt-2 d-flex justify-content-between align-items-center">
                                <!-- Left side -->
                                <div>
                                    <div class="btn-group dropdown">
                                        <select class="form-select rounded-pill select-box" id="fileTypeDropdown">
                                            <div class="dropdown-menu dropdown-menu-dark">
                                                <option value="all" selected>All File Types</option>
                                                @foreach ($fileTypes as $fileType)
                                                    <option class="custom-dropdown-item" value="{{ $fileType }}">
                                                        {{ ucfirst($fileType) }}</option>
                                                @endforeach
                                            </div>
                                        </select>
                                    </div>
                                    <div class="btn-group ml-2">
                                        <select class="form-select rounded-pill select-box" id="dateDropdown">
                                            <option value="all" selected>All Dates</option>
                                            @foreach ($dates as $date)
                                                <option value="{{ $date }}">{{ $date }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <form class="app-search d-none d-md-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control  select-box"
                                            placeholder="Search..." autocomplete="off" id="search-options"
                                            value="">
                                        <span class="mdi mdi-magnify search-widget-icon"></span>
                                        <span
                                            class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                            id="search-close-options"></span>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" id="galleryContent">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-danger" id="deleteSelectedFilesBtn" disabled>Delete Selected
                            Files</button>
                    </div>
                </div>
            </div>

            @push('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('search-options').addEventListener('input', function() {
                            var searchText = this.value.trim();
                            var searchCloseIcon = document.getElementById('search-close-options');
                            if (searchText !== '') {
                                searchCloseIcon.classList.remove('d-none');
                            } else {
                                searchCloseIcon.classList.add('d-none');
                            }
                        });

                        document.getElementById('search-close-options').addEventListener('click', function() {
                            var searchInput = document.getElementById('search-options');
                            searchInput.value = '';
                            searchInput.dispatchEvent(new Event('input'));
                            this.classList.add('d-none');
                        });
                    });
                </script>

                <script>
                    Dropzone.autoDiscover = false;

                    var myDropzone = new Dropzone("#dropzone", {
                        url: "{{ route('media.store') }}",
                        paramName: 'file',
                        maxFilesize: 10,
                        acceptedFiles: null,
                        autoProcessQueue: false,
                        init: function() {
                            this.on("success", function(file, response) {
                                console.log("success");
                                location.reload();
                                console.log(response);
                            });
                            this.on("error", function(file, errorMessage) {
                                console.error(errorMessage);
                            });


                            this.on("addedfile", function(file) {
                                checkExistingFile.bind(this)(file);
                            });


                            this.on("drop", function(event) {
                                event.preventDefault();
                                const files = event.dataTransfer.files;
                                for (const file of files) {
                                    this.addFile(file);
                                }
                            });


                            var fileInput = this.element.querySelector("input[type='file']");
                            fileInput.addEventListener("change", function(event) {
                                const files = event.target.files;
                                for (const file of files) {
                                    this.addFile(file);
                                }
                            });
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    function checkExistingFile(file) {
                        const formData = new FormData();
                        formData.append('file', file);
                        const myDropzone = this;

                        fetch('{{ route('admin.check-file') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.exists) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...! File Already Exists!',
                                        text: 'A file with the same name already exists. Do you want to replace it or keep both?',
                                        showCancelButton: true,
                                        confirmButtonText: 'Replace',
                                        cancelButtonText: 'Keep Both',
                                        cancelButtonColor: '#3085d6',
                                        confirmButtonColor: '#d33',
                                        reverseButtons: true,
                                        showCancelButton: true,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const filename = file.name;
                                            deleteExistingFile(filename, file);
                                        } else {
                                            myDropzone.processFile(file);
                                        }
                                    });
                                } else {
                                    myDropzone.processFile(file);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });

                        function deleteExistingFile(filename, file) {
                            fetch('{{ route('admin.delete-existing-file') }}', {
                                    method: 'POST',
                                    body: JSON.stringify({
                                        filename: filename
                                    }),
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        myDropzone.processFile(file);
                                    } else {
                                        console.error('Error: File deletion failed');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }
                    }
                </script>
                <script>
                    function copyImageUrl(index) {
                        var input = document.getElementById('imageUrlInput' + index);
                        input.select();
                        document.execCommand('copy');
                    }
                </script>

                <script>
                    let selectedFiles = [];

                    function toggleSelection(event, fileId) {
                        const isCtrlPressed = event.ctrlKey || event.metaKey;
                        const fileThumbnail = document.querySelector(`.file-thumbnail[data-file-id="${fileId}"]`);
                        const tickIcon = document.getElementById('tick' + fileId);
                        const isSelected = fileThumbnail.classList.contains('selected');

                        if (isSelected || isCtrlPressed) {
                            const index = selectedFiles.indexOf(fileId);
                            if (index === -1) {
                                selectedFiles.push(fileId);
                                tickIcon.style.display = 'block';
                                fileThumbnail.classList.add('selected');
                            } else {
                                selectedFiles.splice(index, 1);
                                tickIcon.style.display = 'none';
                                fileThumbnail.classList.remove('selected');
                            }
                            event.stopImmediatePropagation();
                            event.preventDefault();
                            updateSelection();
                        } else {
                            const fileModal = new bootstrap.Modal(document.getElementById(`imageModal${fileId}`));
                            fileModal.show();
                            event.preventDefault();
                        }
                    }





                    function updateSelection() {
                        const deleteButton = document.getElementById('deleteSelectedFilesBtn');
                        if (selectedFiles.length > 0) {
                            deleteButton.removeAttribute('disabled');
                        } else {
                            deleteButton.setAttribute('disabled', 'disabled');
                        }
                    }

                    document.getElementById('deleteSelectedFilesBtn').addEventListener('click', function() {
                        if (selectedFiles.length === 0) {
                            return;
                        }

                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover these files!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete them!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '{{ route('admin.media.delete') }}',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    data: {
                                        files: selectedFiles
                                    },

                                    success: function(response) {
                                        console.log('Files deleted successfully:', response);
                                        selectedFiles = [];
                                        updateSelection();
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: 'Your files have been deleted.',
                                            icon: 'success',
                                            allowOutsideClick: false,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle error
                                        console.error('Error deleting files:', error);

                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'An error occurred while deleting files.',
                                            icon: 'error'
                                        });
                                    }
                                });
                            }
                        });
                    });
                </script>


                <script>
                    $(document).ready(function() {
                        var selectedFileType = 'all';
                        var selectedDate = 'all';

                        fetchData(selectedFileType, selectedDate);
                        $('#fileTypeDropdown').val(selectedFileType);
                        $('#dateDropdown').val(selectedDate);
                        $('#fileTypeDropdown, #dateDropdown').change();

                        $('#fileTypeDropdown').change(function() {
                            var selectedFileType = $(this).val();
                            var selectedDate = $('#dateDropdown').val();
                            fetchData(selectedFileType, selectedDate);
                        });

                        $('#dateDropdown').change(function() {
                            var selectedDate = $(this).val();
                            var selectedFileType = $('#fileTypeDropdown').val();
                            fetchData(selectedFileType, selectedDate);
                        });

                        $('#search-options').on('input', function() {
                            searchAfterDelay();
                        });

                        function fetchData(selectedFileType, selectedDate) {
                            var searchText = $('#search-options').val();
                            $.ajax({
                                type: "GET",
                                url: "{{ route('admin.filter-file') }}",
                                data: {
                                    fileType: selectedFileType,
                                    date: selectedDate,
                                    searchText: searchText
                                },
                                success: function(response) {
                                    $('#galleryContent').html(response);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }

                        var searchDelayTimer;

                        function searchAfterDelay() {
                            clearTimeout(searchDelayTimer);
                            searchDelayTimer = setTimeout(function() {
                                fetchData(getSelectedFileType(), getSelectedDate());
                            }, 1000);
                        }

                        function getSelectedFileType() {
                            return $('#fileTypeDropdown').val();
                        }

                        function getSelectedDate() {
                            return $('#dateDropdown').val();
                        }
                    });
                </script>
            @endpush
        </div>

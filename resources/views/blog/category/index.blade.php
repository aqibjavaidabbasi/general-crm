@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Blog Categories')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <div class="flex-grow-1">
                        <a class="btn btn-primary add-btn" href="{{ route('blog-category.create') }}"><i class="ri-add-fill me-1 align-bottom"></i> Add Blog Category</a>
                    </div>
                    <div class="col-md-4">
                        <div class="search-box">
                            <input type="text" class="form-control search" placeholder="Search for category...">
                            <i class="ri-search-line search-icon"></i>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="hstack text-nowrap gap-2">
                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
    <div class="col">
        <div class="card" id="contactList">
            {{-- <div class="card-header">
                <div class="row g-3">
                    <div class="col-md-auto ms-auto">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted">Sort by: </span>
                            <select class="form-control mb-0" data-choices data-choices-search-false id="choices-single-default">
                                <option value="Name">Name</option>
                                <option value="Company">Company</option>
                                <option value="Lead">Lead</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card-body">
                <div>
                    <div class="table-responsive table-card mb-3">
                        <table class="table align-middle table-nowrap mb-0" id="customerTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input mass-action-checkbox" type="checkbox" name="chk_child" value="{{ $category->id }}">
                                        </div>
                                    </th>
                                    <td data-sort="{{ $category->name }}">{{ $category->name }}</td>
                                    <td data-sort="{{ $category->name }}">{{ $category->parentCategory->name ?? '-'}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input feature-toggle" type="checkbox" {{ $category->featured ? 'checked' : '' }} data-category-id="{{ $category->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" {{ $category->status ? 'checked' : '' }} data-category-id="{{ $category->id }}">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="edit">
                                                <button class="btn btn-sm btn-primary edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                            </div>
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="deleteCategory('{{ route('blog-category.destroy', $category->id) }}')">Remove</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#8c68cd,secondary:#4788ff" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ contacts We did not find any contacts for you search.</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-end mt-3">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div> --}}
                </div>
                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header bg-soft-primary p-3">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            <form action="">
                                <div class="modal-body">
                                    <input type="hidden" id="id-field" />
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <div class="position-relative d-inline-block">
                                                    <div class="position-absolute  bottom-0 end-0">
                                                        <label for="customer-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Image">
                                                            <div class="avatar-xs cursor-pointer">
                                                                <div class="avatar-title bg-light border rounded-circle text-muted">
                                                                    <i class="ri-image-fill"></i>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <input class="form-control d-none" value="" id="customer-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                                    </div>
                                                    <div class="avatar-lg p-1">
                                                        <div class="avatar-title bg-light rounded-circle">
                                                            <img src="assets/images/users/user-dummy-img.jpg" id="customer-img" class="avatar-md rounded-circle object-cover" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <label for="name-field" class="form-label">Name</label>
                                                <input type="text" id="customername-field" class="form-control" placeholder="Enter name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="company_name-field" class="form-label">Company Name</label>
                                                <input type="text" id="company_name-field" class="form-control" placeholder="Enter company name" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="designation-field" class="form-label">Designation</label>
                                                <input type="text" id="designation-field" class="form-control" placeholder="Enter Designation" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="email_id-field" class="form-label">Email ID</label>
                                                <input type="text" id="email_id-field" class="form-control" placeholder="Enter email" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="phone-field" class="form-label">Phone</label>
                                                <input type="text" id="phone-field" class="form-control" placeholder="Enter phone no" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <label for="lead_score-field" class="form-label">Lead Score</label>
                                                <input type="text" id="lead_score-field" class="form-control" placeholder="Enter value" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="taginput-choices" class="form-label font-size-13 text-muted">Tags</label>
                                                <select class="form-control" name="taginput-choices" id="taginput-choices" multiple>
                                                    <option value="Lead">Lead</option>
                                                    <option value="Partner">Partner</option>
                                                    <option value="Exiting">Exiting</option>
                                                    <option value="Long-term">Long-term</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="add-btn">Add Contact</button>
                                        <button type="button" class="btn btn-primary" id="edit-btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end add modal-->

                <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" id="deleteRecord-close"  data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                            </div>
                            <div class="modal-body p-5 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#8c68cd,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                <div class="mt-4 text-center">
                                    <h4 class="fs-semibold">You are about to delete a contact ?</h4>
                                    <p class="text-muted fs-14 mb-4 pt-1">Deleting your contact will remove all of your information from our database.</p>
                                    <div class="hstack gap-2 justify-content-center remove">
                                        <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                        <button class="btn btn-danger" id="delete-record">Yes, Delete It!!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end delete modal -->

            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <!--end col-->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    var checkedIds = [];

    function updateCheckedIds() {
        checkedIds = [];
        $('.mass-action-checkbox:checked').each(function() {
            checkedIds.push($(this).val());
            console.log(checkedIds);
        });
    }

    $('.status-toggle').change(function() {
        var categoryId = $(this).data('category-id');
        var newStatus = $(this).prop('checked') ? 1 : 0;
        console.log(newStatus,categoryId)

        $.ajax({
            url: '{{ route('blog.category.update-status') }}',
            method: 'POST',
            data: {
                id: categoryId,
                status: newStatus
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Status updated successfully');
                Swal.fire(
                        'Updated!',
                        'Status have been updated.',
                        'success'
                    );
            },
            error: function(xhr, status, error) {
                Swal.fire(
                        'Error!',
                        'Failed to update status. Please try again later.',
                        'error'
                    );
            }
        });
    });

    $('.feature-toggle').change(function() {
        var categoryId = $(this).data('category-id');
        var newToggleStatus = $(this).prop('checked') ? 1 : 0;
        console.log(newToggleStatus,categoryId)

        $.ajax({
            url: '{{ route('blog.category.update-status') }}',
            method: 'POST',
            data: {
                id: categoryId,
                toggleStatus: newToggleStatus
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire(
                        'Updated!',
                        'Toggle Status have been updated.',
                        'success'
                    );
            },
            error: function(xhr, status, error) {
                Swal.fire(
                        'Error!',
                        'Failed to update toggle status. Please try again later.',
                        'error'
                    );
            }
        });
    });
    $(document).ready(function() {
        $('.mass-action-checkbox').change(function() {
            updateCheckedIds();
        });

        $('#checkAll').change(function() {
            var isChecked = $(this).prop('checked');
            $('.mass-action-checkbox').prop('checked', isChecked);
            updateCheckedIds();
        });
    });

    function deleteMultiple() {
        if (checkedIds.length === 0) {
            Swal.fire(
                'No item selected!',
                'Please select at least one item to delete.',
                'warning'
            );
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover deleted items!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('blog.category.mass-delete') }}',
                    method: 'POST',
                    data: {
                        ids: checkedIds
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your items have been deleted.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Failed to delete items. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function deleteCategory(categorySlug) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover deleted items!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: categorySlug, // Replace '/blog-category/' with your actual resource route
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your items have been deleted.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Failed to delete items. Please try again later.',
                        'error'
                    );
                }
            });
        }
    });
}

</script>











@endsection

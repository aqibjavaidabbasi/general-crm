@if ($categories->isNotEmpty())
    @foreach ($categories as $category)
        <tr>
            <th scope="row">
                <div class="form-check">
                    <input class="form-check-input mass-action-checkbox" type="checkbox" name="chk_child"
                        value="{{ $category->id }}">
                </div>
            </th>
            <td data-sort="{{ $category->name }}">{{ $category->name }}</td>
            <td data-sort="{{ $category->name }}">{{ $category->parentCategory->name ?? '-' }}</td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input feature-toggle" type="checkbox"
                        {{ $category->featured ? 'checked' : '' }} data-category-id="{{ $category->id }}">
                </div>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input status-toggle" type="checkbox"
                        {{ $category->status ? 'checked' : '' }} data-category-id="{{ $category->id }}">
                </div>
            </td>

            <td>
                <div class="d-flex gap-2">
                    <div class="edit">
                        <a href="{{ route('blog-category.edit', $category->id) }}"
                            class="btn btn-sm btn-primary edit-item-btn">Edit</a>
                    </div>
                    <div class="remove">
                        <button class="btn btn-sm btn-danger remove-item-btn"
                            onclick="deleteCategory('{{ route('blog-category.destroy', $category->id) }}')">Remove</button>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6">No Category Found.</td>
    </tr>
@endif

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
        console.log(newStatus, categoryId)

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
        console.log(newToggleStatus, categoryId)

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
                    'Featured Status have been updated.',
                    'success'
                );
            },
            error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'Failed to update featured status. Please try again later.',
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
                    url: categorySlug,
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
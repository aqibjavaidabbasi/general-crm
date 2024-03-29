@if ($tags->isNotEmpty())
    @foreach ($tags as $tag)
        <tr>
            <th scope="row">
                <div class="form-check">
                    <input class="form-check-input mass-action-checkbox" type="checkbox" name="chk_child"
                        value="{{ $tag->id }}">
                </div>
            </th>
            <td data-sort="{{ $tag->name }}">{{ $tag->name }}</td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input publish-toggle" type="checkbox"
                        {{ $tag->published ? 'checked' : '' }} data-tag-id="{{ $tag->id }}">
                </div>
            </td>

            <td>
                <div class="d-flex gap-2">
                    <div class="edit">
                        <a href="{{ route('tag.edit', $tag->id) }}"
                            class="btn btn-sm btn-primary edit-item-btn">Edit</a>
                    </div>
                    <div class="remove">
                        <button class="btn btn-sm btn-danger remove-item-btn"
                            onclick="deleteCategory('{{ route('tag.destroy', $tag->id) }}')">Remove</button>
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
        });
    }

    $('.publish-toggle').change(function() {
        var tagId = $(this).data('tag-id');
        var newToggleStatus = $(this).prop('checked') ? 1 : 0;
        console.log(newToggleStatus, tagId)

        $.ajax({
            url: '{{ route('blog.tag.update-status') }}',
            method: 'POST',
            data: {
                id: tagId,
                toggleStatus: newToggleStatus
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire(
                    'Updated!',
                    'Publish Status has been updated.',
                    'success'
                ).then(function() {
                        window.location.reload();
                    });
            },
            error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'Failed to update published status. Please try again later.',
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
                    url: '{{ route('blog.tag.mass-delete') }}',
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

@forelse ($blogs as $blog)
    <tr>
        <th scope="row">
            <div class="form-check">
                <input class="form-check-input mass-action-checkbox" type="checkbox" name="chk_child"
                    value="{{ $blog->id }}">
            </div>
        </th>
        <td>
            <img src="{{ isset($blog) && $blog->blog_media_id ? asset('storage/' . $blog->media->url) : 'https://cmslooks.themelooks.us/public/storage/all_files/2023/Feb/img-demo (1).jpg' }}"
                alt="blog_image" class="img-45">
        </td>
        <td>
            <a href="" class="btn-link">{{ $blog->name }}</a>
        </td>

        <td>
            {{ $blog->author->name }}
        </td>

        <td>
            @forelse ($blog->categories as $category)
                @if ($loop->last)
                    {{ $category->name }}
                @else
                    {{ $category->name }} , <br>
                @endif
            @empty
                -
            @endforelse
        </td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input feature-toggle" type="checkbox" {{ $blog->featured ? 'checked' : '' }}
                    data-blog-id="{{ $blog->id }}">
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class='bx bx-message-rounded-detail fs-22'></i>
                <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span
                        class="visually-hidden">unread messages</span></span>
            </button>
        </td>
        <td>
            <div class="d-flex flex-column align-items-center">
                <span
                    class="badge
                                                @if ($blog->status == 'published') badge-soft-success text-uppercase
                                                    @elseif($blog->status == 'pending')
                                                        badge-soft-warning text-uppercase
                                                    @elseif($blog->status == 'draft')
                                                        badge-soft-primary text-uppercase
                                                    @elseif($blog->status == 'scheduled')
                                                        badge-soft-info text-uppercase @endif rounded-pill">
                    {{ $blog->status }}
                </span>
                <span class="text-muted text-xs mt-1">
                    {{ Carbon\Carbon::parse($blog->created_at)->format('d-m-Y h:i A') }}
                </span>
            </div>
        </td>
        <td>
            <div class="dropdown d-inline-block">
                <button class="btn btn-soft-primary btn-sm dropdown" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="{{ route('add-blog.edit', $blog->id) }}" class="dropdown-item"> <i
                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                            Edit</a>
                    </li>
                    <li>
                        <a onclick="deleteBlog('{{ route('add-blog.destroy', $blog->id) }}')" class="dropdown-item"
                            role="button"> <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                            Remove</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9">No Blog Found.</td>
    </tr>
@endforelse


<script>
    var checkedIds = [];

    function updateCheckedIds() {
        checkedIds = [];
        $('.mass-action-checkbox:checked').each(function() {
            checkedIds.push($(this).val());
        });
    }

    $('.status-toggle').change(function() {
        var categoryId = $(this).data('category-id');
        var newStatus = $(this).prop('checked') ? 1 : 0;

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
                Swal.fire(
                    'Updated!',
                    'Status has been updated.',
                    'success'
                ).then(() => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'Failed to update status. Please try again later.',
                    'error'
                ).then(() => {
                    location.reload();
                });
            }
        });
    });

    $('.feature-toggle').change(function() {
        var blogId = $(this).data('blog-id');
        var newToggleStatus = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: '{{ route('blog.update-toggle-status') }}',
            method: 'POST',
            data: {
                id: blogId,
                toggleStatus: newToggleStatus
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire(
                    'Updated!',
                    'Featured Status has been updated.',
                    'success'
                ).then(function() {
                    window.location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire(
                    'Error!',
                    'Failed to update featured status. Please try again later.',
                    'error'
                ).then(() => {
                    location.reload();
                });
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
                    url: '{{ route('blog.mass-delete') }}',
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

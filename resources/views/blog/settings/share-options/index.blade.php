@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Settings')
@section('sub-sub-page-title', 'Blog Share Settings')
@section('content')



    <div class="row">
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <table id="example" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            @foreach ($shareOptions as $index => $shareOption)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shareOption->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox"
                                                {{ $shareOption->status ? 'checked' : '' }}
                                                data-shareoption-id="{{ $shareOption->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.status-toggle').change(function() {

            var shareOptionId = $(this).data('shareoption-id');
            var newToggleStatus = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('blog-share-options.update', ['blog_share_option' => ':shareOptionId']) }}'
                    .replace(':shareOptionId', shareOptionId),
                method: 'PUT',
                data: {
                    id: shareOptionId,
                    toggleStatus: newToggleStatus
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire(
                        'Updated!',
                        response.message,
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
    </script>

@endsection

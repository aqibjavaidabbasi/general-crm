@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Add New Blog')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Pages</h5>
                </div>
                <div class="card-body">
                    <div class="filter_button">

                        <a href="https://cmslooks.themelooks.us/admin/page-list" class="btn sm btn-dark mx-1 my-2">
                            All({{ count($pages) }})</a>

                        <a href="https://cmslooks.themelooks.us/admin/page-list?status=mine"
                            class="btn sm btn-dark sm mx-1 my-2">
                            Trash ({{ $pages->where('status', 0)->count() }})</a>

                        <a href="https://cmslooks.themelooks.us/admin/page-list?status=publish"
                            class="btn sm btn-success sm mx-1 my-2">
                            Published({{ $pages->where('published_status', 1)->count() }})</a>

                        {{-- <a href="https://cmslooks.themelooks.us/admin/page-list?status=schedule"
                            class="btn sm btn-info mx-1 my-2">
                            Scheduled({{ $pages->where('published_date_time', '>', now())->count() }})
                        </a> --}}



                    </div>
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th>SR No.</th>
                                <th>Title</th>
                                <th>Parrent</th>
                                <th>Visibility</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>HomePage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pages)
                                @foreach ($pages as $key => $page)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                                    value="option1">
                                            </div>
                                        </th>
                                        <td>{{ $page->id }}</td>
                                        <td>{{ $page->page_title }}—, {{ $page->visibility }}</td>
                                        <td>{{ $page->parent_page }}</td>
                                        <td>
                                            @if ($page->published_status == 1)
                                                <span class="btn sm btn-success sm mx-1 my-2">Publish</span>
                                            @else
                                                <span class="btn sm btn-danger mx-1 my-2">Un-Publish</span>
                                            @endif
                                        </td>
                                        <td>{{ $page->user_id }} :
                                            {{ $page->user_id ? $page->user_id : 'Admin' }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>
                                            @if ($page->make_homepage == 0)
                                                <a href="{{ route('pages.update-status', ['id' => $page->id, 'slug' => 'homepage']) }}"
                                                    class="btn btn-info sm ml-2">
                                                    NormalPage
                                                </a>
                                            @else
                                                <a href="{{ route('pages.update-status', ['id' => $page->id, 'slug' => 'page']) }}"
                                                    class="btn btn-info sm ml-2">
                                                    Make Homepage
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-primary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ route('pages.edit', $page->id) }}"
                                                            class="dropdown-item">
                                                            Edit</a></li>
                                                    <li><a href="{{ route('pages.trash', $page->id) }}"
                                                            class="dropdown-item edit-item-btn">
                                                            Trash</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('pages.destroy', $page->id) }}"
                                                            class="dropdown-item remove-item-btn">
                                                            Delete
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">

                                                            Page Builder
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td><span class="badge bg-danger">No Record! Found</span></td>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@endsection

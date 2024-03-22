@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'Add New Blog')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Scroll - Horizontal</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
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
                                        <td>{{ $key }}</td>
                                        <td>{{ $page->page_title }}—, {{ $page->visibility }}</td>
                                        <td>{{ $page->parent_page }}</td>
                                        <td>{{ $page->user_id }} :
                                            {{ $page->user_id ? $page->user_id : 'Admin' }}</td>
                                        <td>{{ $page->created_at }}</td>
                                        <td>
                                            @if ($page->make_homepage == 1)
                                                <a href="{{ route('pages.update-status', ['id' => $page->id, 'slug' => 'homepage']) }}"
                                                    class="btn btn-info sm ml-2">
                                                    Make Homepage
                                                </a>
                                            @else
                                                <a href="{{ route('pages.update-status', ['id' => $page->id, 'slug' => 'page']) }}"
                                                    class="btn btn-info sm ml-2">
                                                    Homepage
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
                                                    <li><a href="#!" class="dropdown-item">
                                                            Edit</a></li>
                                                    <li><a class="dropdown-item edit-item-btn">
                                                            Trash</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">

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

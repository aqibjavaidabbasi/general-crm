@extends('layouts.app')

@section('page-title', 'Blog')
@section('sub-page-title', 'All Blogs')
@section('content')



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="flex-grow-1">
                            <a class="btn btn-primary add-btn" href="{{ route('add-blog.create') }}">Add Blog</a>
                        </div>
                        <div class="app-search d-none d-md-block mr-2">
                            <div class="position-relative">
                                <input type="text" class="form-control  select-box" placeholder="Search..."
                                    autocomplete="off" id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="hstack text-nowrap gap-2">
                                <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group mt-2" role="group" aria-label="Record Filter">
                        {{-- <button type="button" class="btn rounded-pill btn-primary mx-2 filter-btn" value="all">All ({{$stats['all_count']}})</button> --}}
                        <button type="button" class="btn rounded-pill btn-primary mx-2 filter-btn" value="all">All (2)</button>
                        {{-- <button type="button" class="btn rounded-pill btn-success mx-2 filter-btn" value="featured">Featured ({{$stats['featured_count']}})</button> --}}
                        <button type="button" class="btn rounded-pill btn-success mx-2 filter-btn" value="featured">Featured (2)</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0" id="categoriesTablee">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Featured</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="filteredBlogsContent">



                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <!--end col-->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('#categoriesTable').DataTable();

            var searchDelayTimer;

            $('#search-options').on('input', function() {
                clearTimeout(searchDelayTimer);
                var searchText = $(this).val();
                searchDelayTimer = setTimeout(function() {
                    fetchData(searchText);
                }, 1000);
            });



            function fetchData(searchText, filter) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog.search-blog') }}",
                    data: {
                        searchText: searchText,
                        filter: filter,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#filteredBlogsContent').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }



            function handleInputChange(searchText) {
                if (searchText.trim() === '') {
                    fetchData(null, $('#filterBtn').val());
                } else {
                    clearTimeout(searchDelayTimer);
                    searchDelayTimer = setTimeout(function() {
                        fetchData(searchText, $('#filterBtn').val());
                    }, 1000);
                }
            }

            $('#search-options').on('input', function() {
                var searchText = $(this).val();
                handleInputChange(searchText);
            });

            $(window).on('load', function() {
                var searchText = $('#search-options').val();
                handleInputChange(searchText);
            });

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

            $('.filter-btn').click(function() {
                var filter = $(this).val();
                var searchText = $('#search-options').val();
                fetchData(searchText, filter);
            });

            $(document).on('click', '#pagination-container a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                var pageNumber = url.substring(url.indexOf('page=') + 5);

                fetchData(searchText, filter);
            });
        });
    </script>

@endsection

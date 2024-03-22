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
                            <a class="btn btn-primary add-btn" href="{{ route('blog-category.create') }}">Add Blog
                                Category</a>
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
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Featured</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="filteredCategoriesContent">


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
            var searchDelayTimer;

            $('#search-options').on('input', function() {
                clearTimeout(searchDelayTimer);
                var searchText = $(this).val();
                searchDelayTimer = setTimeout(function() {
                    fetchData(searchText);
                }, 1000);
            });

            function fetchData(searchText) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog.category.search-blog-categories') }}",
                    data: {
                        searchText: searchText,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        $('#filteredCategoriesContent').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }

            function handleInputChange(searchText) {
                if (searchText.trim() === '') {
                    fetchData(null);
                } else {
                    clearTimeout(searchDelayTimer);
                    searchDelayTimer = setTimeout(function() {
                        fetchData(searchText);
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
        });
    </script>

@endsection

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@yield('page-title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item active">@yield('page-title')</li>
                    <li class="breadcrumb-item active">@yield('sub-page-title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
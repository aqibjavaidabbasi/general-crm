@extends('layouts.app')

@section('page-title', 'Profile')
@section('content')

<div class="card">
    
    <div class="card-body p-4">
        <div class="tab-content">
            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                <form action="javascript:void(0);">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name"  name="name" placeholder="Enter your firstname" value="">
                            </div>
                        </div>
                        <!--end col-->


                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter your email" value="">
                            </div>
                        </div>
                        <!--end col-->


                        <!--end col-->
                        <!--end col-->
                        <div class="row g-2">

                            <div class="col-12">
                                <div>
                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                    <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-12">
                                <div>
                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                    <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
            <!--end tab-pane-->
            <div class="tab-pane" id="changePassword" role="tabpanel">
                <form action="javascript:void(0);">
                    <div class="row g-2">

                        <div class="col-12">
                            <div>
                                <label for="newpasswordInput" class="form-label">New Password*</label>
                                <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12">
                            <div>
                                <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>

            </div>
    </div>
</div>

@endsection





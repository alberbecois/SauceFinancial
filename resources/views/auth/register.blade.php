@extends('layouts.app')

@section('content')

<section class="h-100 h-custom">
    <div class="container-fluid py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-5">

                                <h3 class="fw-normal mb-5">General Infomation</h3>

                                <div class="row">
                                    <div class="form-outline mb-4">
                                        <input type="text" id="name" class="form-control form-control-lg" />
                                        <label class="form-label" for="name">Your Name</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-outline mb-4">
                                        <input type="email" id="password" class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Your Email</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password" class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password_confirmation" class="form-control form-control-lg" />
                                        <label class="form-label" for="password_confirmation">Repeat your password</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <div class="col-lg-6 bg-black text-white">
                        <div class="p-5">
                            <h3 class="fw-normal mb-5">Contact Details</h3>

                            <div class="mb-4 pb-2">
                                <div class="form-outline form-white">
                                    <input type="text" id="address" class="form-control form-control-lg" />
                                    <label class="form-label" for="address">Street Address</label>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-7 mb-4 pb-2">
                                    <div class="form-outline form-white">
                                        <input type="text" id="city" class="form-control form-control-lg" />
                                        <label class="form-label" for="city">City</label>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-4 pb-2">
                                    <div class="form-outline form-white">
                                        <input type="text" id="province" class="form-control form-control-lg" />
                                        <label class="form-label" for="province">Province</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-5 mb-4 pb-2">

                                    <div class="form-outline form-white">
                                        <input type="text" id="postalcode" class="form-control form-control-lg" />
                                        <label class="form-label" for="postalcode">Postal Code</label>
                                    </div>

                                </div>

                                <div class="col-md-7 mb-4 pb-2">

                                    <div class="form-outline form-white">
                                        <input type="text" id="phonenum" class="form-control form-control-lg" />
                                        <label class="form-label" for="phonenum">Phone Number</label>
                                    </div>

                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-light btn-lg">Register</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection
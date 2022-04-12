@extends('layouts.app')

@section('content')

<section class="h-100 h-custom">
    <form action="{{ route('register') }}" method="post">
        @csrf
    <div class="container-fluid py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">

                            <!-- Left side -->
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <h3 class="fw-normal mb-5">Login Infomation</h3>

                                    <div class="row">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}"/>
                                            <label class="form-label" for="name">Your Name</label>
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}"/>
                                            <label class="form-label" for="email">Your Email</label>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" />
                                            <label class="form-label" for="password">Password</label>
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-outline mb-4">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" />
                                            <label class="form-label" for="password_confirmation">Repeat your password</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End left side -->

                            <!-- Right side -->
                            <div class="col-lg-6 bg-black text-white">
                                <div class="p-5">

                                    <h3 class="fw-normal mb-5">Contact Details</h3>

                                    <div class="mb-4">
                                        <div class="form-outline form-white">
                                            <input type="text" id="address" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" value="{{ old('address') }}"/>
                                            <label class="form-label" for="address">Street Address</label>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-7 mb-4">
                                            <div class="form-outline form-white">
                                                <input type="text" id="city" name="city" class="form-control form-control-lg @error('city') is-invalid @enderror" value="{{ old('city') }}"/>
                                                <label class="form-label" for="city">City</label>
                                                @error('city')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-5 mb-4">
                                            <div class="form-outline form-white">
                                                <input type="text" id="province" name="province" class="form-control form-control-lg @error('province') is-invalid @enderror" value="{{ old('province') }}"/>
                                                <label class="form-label" for="province">Province</label>
                                                @error('province')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 mb-4">

                                            <div class="form-outline form-white">
                                                <input type="text" id="postalcode" name="postalcode" class="form-control form-control-lg @error('postalcode') is-invalid @enderror" value="{{ old('postalcode') }}"/>
                                                <label class="form-label" for="postalcode">Postal Code</label>
                                                @error('postalcode')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-7 mb-4">

                                            <div class="form-outline form-white">
                                                <input type="text" id="phonenumber" name="phonenumber" class="form-control form-control-lg @error('phonenumber') is-invalid @enderror" value="{{ old('phonenumber') }}"/>
                                                <label class="form-label" for="phonenumber">Phone Number</label>
                                                @error('phonenumber')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-light btn-lg">Register</button>
                                    <p class="text-center text-muted mt-5 mb-0">Already have an account? <a href="{{ route('login') }}" class="fw-bold"><u>Login here</u></a></p>

                                </div>
                            </div>
                            <!-- End right side -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

@endsection

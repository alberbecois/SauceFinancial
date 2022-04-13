@extends('layouts.app')

@section('content')
<div class="d-flex align-items-start py-5">
    <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <img class="mb-4" src="{{ URL('images/user.png') }}" alt="a default image of a user profile pic" style="width: 200px; height: 200px;">
        <button class="nav-link dashlinks active" id="v-pills-overview-tab" data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab" aria-controls="v-pills-overview" aria-selected="true">Overview</button>
        <button class="nav-link dashlinks" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
        <button class="nav-link dashlinks" id="v-pills-transactions-tab" data-bs-toggle="pill" data-bs-target="#v-pills-transactions" type="button" role="tab" aria-controls="v-pills-transactions" aria-selected="false">Transactions</button>
        <button class="nav-link dashlinks" id="v-pills-transfers-tab" data-bs-toggle="pill" data-bs-target="#v-pills-transfers" type="button" role="tab" aria-controls="v-pills-transfers" aria-selected="false">Transfers</button>
    </div>
    <div class="tab-content ms-5 w-100" id="v-pills-tabContent">
        <!-- Overview -->
        <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel" aria-labelledby="v-pills-overview-tab">
            <h3>Account Overview</h3> <br>
            <h4>Current Account Balance:  ${{ $balance }}</h4> <br>
            <h5>Most Recent Transactions:</h5>
            <div class="card mt-3">
                <div class="card-body">
                    @if ($transactions->count())
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($recent as $myrecent)
                                <tr>
                                    <td>{{ $myrecent->type }}</td>
                                    <td>{{ $myrecent->amount }}</td>
                                    <td>{{ $myrecent->description }}</td>
                                    <td>{{ $myrecent->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>You don't currently have any transactions to show.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile -->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <h3>My Profile</h3> <br>
            <h4>{{ auth()->user()->name }}</h4> <br>
            <address>
                {{ auth()->user()->address }} <br>
                {{ auth()->user()->city }}, {{ auth()->user()->province }} <br>
                {{ auth()->user()->postalcode }} <br><br>
                {{ auth()->user()->phonenum }} <br><br>
                {{ auth()->user()->email }}
            </address> <br>
            <p>Member since: <i>{{ auth()->user()->created_at }}</i></p>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Update Profile
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Profile Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="newaddress" class="form-label">Street Address</label>
                                    <input type="text" class="form-control" id="newaddress" value="{{ auth()->user()->address }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <label for="newcity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="newcity" value="{{ auth()->user()->city }}">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="newprovince" class="form-label">Province</label>
                                        <input type="text" class="form-control" id="newprovince" value="{{ auth()->user()->province }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label for="newpostalcode" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" id="newpostalcode" value="{{ auth()->user()->postalcode }}">
                                    </div>
                                    <div class="col-md-7">
                                        <label for="newphonenum" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="newphonenum" value="{{ auth()->user()->phonenum }}">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="newcity" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="newcity" value="{{ auth()->user()->email }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Transactions -->
        <div class="tab-pane fade" id="v-pills-transactions" role="tabpanel" aria-labelledby="v-pills-transactions-tab">
            <h3>My Transactions</h3>
            <div class="card mt-5">
                <div class="card-body">
                    @if ($transactions->count())
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>You don't currently have any transactions to show.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Transfers -->
        <div class="tab-pane fade" id="v-pills-transfers" role="tabpanel" aria-labelledby="v-pills-transfers-tab">

        </div>
    </div>
</div>

@endsection

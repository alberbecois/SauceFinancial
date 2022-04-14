@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show my-5" role="alert">
        <strong>Thanks for the update! </strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('trsferror'))
    <div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
        <strong>Uh-oh! </strong> {{ session('trsferror') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('trsfsuccess'))
    <div class="alert alert-success alert-dismissible fade show my-5" role="alert">
        <strong>Good gravy! </strong> {{ session('trsfsuccess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('invalidrequest'))
    <div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
        <strong>Uh-oh! </strong> {{ session('invalidrequest') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('accepted'))
    <div class="alert alert-success alert-dismissible fade show my-5" role="alert">
        <strong>Cha-ching! </strong> {{ session('accepted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('cancelled'))
    <div class="alert alert-warning alert-dismissible fade show my-5" role="alert">
        <strong>Sometimes it be like that! </strong> {{ session('cancelled') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="d-flex align-items-start py-5">
    <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <img class="mb-5" src="{{ URL('images/user.png') }}" alt="a default image of a user profile pic" style="width: 200px; height: 200px;">
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
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#userUpdate">
                Update Profile
            </button>

            <!-- Modal -->
            <div class="modal fade" id="userUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userUpdateLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userUpdateLabel">Update Profile Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="newaddress" class="form-label">Street Address</label>
                                    <input type="text" class="form-control" name="newaddress" value="{{ auth()->user()->address }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <label for="newcity" class="form-label">City</label>
                                        <input type="text" class="form-control" name="newcity" value="{{ auth()->user()->city }}">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="newprovince" class="form-label">Province</label>
                                        <input type="text" class="form-control" name="newprovince" value="{{ auth()->user()->province }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label for="newpostalcode" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control" name="newpostalcode" value="{{ auth()->user()->postalcode }}">
                                    </div>
                                    <div class="col-md-7">
                                        <label for="newphonenum" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="newphonenum" value="{{ auth()->user()->phonenum }}">
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="newemail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="newemail" value="{{ auth()->user()->email }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Update</button>
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
            <!-- Outbound -->
            <h3>Outbound Transfers</h3>
            <div class="card mt-5">
                <div class="card-body">
                    @if ($outbound->count())
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($outbound as $outboundtrsf)
                                <form action="{{ route('transfer') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                <tr>
                                    <td class="align-middle"><input class="form-control id-width" size="5" type="text" name="transferID" value="{{ $outboundtrsf->id }}" readonly></td>
                                    <td class="align-middle text-center">{{ $outboundtrsf->created_at }}</td>
                                    <td class="align-middle">{{ $outboundtrsf->recipient_name }}</td>
                                    <td class="align-middle">${{ $outboundtrsf->amount }}</td>
                                    <td class="align-middle">{{ $outboundtrsf->status }}</td>
                                    <td class="align-middle"><button type="submit" class="btn btn-warning" name="action" value="decline">Cancel</button></td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>You don't currently have any outbound transfers.</p>
                    @endif
                </div>
            </div>
            <!-- Inbound -->
            <h3 class="mt-5">Inbound Transfers</h3>
            <div class="card mt-5">
                <div class="card-body">
                    @if ($inbound->count())
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($inbound as $inboundtrsf)
                                <form action="{{ route('transfer') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                <tr>
                                    <td class="align-middle"><input class="form-control id-width" size="5" type="text" name="transferID" value="{{ $inboundtrsf->id }}" readonly></td>
                                    <td class="align-middle text-center">{{ $inboundtrsf->created_at }}</td>
                                    <td class="align-middle">{{ $inboundtrsf->sender_name }}</td>
                                    <td class="align-middle">${{ $inboundtrsf->amount }}</td>
                                    <td class="align-middle">{{ $inboundtrsf->status }}</td>
                                    <td class="align-middle"><button type="submit" class="btn btn-success" name="action" value="accept">Accept</button><button type="submit" class="btn btn-warning ms-2" name="action" value="decline">Decline</button></td>
                                </tr>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>You don't currently have any inbound transfers.</p>
                    @endif
                </div>
            </div>
            <!-- Completed -->
            <h3 class="my-5">Past Transfers</h3>
            <div class="card my-5">
                <div class="card-body">
                    @if ($completed->count())
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Sender</th>
                            <th scope="col">Recipient</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($completed as $completedtrsf)
                                <tr>
                                    <td class="align-middle">{{ $completedtrsf->created_at }}</td>
                                    <td class="align-middle">{{ $completedtrsf->sender_name }}</td>
                                    <td class="align-middle">{{ $completedtrsf->recipient_name }}</td>
                                    <td class="align-middle">${{ $completedtrsf->amount }}</td>
                                    <td class="align-middle">{{ $completedtrsf->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <p>You don't currently have any previous transfers.</p>
                    @endif
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#trsfCreate">
                Create a new transfer
            </button>

            <!-- Modal -->
            <div class="modal fade" id="trsfCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userUpdateLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="trsfCreateLabel">New Transfer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('transfer') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="destemail" class="form-label">Recipient Email: </label>
                                <input type="email" class="form-control" name="destemail" placeholder="yourluckyfriend@example.com">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="trsfamount" class="form-label">Transfer Amount: </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" name="trsfamount" placeholder="10.00" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p class="pt-4"><i>I acknowledge the transfer amount will be debited from my account immediately.</i></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-dark">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

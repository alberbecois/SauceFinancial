@extends('layouts.app')

@section('content')
<div class="d-flex align-items-start py-5">
    <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <img class="mb-4" src="{{ URL('images/user.png') }}" alt="a default image of a user profile pic" style="width: 200px; height: 200px;">
        <button class="nav-link active" id="v-pills-overview-tab" data-bs-toggle="pill" data-bs-target="#v-pills-overview" type="button" role="tab" aria-controls="v-pills-overview" aria-selected="true">Overview</button>
        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
        <button class="nav-link" id="v-pills-transactions-tab" data-bs-toggle="pill" data-bs-target="#v-pills-transactions" type="button" role="tab" aria-controls="v-pills-transactions" aria-selected="false">Transactions</button>
        <button class="nav-link" id="v-pills-transfers-tab" data-bs-toggle="pill" data-bs-target="#v-pills-transfers" type="button" role="tab" aria-controls="v-pills-transfers" aria-selected="false">Transfers</button>
    </div>
    <div class="tab-content ms-5 w-100" id="v-pills-tabContent">
        <!-- Overview -->
        <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel" aria-labelledby="v-pills-overview-tab">
            <h3>Account Overview</h3>

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

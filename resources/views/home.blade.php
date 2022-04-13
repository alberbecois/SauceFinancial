@extends('layouts.app')

@section('content')
    <section class="my-4">
        <div class="row mb-3 gradient-overlay">
            <img class="img-fluid" src="{{ URL('images/lightbulb.jpg') }}" alt="A picture of a lightbulb">
            <h1>Let's get this gravy!</h1>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img class="img-fluid" src="{{ URL('images/creditcards.jpg') }}" alt="image of a credit card">
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <h3>Banking just got better with rewards that you earn on money you were spending anyway.</h3>
                <br>
                <p>Here at Sauce Financial we understand that the times have changed and the way you use
                money along with it. We want you to be able to pay bills, send transfers, and make
                purchases anytime, anywhere, from any device; whether its your phone, laptop, tablet,
                smartwatch - you name it! Secure, easy to use, and connected to all of the businesses
                and people you need to be connected to.</p>
            </div>
        </div>
    </section>
    <section class="my-4 dark-section">
        <div class="row align-items-center py-4">
            <div class="col-md-6">
                <h3 class="px-2 px-md-4">Sop up these savings!</h3><br>
                <p class="px-2 px-md-4">What's more, at Sauce Financial, we understand how hard you work to earn your bread! No
                    matter what you spend you money on, earn cash back on every transaction. Because we all
                    deserve a little extra gravy.</p>
                <p class="px-2 px-md-4">At Sauce Financial we are committed to growing along with you. We will continue to come
                    up with services to help you save time and money. The gravy train doesn't stop here.</p>
            </div>
            <div class="col-md-6">
                <img class="img-fluid" src="{{ URL('images/banking-inv.png') }}" alt="image of a flowchart">
            </div>
        </div>
    </section>

@endsection

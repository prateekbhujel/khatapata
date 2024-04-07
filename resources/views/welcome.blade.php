@extends('layouts.front')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="display-4 font-weight-bold">{{ config('app.name') }}</h1>
            <p class="lead">Your Personal Finance Assistant</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="font-weight-bold btn btn-dark text-white">About Us</h2>
            <p class="lead">We're dedicated to helping you take control of your finances with our powerful expense tracking app.</p>
            <p>Our app is designed to be user-friendly, customizable, and packed with features to help you understand your spending habits and reach your financial goals.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container text-center">
            <h2 class="font-weight-bold text-white btn btn-dark">Key Features</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                       Text parqagaph here of feature
                </div>
            </div>
        </div>
    </section>
@endsection
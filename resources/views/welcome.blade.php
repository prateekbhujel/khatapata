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
            <p>Our app is designed to be user-friendly, customizable, and packed with features to help you understand your spending habits and reach your financial goals.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-dark">
        <div class="container">
            <h2 class="font-weight-bold text-white mb-4">Key Features</h2>
            <div class="row">
                @foreach ($features as $feature)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="card-title">{{ $feature->name }}</h4>
                                <p class="card-text">{!! $feature->description !!}</p>
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>
    </section>

@endsection
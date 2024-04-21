@extends('layouts.front')

@section('title', $settings->website_title)

@section('keywords', $settings->seo_keywords)

@section('description', $settings->seo_description)


@section('content')

    <!-- Hero Section -->
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="display-4 font-weight-bold">{{ $settings->name }}</h1>
            <p class="lead">{!! $settings->description !!}</p>
            @if (Auth::check('auth'))
                <a href="{{ route('user.dashboard.index') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
            @else
                <a href="{{ route($settings->btn_route) }}" class="btn btn-primary btn-lg">{{ $settings->btn_name }}</a>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="font-weight-bold btn btn-dark text-white">About Us</h2>
            <p>{!! $settings->about_us_description !!}</p>
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
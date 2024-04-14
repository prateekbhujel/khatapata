@extends('layouts.front')

@section('title', 'Login')

@section('keywords', $settings->seo_keywords)

@section('description', $settings->seo_description)

@section('content')
<div class="col-12">
    <!-- Main Content -->
    <div class="row">
        <div class="col-12 mt-3 text-center text-uppercase">
            <h2>Login</h2>
        </div>
    </div>

    <main class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="remember" name="remember" value="yes" class="form-check-input">
                                <label for="remember" class="form-check-label ml-2">Remember Me</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-dark">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <!-- Main Content -->
</div>
@endsection
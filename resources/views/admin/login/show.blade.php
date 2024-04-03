@extends('layouts.admin')

@section('title', 'Admin|Login')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4 mx-auto bg-white py-3 rounded-3 shadow-sm my-5">
            <div class="row">
                <div class="col text-center">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="#" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label"> Email: </label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>                        
                        <div class="mb-3">
                            <label for="password" class="form-label"> Password: </label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" value="yes" class="form-check-input">
                            <label for="remember" class="form-check-label"> Remember Me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>Log In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
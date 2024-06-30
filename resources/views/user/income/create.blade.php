@extends('layouts.user')

@section('title', 'Add Category')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Add Income
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('user.income.store') }}" method="post">
                    @csrf

                    <div class="col-5 mx-auto">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="double" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
                        </div>                             
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-save me-2"></i>Save
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
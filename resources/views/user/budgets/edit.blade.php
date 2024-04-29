@extends('layouts.user')

@section('title', 'Edit Budget')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>Edit Budget</h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('user.budgets.update', $budget->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="col-5 mx-auto">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $budget->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $budget->amount) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option selected disabled>Select Type</option>
                                <option value="Expense" @selected(old('type', $budget->type) == 'Expense')>Expense</option>
                                <option value="Income" @selected(old('type', $budget->type) == 'Income')>Income</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $budget->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>   
                                                                  
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" @selected(old('status', $budget->status) == 'Active')>Active</option>
                                <option value="Inactive"  @selected(old('status', $budget->status) == 'Inactive')>Inactive</option>
                            </select>
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

@extends('layouts.user')

@section('title', 'Edit Category')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Category
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('user.expense.update', [$category->id]) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="col-5 mx-auto">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="Expense" @selected(old('type', $category->type) == 'Expense')>Expense</option>
                                <option value="Income" @selected(old('type', $category->type) == 'Income')>Income</option>
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" @selected(old('status', $category->status) == 'Active')>Active</option>
                                <option value="Inactive" @selected(old('status', $category->status) == 'Inactive')>Inactive</option>
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
@extends('layouts.admin')

@section('title', 'Edit Feature')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Feature
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.features.update', [$feature->id]) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="col-5 mx-auto">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $feature->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Address</label>
                            <textarea name="description" id="description" class="form-control editor"> {{ old('description', $feature->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" @selected($feature->status == 'Active')>Active</option>
                                <option value="Inactive" @selected($feature->status == 'Inactive')>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-save me-2"></i>Update
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
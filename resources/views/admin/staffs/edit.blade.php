@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Staff
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.staffs.update', [$staff->id]) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="col-5 mx-auto">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $staff->name) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control-plaintext" value="{{ $staff->email }}" readonly style="background-color: #eeeeeecb">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $staff->phone) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="addresss" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address', $staff->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" @selected($staff->status == 'Active')>Active</option>
                                <option value="Inactive" @selected($staff->status == 'Inactive')>Inactive</option>
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
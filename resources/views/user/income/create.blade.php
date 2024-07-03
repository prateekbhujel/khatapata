@extends('layouts.user')

@section('title', 'Add Income')

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
                <form action="{{ route('user.income.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-5 mx-auto">
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="double" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" placeholder="1200" required>
                        </div>                             
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach   
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="income_note" class="form-label">Income Note</label>
                            <textarea name="income_note" id="income_note" class="form-control" placeholder="Income Note...." required>{{ old('income_note') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="income_receipts" class="form-label">Income Receipts</label><br>
                            <input type="file" name="income_receipts[]" id="images" class="form-control" accept="image/*" multiple>
                        </div>
                        <div class="row mt-3" id="img-container"></div>

                        <div class="mb-3">
                            <label for="income_date" class="form-label">Recieved Date</label>
                            <input type="date" name="income_date" id="income_date" class="form-control" value="{{ date('Y-m-d') }}" required>
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
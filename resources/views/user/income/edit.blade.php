@extends('layouts.user')

@section('title', 'Edit Income')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Income
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('user.income.update', [$income->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-5 mx-auto">
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="double" name="amount" id="amount" class="form-control" value="{{ old('amount', $income->amount) }}" placeholder="1200" required>
                        </div>                             
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($income->category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach   
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="income_note" class="form-label">Income Note</label>
                            <textarea name="income_note" id="income_note" class="form-control" placeholder="Income Note...." required>{{ old('income_note', $income->income_note) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Receipts</label>
                            <input type="file" name="income_receipts[]" id="images" class="form-control" accept="image/*" multiple>
                        </div>

                        <div class="row mt-3" id="img-container"></div>

                        <div class="row">
                            @foreach($income->income_receipts as $receipts)
                                <div class="col-4 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="{{ url("public/storage/images/income_receipts/$receipts") }}" class="img-fluid">
                                        </div>
                                        <div class="col-12 mt-3 text-center">
                                            <button type="button" class="btn btn-danger btn-sm img-delete-income" data-id="{{ $income->id }}" data-file="{{ $receipts }}">
                                                <i class="fa-solid fa-times me-2"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                        </div>

                        <div class="my-4">
                            <label for="income_date" class="form-label">Received Date</label>
                            <input type="date" name="income_date" id="income_date" class="form-control" value="{{ old('income_date', $income->income_date) }}" required>
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

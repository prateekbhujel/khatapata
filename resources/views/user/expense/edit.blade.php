@extends('layouts.user')

@section('title', 'Edit Expense')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Expense
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('user.expense.update', [$expense->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="col-5 mx-auto">
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="double" name="amount" id="amount" class="form-control" value="{{ old('amount', $expense->amount) }}" placeholder="1200" required>
                        </div>                             
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($expense->category_id == $category->id)>{{ $category->name }}</option>
                                    @endforeach   
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="expense_note" class="form-label">Expense Note</label>
                            <textarea name="expense_note" id="expense_note" class="form-control" placeholder="Expense Note...." required>{{ old('expense_note', $expense->expense_note) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Receipts</label>
                            <input type="file" name="expense_receipts[]" id="images" class="form-control" accept="image/*" multiple>
                        </div>

                        <div class="row mt-3" id="img-container"></div>

                        <div class="row">
                            @foreach($expense->expense_receipts as $receipts)
                                <div class="col-4 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="{{ url("public/storage/images/expense_receipts/$receipts") }}" class="img-fluid">
                                        </div>
                                        <div class="col-12 mt-3 text-center">
                                            <button type="button" class="btn btn-danger btn-sm img-delete-expense" data-id="{{ $expense->id }}" data-file="{{ $receipts }}">
                                                <i class="fa-solid fa-times me-2"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                        </div>

                        <div class="my-4">
                            <label for="expense_date" class="form-label">Received Date</label>
                            <input type="date" name="expense_date" id="expense_date" class="form-control" value="{{ old('expense_date', $expense->expense_date) }}" required>
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

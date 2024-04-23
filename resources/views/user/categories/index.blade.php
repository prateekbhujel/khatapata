@extends('layouts.user')

@section('title', 'Categories')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h1>Categories</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('user.categories.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Category
                    </a>
                </div>
            </div>
            
            <!-- Filter box -->
            <div class="card">
                <div class="card-body">
                    <form id="filterForm">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <label class="form-label btn btn-dark text-light btn-sm rounded">Status: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active">
                                    <label class="form-check-label" for="statusActive">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusInactive" value="Inactive">
                                    <label class="form-check-label" for="statusInactive">Inactive</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="form-label btn btn-sm btn-dark text-light rounded">Type:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="typeIncome" value="Income">
                                    <label class="form-check-label" for="typeIncome">Income</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="typeExpense" value="Expense">
                                    <label class="form-check-label" for="typeExpense">Expense</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DataTable -->
            <div class="row mt-3">
                <div class="col-md-12">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    {{ $dataTable->scripts() }}

    <script>
        $(document).ready(function() 
        {
            // Form submission
            $('#filterForm').on('submit', function(e) 
            {
                e.preventDefault();
                // Serialize form data
                var formData = $(this).serialize();
                // Get the current AJAX URL of the DataTable
                var dataTable = $('#category-table').DataTable();
                var ajaxUrl = dataTable.ajax.url();
                var newUrl;
                if (ajaxUrl.includes('?')) {
                    newUrl = ajaxUrl + '&' + formData;
                } else {
                    newUrl = ajaxUrl + '?' + formData;
                }
                dataTable.ajax.url(newUrl).load();
            });
        });
    </script>

@endpush

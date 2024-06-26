@extends('layouts.admin')

@section('title', 'Staffs')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Staffs
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.staffs.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Staff
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped', true]) }}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
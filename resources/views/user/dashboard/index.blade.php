@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <h1 class="my-4">Dashboard</h1>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Balance</h5>
                            <p class="card-text h5">Rs. {{ number_format($balance->balance ?? 0) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Budgets</h5>
                            <p class="card-text h5">{{ $budgetCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text h5">{{ $categoryCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-secondary text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title">Transactions</h5>
                            <p class="card-text h5">{{ $transactionCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($totalIncome > 0 || $totalExpenses > 0)
                <!-- Chart -->
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        {!! $chart->container() !!}
                    </div>
                </div>

                <!-- Total Income and Expenses -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Income</h5>
                                
                                <p class="card-text h3">Rs. {{ number_format($totalIncome) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Expenses</h5>
                                <p class="card-text h3">Rs. {{ number_format($totalExpenses) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    No income or expenses recorded yet. Start by adding your first transaction!
                </div>
            @endif

            @if(count($budgetSummary) > 0)
                <!-- Budget Summary -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h2 class="text-center mb-3">Budget Summary</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Budget Amount</th>
                                        <th>Used Amount</th>
                                        <th>Used Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budgetSummary as $budget)
                                        <tr>
                                            <td>{{ $budget['name'] }}</td>
                                            <td>Rs. {{ number_format($budget['amount']) }}</td>
                                            <td>Rs. {{ number_format($budget['used']) }}</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $budget['percentage'] }}%;" 
                                                         aria-valuenow="{{ $budget['percentage'] }}" 
                                                         aria-valuemin="0" aria-valuemax="100">
                                                        {{ $budget['percentage'] }}%
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    No budgets created yet. Start by setting up your first budget!
                </div>
            @endif

            @if($topIncomes->isNotEmpty() || $topExpenses->isNotEmpty())
                <!-- Top 5 Transactions -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h2 class="text-center mb-3">Top 5 Incomes</h2>
                        @if($topIncomes->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($topIncomes as $income)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $income->income_note }}
                                        <span class="badge bg-success rounded-pill">${{ number_format($income->amount, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center">No income transactions recorded yet.</p>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <h2 class="text-center mb-3">Top 5 Expenses</h2>
                        @if($topExpenses->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($topExpenses as $expense)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $expense->expense_note }}
                                        <span class="badge bg-danger rounded-pill">Rs .{{ number_format($expense->amount, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center">No expense transactions recorded yet.</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    No transactions recorded yet. Start by adding your first income or expense!
                </div>
            @endif
        </div>
    </div>
</div>
@if($totalIncome > 0 || $totalExpenses > 0)
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {!! $chart->script() !!}
@endif
@endsection
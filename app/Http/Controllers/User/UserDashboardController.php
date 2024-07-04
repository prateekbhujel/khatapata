<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Charts\TransactionsChart;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Balance;
use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index(TransactionsChart $chart)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $topIncomes = Income::where('user_id', $userId)->orderBy('amount', 'desc')->take(5)->get();
        $topExpenses = Expense::where('user_id', $userId)->orderBy('amount', 'desc')->take(5)->get();
        $balance = Balance::where('user_id', $userId)->first();
        
        // Calculate total income and expenses
        $totalIncome = Income::where('user_id', $userId)->sum('amount');
        $totalExpenses = Expense::where('user_id', $userId)->sum('amount');

        // Get number of categories and transactions
        $categoryCount = Category::where('user_id', $userId)->count();
        $transactionCount = Income::where('user_id', $userId)->count() + Expense::where('user_id', $userId)->count();

        // Get active budgets
        $budgets = Budget::where('user_id', $userId)
            ->where('status', 'Active')
            ->where('end_date', '>=', Carbon::now())
            ->get();
        
        $budgetSummary = [];
        foreach ($budgets as $budget) {
            $expenses = Expense::where('user_id', $userId)
                ->where('category_id', $budget->category_id)
                ->whereBetween('expense_date', [$budget->start_date, $budget->end_date])
                ->sum('amount');
            
            $usedPercentage = $budget->amount > 0 ? ($expenses / $budget->amount) * 100 : 0;
            
            $budgetSummary[] = [
                'name' => $budget->name,
                'amount' => $budget->amount,
                'used' => $expenses,
                'percentage' => round($usedPercentage, 2)
            ];
        }


        return view('user.dashboard.index', [
            'chart'         => $chart->build($totalIncome, $totalExpenses),
            'topIncomes'    => $topIncomes,
            'topExpenses'   => $topExpenses,
            'balance'       => $balance ?? 0,
            'budgetCount'   => $budgets->count(),
            'budgetSummary' => $budgetSummary,
            'totalIncome'   => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'user'          => $user,
            'categoryCount' => $categoryCount,
            'transactionCount' => $transactionCount,
        ]);

    }//End Method
}

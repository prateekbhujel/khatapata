<?php

namespace App\DataTables;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class ExpenseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    { 
        return (new EloquentDataTable($query))
        ->addColumn('action', function($expense){
            return '<form action="'.route('user.expense.destroy', [$expense->id]).'" method="post">
                        '.csrf_field().'
                        '.method_field('delete').'
                        <a href="'.route('user.expense.edit', [$expense->id]).'" class="btn btn-dark btn-sm">
                            <i class="fa-solid fa-edit me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm delete">
                            <i class="fa-solid fa-times me-2"></i>
                        </button>
                    </form>';
        })
        ->addColumn('receipt', function($expense) {
            return '<img src="' . url('public/storage/images/expense_receipts/' . $expense->thumbnail ?? '') . '" class="img-sm">';
        })
        ->addColumn('amount', function($expense){
            return   'Rs. ' .  number_format($expense->amount);
        })
        ->addColumn('name', function($expense){
            return $expense->category->name;
        })
        ->addColumn('note', function($expense){
            return Str::limit($expense->expense_note, 20, '...');
        })
        ->addColumn('expense_date', function($expense){
            return Carbon::parse($expense->expense_date)->format('M d, Y');
        })
        ->addColumn('created_at', function($expense){
            return $expense->created_at->toDayDateTimeString(); 
        })
        ->addColumn('updated_at', function($expense){
            return $expense->updated_at->toDayDateTimeString(); 
        })
        ->rawColumns(['receipt', 'action']);

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Expense $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('expense-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('amount'),
            Column::make('note'),
            Column::make('receipt'),
            Column::make('expense_date'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Expense_' . date('YmdHis');
    }
}

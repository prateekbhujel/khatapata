<?php

namespace App\DataTables;

use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IncomeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($income){
            return '<form action="'.route('user.income.destroy', [$income->id]).'" method="post">
                        '.csrf_field().'
                        '.method_field('delete').'
                        <a href="'.route('user.income.edit', [$income->id]).'" class="btn btn-dark btn-sm">
                            <i class="fa-solid fa-edit me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm delete">
                            <i class="fa-solid fa-times me-2"></i>
                        </button>
                    </form>';
        })
        ->addColumn('receipt', function($income) {
            return '<img src="' . url('public/storage/images/income_receipts/' . $income->thumbnail ?? '') . '" class="img-sm">';
        })
        ->addColumn('amount', function($data){
            return   'Rs. ' .  number_format($data->amount);
        })
        ->addColumn('name', function($income){
            return $income->category->name;
        })
        ->addColumn('note', function($income){
            return Str::limit($income->income_note, 20, '...');
        })
        ->addColumn('income_date', function($income){
            return Carbon::parse($income->income_date)->format('M d, Y');
        })
        ->addColumn('created_at', function($data){
            return $data->created_at->toDayDateTimeString(); 
        })
        ->addColumn('updated_at', function($data){
            return $data->updated_at->toDayDateTimeString(); 
        })
        ->rawColumns(['receipt', 'action']);

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Income $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', auth()->user()->id);

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('income-table')
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
            Column::make('income_date'),
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
        return 'Income_' . date('YmdHis');
    }
}

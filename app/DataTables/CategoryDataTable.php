<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($category) {
                return '<form action="' . route('user.categories.destroy', [$category->id]) . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field('delete') . '
                            <a href="' . route('user.categories.edit', [$category->id]) . '" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-edit me-2"></i>
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm delete">
                                <i class="fa-solid fa-times me-2"></i>
                            </button>
                        </form>';
            })
            ->addColumn('created_at', function ($data) {
                return $data->created_at->toDayDateTimeString();
            })
            ->addColumn('updated_at', function ($data) {
                return $data->updated_at->toDayDateTimeString();
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        $query = $model->newQuery()->where('user_id', Auth::user()->id);
        
        if (request()->has('status')) {
            if (request('status') !== 'All') {
                $query->where('status', request('status'));
            }
        }
        
        if (request()->has('type')) {
            if (request('type') !== 'All') {
                $query->where('type', request('type'));
            }
        }

        return $query;
    }

    

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                ['extend' => 'excel', 'className' => 'btn btn-success', 'text' => 'Export Excel'],
                ['extend' => 'pdf', 'className' => 'btn btn-danger', 'text' => 'Export PDF'],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('type'),
            Column::make('status'),
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
        return 'Category_' . date('YmdHis');
    }
}

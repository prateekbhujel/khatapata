<?php

namespace App\DataTables;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($staff){
            return '<form action="'.route('admin.staffs.destroy', [$staff->id]).'" method="post">
                        '.csrf_field().'
                        '.method_field('delete').'
                        <a href="'.route('admin.staffs.edit', [$staff->id]).'" class="btn btn-dark btn-sm">
                            <i class="fa-solid fa-edit me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm delete">
                            <i class="fa-solid fa-times me-2"></i>
                        </button>
                    </form>';
        })        
        ->addColumn('created_at', function($data){
            return $data->created_at->format('jS M, Y H:i:s'); 
        })
        ->addColumn('updated_at', function($data){
            return $data->updated_at->format('jS M, Y'); 
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Admin $model): QueryBuilder
    {
        return $model->newQuery()->where('type','Staff');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->width(120),
            Column::make('phone')->width(100),
            Column::make('email')->width(150),
            Column::make('address')->width(200),
            Column::make('status')->width(80),
            Column::make('created_at')->width(100),
            Column::make('updated_at')->width(100),
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
        return 'Admin_' . date('YmdHis');
    }
}

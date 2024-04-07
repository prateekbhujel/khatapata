<?php

namespace App\DataTables;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeatureDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        
        return (new EloquentDataTable($query))
        ->addColumn('action', function($feature){
            return '<form action="'.route('admin.features.destroy', [$feature->id]).'" method="post">
                        '.csrf_field().'
                        '.method_field('delete').'
                        <a href="'.route('admin.features.edit', [$feature->id]).'" class="btn btn-dark btn-sm">
                            <i class="fa-solid fa-edit me-2"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm delete">
                            <i class="fa-solid fa-times me-2"></i>
                        </button>
                    </form>';
        })        
        ->addColumn('created_at', function($data){
            return $data->created_at->format('jS M, Y'); 
        })
        ->addColumn('updated_at', function($data){
            return $data->updated_at->format('jS M, Y'); 
        });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Feature $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('feature-table')
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
            Column::make('name'),
            Column::make('description'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'), 
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Feature_' . date('YmdHis');
    }
}

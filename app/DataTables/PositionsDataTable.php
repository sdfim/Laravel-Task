<?php

namespace App\DataTables;

use App\Models\Position;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PositionsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('updated_at', function ($data) { return date('Y-m-d',strtotime($data->updated_at)); } )
            ->addColumn('action', function($data){
                $url= asset('positions/'.$data->id);
                $btn = '<a href="'.$url.'/edit"><i class="fa fa-pencil-alt"></i></a>' .
                '&#8195' .
                '<a href="'.$url.'"><i class="fa fa-trash-alt"></i></a>';
                return $btn;
            })->rawColumns(['action', 'confirmed'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Position $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Position $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('positions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->dom('<"d-flex justify-content-between"<"mt-4"B><"d-flex"l><"d-flex"f>>rt<"d-flex justify-content-between"<"d-flex"i><"d-flex"p>><"clear">')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        //Button::make('export'),
                        //Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    //protected function getColumns()
    //{
    //    return [
    //        Column::computed('action')
    //              ->exportable(false)
    //              ->printable(false)
    //              ->width(60)
    //              ->addClass('text-center'),
    //        Column::make('id'),
    //        Column::make('add your columns'),
    //        Column::make('created_at'),
    //        Column::make('updated_at'),
    //    ];
    //}
    protected function getColumns()
    {
        return [
            [ 'data' => 'id', 'name' => 'id', 'title' => 'ID' ],
            [ 'data' => 'position', 'name' => 'position', 'title' => 'Position' ],
            [ 'data' => 'level', 'name' => 'level', 'title' => 'Level' ],
            [ 'data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Last updete' ],
            Column::computed('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Positions_' . date('YmdHis');
    }
}

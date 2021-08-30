<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class EmployeesDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                $url = asset('employees/' . $data->id);
                $btn = '<a href="' . $url . '/edit"><i class="fa fa-pencil-alt" ></i></a>' . '&#8195';
                //$btn .= '<a href="'.$url.'"><i class="fa fa-trash-alt"></i></a>';
                $btn .= '<form action="' . $url . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn" onclick="return confirm(\'Are You Sure Want to Delete?\')"  style="padding:0px; color:red">
                    <i class="fa fa-trash-alt"></i></a>
                    </form>';

                return '<div class="row">' . $btn . '</div>';
            })
            ->editColumn('date_employment', function ($data) {
                return date("Y-m-d", strtotime($data->date_employment));
            })
            ->editColumn('salary', '${{$salary}}.00')
            ->editColumn('photo', function ($data) {
                if ($data->photo) {
                    $url = asset('storage/img/faces/sm-' . $data->photo);
                    $image = '<img src="' . $url . '" style="max-height: 50px; border-radius: 50%;">';
                } else {
                    $url = asset('storage/img/faces/no-profile-picture.png');
                    $image = '<img src="' . $url . '" style="max-height: 50px; border-radius: 50%;">';
                }
                return $image;
            })
            ->rawColumns(['photo', 'confirmed'], ['action', 'confirmed']);
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return $model->query()
            ->select(['employees.*', 'positions.position', 'positions.level',  'n1.name as head_name'])
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('employees as n1', 'employees.head_id', '=', 'n1.id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('employees')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bflrtpi')
            ->dom('<"d-flex justify-content-between"<"mt-4"B><"d-flex"l><"d-flex"f>>rt<"d-flex justify-content-between"<"d-flex"i><"d-flex"p>><"clear">')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                //Button::make('export'),
                //Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'employees.id', 'title' => 'ID'],
            ['data' => 'photo', 'title' => 'Photo', 'searchable' => false],
            ['data' => 'name', 'name' => 'employees.name', 'title' => 'Name'],
            ['data' => 'position', 'name' => 'positions.position', 'title' => 'Position'],
            ['data' => 'date_employment', 'name' => 'employees.date_employment', 'title' => 'Date of employment'],
            ['data' => 'head_name', 'name' => 'n1.name', 'title' => 'Head Name'],
            ['data' => 'phone', 'name' => 'employees.phone', 'title' => 'Phone'],
            ['data' => 'email', 'name' => 'employees.email', 'title' => 'Email'],
            ['data' => 'salary', 'name' => 'employees.salary', 'title' => 'Salary'],
            ['data' => 'level', 'name' => 'positions.level', 'title' => 'Level'],
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
        return 'Employees_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($item) {
                $buttons = '';
                 $buttons .= '<a class="dropdown-item" href="' . route('instructor.courses.edit', $item->id) . '" title="Edit"><i class="mdi mdi-square-edit-outline"></i> Edit </a>';

//                $buttons .= '<a class="dropdown-item" href="' . route('admin.qr.code', $item->id) . '" title="Edit"><i class="fas fa-qrcode"></i> Generate QR Code </a>';

//                 $buttons .= '<a class="dropdown-item" href="' . route('admin.qr.code', $item->id) . '" title="Edit"><i class="fas fa-qrcode"></i> Generate QR Code </a>';

                // TO-DO: need to chnage the super admin ID to 1, while Super admin ID will 1
                 $buttons .= '<form action="' . route('instructor.courses.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                 <input type="hidden" name="_token" value="' . csrf_token() . '">
                 <input type="hidden" name="_method" value="DELETE">
                 <button class="dropdown-item text-danger" onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit" title="Delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button></form>
                 ';
                return '<div class="btn-group dropleft">
                <a href="#" onclick="return false;" class="btn btn-sm btn-dark text-white dropdown-toggle dropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu">
                ' . $buttons . '
                </div>
                </div>';
            })->editColumn('instructor_id', function ($item) {
                return $item->instructor->first_name . ' ' . $item->instructor->last_name;
            })
            ->rawColumns(['action', 'instructor_id'])
            ->setRowId('id');

    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery()->where('instructor_id','=',auth()->user()->id)->orderBy('id', 'ASC')->select('courses.*');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('course-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action']);
//             ->buttons([
//                        Button::make('excel'),
//                        Button::make('csv'),
//                        Button::make('pdf'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    ]);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
//            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('name', 'name')->title('Course Name'),
            Column::make('instructor_id', 'instructor_id')->title('Instructor'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'course_' . date('YmdHis');
    }
}

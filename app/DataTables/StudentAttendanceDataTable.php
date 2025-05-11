<?php

namespace App\DataTables;

use App\Models\Attendance;
use App\Models\StudentAttendance;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentAttendanceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('student_id', function ($item) {
                return $item->student->first_name . ' ' . $item->student->last_name;
            })
            ->editColumn('course_id', function ($item) {
                return $item->course->name;
            })
            ->editColumn('instructor_id', function ($item) {
                return $item->instructor->first_name . ' ' . $item->instructor->last_name;
            })
            ->editColumn('scanned_at', function ($item) {
                return $item->scanned_at;
            })
            ->rawColumns(['student_id','course_id','scanned_at','instructor_id'])
            ->setRowId('id');

    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Attendance $model): QueryBuilder
    {
        return $model->newQuery()->where('student_id', '=', auth()->user()->id)->orderBy('id', 'ASC')->select('attendances.*');
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
            ->selectStyleSingle();
//            ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action']);
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
            Column::make('student_id', 'student_id')->title('Student Name'),
            Column::make('course_id', 'course_id')->title('Course Name'),
            Column::make('instructor_id', 'instructor_id')->title('Instructor Name'),
            Column::make('scanned_at', 'scanned_at')->title('Scanned At'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'attendance_' . date('YmdHis');
    }
}

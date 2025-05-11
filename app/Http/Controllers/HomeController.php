<?php

namespace App\Http\Controllers;

use App\DataTables\AdminAttendanceDataTable;
use App\DataTables\InstructorAttendanceDataTable;
use App\DataTables\StudentAttendanceDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_type = Auth::user()->user_type;

        if($user_type === User::USER_TYPE_STUDENT){
            $dataTable = new StudentAttendanceDataTable();
            return $dataTable->render('admin.dashboard.student-index');
        }

        if($user_type === User::USER_TYPE_INSTRUCTOR){
            $dataTable = new InstructorAttendanceDataTable();
            return $dataTable->render('admin.dashboard.instructor-index');
        }

        if($user_type === User::USER_TYPE_ADMIN){
            $dataTable = new AdminAttendanceDataTable();
            return $dataTable->render('admin.dashboard.admin-index');
        }

        return view('admin.dashboard.index');
    }
}

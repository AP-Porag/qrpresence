<?php

namespace App\Http\Controllers;

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
            return view('admin.dashboard.student-index');
        }

        if($user_type === User::USER_TYPE_INSTRUCTOR){
            return view('admin.dashboard.instructor-index');
        }

        if($user_type === User::USER_TYPE_ADMIN){
            return view('admin.dashboard.admin-index');
        }

        return view('admin.dashboard.index');
    }
}

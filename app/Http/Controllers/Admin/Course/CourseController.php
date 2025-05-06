<?php

namespace App\Http\Controllers\Admin\Course;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CourseDataTable $dataTable)
    {
        set_page_meta('course');
        return $dataTable->render('admin.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Course');
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        try {
            $this->courseService->storeOrUpdate($data, null);
            record_created_flash();
            return redirect()->route('instructor.courses.index');
        } catch (\Exception $e) {
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        set_page_meta('Course Edit');
        $course = Course::find($id);
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {

        try {
            $data = $request->validated();
            $this->courseService->storeOrUpdate($data, $id);
            record_updated_flash();
            return redirect()->route('instructor.courses.index');
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->courseService->delete($id);
            record_deleted_flash();
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}

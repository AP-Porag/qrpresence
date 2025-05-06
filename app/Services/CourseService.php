<?php

namespace App\Services;


use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;
use App\Services\BaseService;

class CourseService extends BaseService
{

    protected $model;

    public function __construct()
    {
        $this->model = Course::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}


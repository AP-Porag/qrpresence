<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;
use App\Services\BaseService;

class UserService extends BaseService
{

    protected $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            // manage additional data
            $data['department'] = Str::lower($data['department']);
            $data['password'] = Hash::make($data['password']);
            //$data['slug'] = Str::slug($data['title']);
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}


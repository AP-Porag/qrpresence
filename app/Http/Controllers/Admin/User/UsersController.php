<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(UserDataTable $dataTable)
    {
        set_page_meta('Admins');
        return $dataTable->render('admin.users.index');
    }

    public function create()
    {
        set_page_meta('Create User');
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        try {
            $this->userService->storeOrUpdate($data, null);
            record_created_flash();
        } catch (\Exception $e) {
        }
        return back();
    }

    public function edit($id)
    {
        try {
            set_page_meta('Edit User');
            $user = $this->userService->get($id);
            return view('admin.users.edit', compact('user'));
        } catch (\Exception $e) {
            log_error($e);
        }
        return back();
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->userService->storeOrUpdate($data, $id);
            record_updated_flash();
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            record_deleted_flash();
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }

}

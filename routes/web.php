<?php

use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Profile\UserProfileController;
use App\Http\Controllers\Admin\User\UsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/execute-command', function () {
    Artisan::call('storage:link');
    Artisan::call('migrate:fresh --seed');
    dd('All commands executed successfully');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//all routes for admin
Route::prefix('admin')->as('admin.')->group(function () {
    // USER
    Route::resource('users', UsersController::class);
    // PROFILE
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.info');
    Route::post('/avatar/update', [UserProfileController::class, 'avatarUpdate'])->name('avatar.update');
    Route::put('/profile/update/{id}', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/pass/update/', [UserProfileController::class, 'updatePassword'])->name('update.password');

});

//all routes for instructor
Route::prefix('instructor')->as('instructor.')->group(function () {

    // USER
    Route::resource('users', UsersController::class);

    // course
    Route::resource('courses', CourseController::class);
    // PROFILE
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.info');

});

//all routes for student
Route::prefix('student')->as('student.')->group(function () {

    // USER
    Route::resource('users', UsersController::class);
    // PROFILE
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.info');

});



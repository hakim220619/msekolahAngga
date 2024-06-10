<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AplikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UsersController;

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
    return view('backend.auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');
Route::get('/forgetPassword', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forgetPassword/action', [AuthController::class, 'forgetPasswordAction'])->name('forgetPasswordAction');
Route::get('/resetPassword/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPassword/action', [AuthController::class, 'resetPasswordAction'])->name('resetPasswordAction');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'view'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //Aplikasi
    Route::get('aplikasi', [AplikasiController::class, 'view'])->name('aplikasi');
    Route::post('/aplikasi/editProses', [AplikasiController::class, 'editProses'])->name('aplikasi.editProses');


    //Admin
    Route::get('admin', [AdminController::class, 'view'])->name('admin');
    Route::get('addAdmin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin');
    Route::post('admin/addProses', [AdminController::class, 'addProses'])->name('admin.addProses');
    Route::post('admin/editProses', [AdminController::class, 'editProses'])->name('admin.editProses');
    Route::post('admin/changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::get('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    //Users
    Route::get('users', [UsersController::class, 'view'])->name('users');
    Route::get('addUsers', [UsersController::class, 'addUsers'])->name('users.addUsers');
    Route::post('users/addProses', [UsersController::class, 'addProses'])->name('users.addProses');
    Route::post('users/editProses', [UsersController::class, 'editProses'])->name('users.editProses');
    Route::post('users/changePassword', [UsersController::class, 'changePassword'])->name('users.changePassword');
    Route::get('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

    //Students
    Route::get('students', [StudentsController::class, 'view'])->name('students');
    Route::get('students/load_data', [StudentsController::class, 'load_data'])->name('students.load_data');
    Route::post('students/UploadStudents', [StudentsController::class, 'UploadStudents'])->name('students.UploadStudents');
    Route::post('students/proses', [StudentsController::class, 'proses'])->name('students.proses');
    Route::post('students/delete', [StudentsController::class, 'delete'])->name('students.delete');

    //kriteria
    Route::get('/absensi', [AbsensiController::class, 'view'])->name('absensi');
    Route::post('/absensi/addProses', [AbsensiController::class, 'addProses'])->name('absensi.addProses');


    //Profile
    Route::get('profile', [ProfileController::class, 'view'])->name('profile');
    //Profile
    Route::get('gaji', [GajiController::class, 'view'])->name('gaji');
    Route::post('/gaji/addProses', [GajiController::class, 'addProses'])->name('gaji.addProses');
});

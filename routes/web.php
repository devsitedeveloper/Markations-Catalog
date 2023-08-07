<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Models\Cource_catalogModel;

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

// Route::get('404', function () {
//     return view('404-page');
// });

Auth::routes();

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes...
Route::get('admin/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::group(['middleware' => 'auth' ], function () {

    // admin-dashboard 
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('home');

    // Users
    Route::resource('/admin/users', UsersController::class);
    Route::post('/admin/users/save', [UsersController::class, 'save'])->name('users.save');
    Route::post('/admin/users/update', [UsersController::class, 'update'])->name('userupdate');
    Route::delete('/admin/users/destroy/{id}', [UsersController::class, 'destroy'])->name('usersdestroy');
    
    Route::get('/admin/users/{id}/profile', [UsersController::class, 'profile'])->name('users.profile');
    Route::post('admin/users/edit',  [UsersController::class, 'profile_edit'])->name('user.profile.edit');

    Route::get('admin/users/changepassword/{id}', [UsersController::class, 'changepassword'])->name('changepassword');
    Route::post('admin/users/savepassword', [UsersController::class, 'savepassword'])->name('savepassword');

    Route::post('admin/users/multi-delete', [UsersController::class, 'multiple_delete'])->name('user.multi.delete');

    // Catalogs    
    Route::post('admin/course-catalog/getCatalogs', [Cource_catalogModel::class, 'getCatalogs'])->name('catalogs.getCatalogs');
    Route::post('admin/course-catalog/change_session', [Cource_catalogModel::class, 'change_session'])->name('catalogs.change_session');
});

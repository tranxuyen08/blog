<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});

Route::get('posts/{id}/detail', [HomeController::class, 'detail']);
Route::get('posts/create_comments', [HomeController::class, 'create_comments']);

Route::get('/admin/users', [AdminController::class, 'users']);

// Route::middleware(['guest'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin_index');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin_login');
// });

Route::middleware(['admin_role'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin_home');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admn_logout');

});
// Route::get('/admin/logout', [AdminContrller::class, 'logout'])->name('admn_logout');

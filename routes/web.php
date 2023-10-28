<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    $blog = Blog::first();
    return view('index', compact('blog'));
});

Route::get('/run_command', function () {
    Artisan::call('storage:link');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/blog', [App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
    Route::post('/admin/blog', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/{blog}', [App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/admin/blog/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');
    Route::get('/admin/blog/delete/{blog}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.delete');
});

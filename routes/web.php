<?php

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

Route::get('/', function () {
    return view('welcome');
})->name("root");


// route prefix admin and middleware auth
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    Route::resource('users', App\Http\Controllers\UserController::class, ['as' => 'admin'])->except(['show', 'create']);



    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'store'])->name('filepond.upload');
    Route::delete('/revert', [App\Http\Controllers\UploadController::class, 'destroy'])->name('filepond.revert');
});


Route::fallback(function () {
    return abort(404);
});

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// route prefix admin and middleware auth
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');

    Route::resource('users', App\Http\Controllers\UserController::class, ['as' => 'admin'])->except(['show', 'create']);
    Route::resource('penulis', App\Http\Controllers\PenulisController::class, ['as' => 'admin'])->except(['show', 'create']);

    Route::resource('articles', App\Http\Controllers\ArticleController::class, ['as' => 'admin'])->except(['create']);

    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('admin.comments.destroy');

    Route::get('test', function () {
        return view('pages.comment.test');
    });


    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'store'])->name('filepond.upload');
    Route::delete('/revert', [App\Http\Controllers\UploadController::class, 'destroy'])->name('filepond.revert');
});

Route::get('/artikel/{id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('artikel.detail');

Route::post('/comment/{id}', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');


Route::fallback(function () {
    return abort(404);
});

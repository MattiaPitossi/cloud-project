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




/*
|--------------------------------------------------------------------------
| FileUploadedController
|--------------------------------------------------------------------------
*/

Route::get('/files/download/{id}', [App\Http\Controllers\FileUploadedController::class, 'download'])->name('downloadfile');
Route::get('/index', [App\Http\Controllers\FileUploadedController::class, 'getAll'])->name('getAll');
Route::post('/files', [App\Http\Controllers\FileUploadedController::class, 'store'])->name('file.upload');
Route::delete('/files/delete', [App\Http\Controllers\FileUploadedController::class, 'deleteAll'])->name('myFilesDeleteAll');
Route::get('/files/search', [App\Http\Controllers\FileUploadedController::class, 'search']);
Route::put('/files/update/{id}/name/{name}', [App\Http\Controllers\FileUploadedController::class, 'update'])->name('file.update');
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/recently', [App\Http\Controllers\FileUploadedController::class, 'getRecentlyAddedFiles'])->name('get_recently_added');

/*
|--------------------------------------------------------------------------
| DeletedFilesController
|--------------------------------------------------------------------------
*/

Route::get('/files/restore/{id}', [App\Http\Controllers\DeletedFilesController::class, 'restoreFile'])->name('restorefile');
Route::get('/deleted/files', [App\Http\Controllers\DeletedFilesController::class, 'getDeletedFiles'])->name('file_deleted');
Route::get('/files/restore', [App\Http\Controllers\DeletedFilesController::class, 'restoreFile']);
Route::delete('/files/delete_definitely', [App\Http\Controllers\DeletedFilesController::class, 'deleteAll'])->name('myFilesDeleteDefinitely');
Route::get('/files/search_deleted', [App\Http\Controllers\DeletedFilesController::class, 'search']);

/*
|--------------------------------------------------------------------------
| ProfileController
|--------------------------------------------------------------------------
*/

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'getUserProfile']);
Route::put('/profile/update/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('user.update');
Route::delete('/profile/delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('user.delete');
Route::post('/profile/upload', [App\Http\Controllers\ProfileController::class, 'upload'])->name('user.upload');


/*
|--------------------------------------------------------------------------
| RecentlyAddedFilesController
|--------------------------------------------------------------------------
*/
Route::get('/files/search/recently_added', [App\Http\Controllers\RecentlyAddedFilesController::class, 'search']);

require __DIR__ . '/auth.php';

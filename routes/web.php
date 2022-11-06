<?php

use App\Http\Controllers\CategoryController;
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
    return view('admin.layout.master');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/view-category',[CategoryController::class,'viewCategory'])->name('admin.viewCategory');
Route::get('/get-category',[CategoryController::class,'getcategory'])->name('admin.getcategory');
Route::post('/add-category',[CategoryController::class,'addNewCategory'])->name('admin.addNewCategory');
Route::get('/edit-category/{id}',[CategoryController::class,'editCategory'])->name('admin.editCategory');
Route::get('/delete-category',[CategoryController::class,'deleteCategory'])->name('admin.deleteCategory');
Route::post('/update-category',[CategoryController::class,'updateCategory'])->name('admin.updateCategory');

require __DIR__.'/auth.php';

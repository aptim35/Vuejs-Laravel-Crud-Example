<?php
use App\Http\Controllers\IndexController;
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

//Route::get('/', function () {return view('welcome');});
Route::get('/',[IndexController::class,'getIndex'])->name('index');
Route::get('/data',[IndexController::class,'getData'])->name('data');
Route::post('/book',[IndexController::class,'postBook'])->name('post_book');
Route::delete('/book/delete/{id}',[IndexController::class,'bookDelete'])->name('book_delete');
Route::get('/book/edit/{id}',[IndexController::class,'getBookEdit'])->name('get_book_edit');
Route::post('/book/edit',[IndexController::class,'postBookEdit'])->name('post_book_edit');

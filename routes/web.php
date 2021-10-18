<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
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
})->name('home');


//Pages


//Pages
Route::get("/pages", [PageController::class, "pageList"])->name("page.list");
Route::get('/page/create', [PageController::class, 'create'])->name('page.create')->middleware('auth');
Route::post('/page/create',[PageController::class, 'store'])->name('page.store')->middleware('auth');
Route::get("/page/{page}/edit", [PageController::class, "edit"])->name("page.edit")->middleware('auth');
Route::post("/page/{page}", [PageController::class, "update"])->name("page.update")->middleware('auth');
Route::get("/page/{page}/delete", [PageController::class, "delete"])->name("page.delete")->middleware('auth');

//Categories
Route::get("/categories", [CategoryController::class, "categoryList"])->name("category.list")->middleware('auth');
Route::get("/category/create", [CategoryController::class, "create"])->name("category.create")->middleware('auth');
Route::post("/category/create", [CategoryController::class, "store"])->name("category.store")->middleware('auth');
Route::post("/header", [CategoryController::class, "store"])->name("category.store");
Route::get("/category/{category}/edit", [CategoryController::class, "edit"])->name("category.edit")->middleware('auth');
Route::post("/category/{category}", [CategoryController::class, "update"])->name("category.update")->middleware('auth');
Route::get("/category/{category}/delete", [CategoryController::class, "delete"])->name("category.delete")->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//THESE SHOULD ALWAYS BUT THEN REALLY ALWAYS BE AT THE END OF THIS FILE IF NOT EVERYTHING BREAKS BECAUSE LARAVEL STUPIIDDDDD


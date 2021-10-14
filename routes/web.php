<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
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
Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
Route::post('/page/create',[PageController::class, 'store'])->name('page.store');
Route::get("/page/{page}/edit", [PageController::class, "edit"])->name("page.edit");
Route::post("/page/{page}", [PageController::class, "update"])->name("page.update");
Route::get("/page/{page}/delete", [PageController::class, "delete"])->name("page.delete");

//Categories
Route::get("/categories", [CategoryController::class, "categoryList"])->name("category.list");
Route::get("/category/create", [CategoryController::class, "create"])->name("category.create");
Route::post("/category/create", [CategoryController::class, "store"])->name("category.store");
Route::get("/category/{category}/edit", [CategoryController::class, "edit"])->name("category.edit");
Route::post("/category/{category}", [CategoryController::class, "update"])->name("category.update");
Route::get("/category/{category}/delete", [CategoryController::class, "delete"])->name("category.delete");

//THESE SHOULD ALWAYS BUT THEN REALLY ALWAYS BE AT THE END OF THIS FILE IF NOT EVERYTHING BREAKS BECAUSE LARAVEL STUPIIDDDDD
Route::get("/{category}/{page}", [PageController::class, "get"])->name("page");
Route::get("/{category}", [\App\Http\Controllers\CategoryController::class, "get"])->name("category");

<?php

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


Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
Route::post('/page/create',[PageController::class,'store'])->name('page.store');


//THESE SHOULD ALWAYS BUT THEN REALLY ALWAYS BE AT THE END OF THIS FILE IF NOT EVERYTHING BREAKS BECAUSE LARAVEL STUPIIDDDDD
Route::get("/{category}/{page}", [PageController::class, "get"])->name("page");
Route::get("/{category}", [\App\Http\Controllers\CategoryController::class, "get"])->name("category");

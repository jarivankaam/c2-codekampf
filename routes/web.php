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
});

Route::get("/{category}/{page}", [PageController::class, "get"])->name("page");
Route::get('create', function () {
    return view('page/create');
});

Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
Route::post('/page/',[PageController::class,'store'])->name('page.store');


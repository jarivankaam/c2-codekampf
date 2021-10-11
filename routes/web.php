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
Route::get("/{category}/{page}", [PageController::class, "get"])->name("page");


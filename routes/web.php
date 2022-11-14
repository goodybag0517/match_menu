<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NiceController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('post.newmenu',[PostController::class,'newmenu'])->name('post.newmenu');
Route::get('post.mymenu',[PostController::class,'mymenu'])->name('post.mymenu');

Route::get('post.nicemenu',[PostController::class,'nicemenu'])->name('post.nicemenu');
Route::get('post.mynicemenu',[PostController::class,'mynicemenu'])->name('post.mynicemenu');
Route::resource('post',PostController::class);

Route::resource('menu',MenuController::class);

// いいねボタン
Route::get('/reply/nice/{post}', [NiceController::class,'nice'])->name('nice');
Route::get('/reply/unnice/{post}', [NiceController::class,'unnice'])->name('unnice');


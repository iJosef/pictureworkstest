<?php

use App\Http\Controllers\UserController;
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

Route::get('/user/add-comment', [UserController::class, 'addComment']);

Route::post('user/comment/form', [UserController::class, 'userCommentForm'])->name('append_user_comment');

Route::get('/user/{id}', [UserController::class, 'index'])->name('show_user');



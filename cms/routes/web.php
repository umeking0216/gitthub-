<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController; //追加
use App\Models\Book; //追加
use App\Http\Controllers\TeamController; //追加

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

//本：ダッシュボード表示(books.blade.php)
Route::get('/', [BookController::class,'index'])->middleware(['auth'])->name('book_index');
Route::get('/dashboard', [BookController::class,'index'])->middleware(['auth'])->name('dashboard');

//本：追加 
Route::post('/books',[BookController::class,"store"])->name('book_store');

//本：削除 
Route::delete('/book/{book}', [BookController::class,"destroy"])->name('book_destroy');

//本：更新画面
Route::post('/booksedit/{book}',[BookController::class,"edit"])->name('book_edit'); //通常
Route::get('/booksedit/{book}', [BookController::class,"edit"])->name('edit');      //Validationエラーありの場合

//本：更新画面
Route::post('/books/update',[BookController::class,"update"])->name('book_update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//上部でこれをuseしておく


//チーム：ダッシュボード
Route::get('/teams', [TeamController::class, 'index'])->name('team_index');

//チーム：追加
Route::post('teams', [TeamController::class, 'store'])->name('team_store');

//チーム：更新画面
Route::get('/teamssedit/{team}',[TeamController::class,"edit"])->name('team_edit'); 

//チーム更新処理
Route::post('teams/update',  [TeamController::class, 'update'])->name('team_update');

//チーム：参加
Route::get('/team/{team_id}', [TeamController::class, 'join'])->name('team_join');


require __DIR__.'/auth.php';

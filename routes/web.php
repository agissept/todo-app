<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('board.show');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/boards', [BoardController::class, 'show'])->name('board.show');
    Route::post('/boards', [BoardController::class, 'store'])->name('board.store');
    Route::put('/boards/{id}', [BoardController::class, 'edit'])->name('board.edit');
    Route::delete('/boards/{id}', [BoardController::class, 'delete'])->name('board.delete');

    Route::get('/boards/{boardId}/todos', [TodoController::class, 'show'])->name('todo.show');
    Route::post('/boards/{boardId}/todos', [TodoController::class, 'store'])->name('todo.store');
    Route::put('/boards/{boardId}/todos/{id}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::delete('/boards/{boardId}/todos/{id}', [TodoController::class, 'delete'])->name('todo.delete');
    Route::post('/boards/{boardId}/todos/{id}/complete', [TodoController::class, 'complete'])->name('todo.complete');
    Route::delete('/boards/{boardId}/todos/{id}/uncompleted', [TodoController::class, 'uncompleted'])->name('todo.uncompleted');
});


require __DIR__.'/auth.php';

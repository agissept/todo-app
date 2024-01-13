<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CollaboratorController;
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
Route::get('/', static fn ()=> view('landing-page.index'));

Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', static fn() => redirect()->route('board.show'))->name('dashboard');

    Route::get('/boards', [BoardController::class, 'show'])->name('board.show');
    Route::post('/boards', [BoardController::class, 'store'])->name('board.store');
    Route::put('/boards/{id}', [BoardController::class, 'edit'])->name('board.edit');
    Route::delete('/boards/{id}', [BoardController::class, 'delete'])->name('board.delete');

    Route::get('/boards/{boardId}/', static fn() => redirect()->route('todo.show'));
    Route::get('/boards/{boardId}/todos', [TodoController::class, 'show'])->name('todo.show');
    Route::post('/boards/{boardId}/todos', [TodoController::class, 'store'])->name('todo.store');
    Route::put('/boards/{boardId}/todos/{id}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::delete('/boards/{boardId}/todos/{id}', [TodoController::class, 'delete'])->name('todo.delete');
    Route::post('/boards/{boardId}/todos/{id}/complete', [TodoController::class, 'complete'])->name('todo.complete');
    Route::delete('/boards/{boardId}/todos/{id}/uncompleted',
        [TodoController::class, 'uncompleted'])->name('todo.uncompleted');

    Route::post('/boards/{boardId}/collaborators',
        [CollaboratorController::class, 'store'])->name('collaborator.store');
});


require __DIR__ . '/auth.php';

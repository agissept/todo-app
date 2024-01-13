<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRole;
use App\Models\Board;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class TodoController extends Controller
{
    public function show(int $boardId): View
    {
        $todos = Todo::query()
            ->join('users', 'users.id', '=', 'todos.owner')
            ->select(
                [
                    'todos.id',
                    'users.name as username',
                    'todos.name',
                    'deadline',
                    'description',
                    'status'
                ]
            )->where('board_id', $boardId);

        $board = Board::find($boardId);
        if (!UserRole::isAdmin()) {
            $todos->where('owner', auth()->id());
        }

        return view('todos.index', [
            'todos' => $todos->get(),
            'board' => $board
        ]);
    }

    public function store(int $boardId, Request $request): RedirectResponse
    {
        Todo::create([
            'name' => $request->todo_name,
            'description' => $request->todo_description,
            'deadline' => $request->todo_deadline,
            'owner' => auth()->id(),
            'board_id' => $boardId
        ]);

        return redirect()->route('todo.show', ['boardId' => $boardId]);
    }

    public function edit(int $boardId, int $id, Request $request): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->name = $request->todo_name;
        $todo->description = $request->todo_description;
        $todo->deadline = $request->todo_deadline;
        $todo->save();
        return redirect()->route('todo.show', ['boardId' => $boardId]);
    }

    public function delete(int $boardId, $id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todo.show', ['boardId' => $boardId]);
    }

    public function complete(int $boardId, int $id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->status = true;
        $todo->save();
        return redirect()->route('todo.show', ['boardId' => $boardId]);
    }

    public function uncompleted(int $boardId, int $id): RedirectResponse
    {
        $todo = Todo::find($id);
        $todo->status = false;
        $todo->save();
        return redirect()->route('todo.show', ['boardId' => $boardId]);
    }
}

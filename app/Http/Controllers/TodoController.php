<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRole;
use App\Models\Board;
use App\Models\Todo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{

    public function __construct(
        private readonly Request $request
    ) {
    }

    /**
     * @throws AuthorizationException
     */
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

        $this->authorizeBoard();

        return view('todos.index', [
            'todos' => $todos->get(),
            'board' => $this->getBoard()
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

    private function authorizeBoard(): void
    {
        $board = $this->getBoard();
        $collaborators = explode(',', $board->collaborators);

        if (UserRole::isAdmin()) {
            return;
        }

        if ($board->owner !== auth()->id() && !in_array(auth()->id(), $collaborators, false)) {
            throw new AuthorizationException('Anda tidak berhak mengakses board ini');
        }
    }

    private function getBoard(): Model|Collection|Builder|array|null
    {
        $boardId = $this->request->segment(2);

        return Board::query()
            ->leftJoin('collaborators', 'collaborators.board_id', '=', 'boards.id')
            ->groupBy('boards.id')
            ->select([
                'boards.*',
                DB::raw('GROUP_CONCAT(collaborators.user_id) as collaborators')
            ])->find($boardId);
    }
}

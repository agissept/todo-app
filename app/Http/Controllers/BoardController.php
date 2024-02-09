<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRole;
use App\Models\Board;
use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function show()
    {
        $boards = Board::query()
            ->join('users', 'users.id', '=', 'owner')
            ->leftJoin('collaborators', 'collaborators.board_id', '=', 'boards.id');


        if (!UserRole::isAdmin()) {
            $boards->orWhere(function (Builder $query) {
                $query->where('owner', '=', auth()->id())
                    ->orWhere('collaborators.user_id', '=', auth()->id());
            });
        }

        $boards = $boards->groupBy('boards.id', 'users.name')
            ->select([
                'boards.id',
                'users.name as username',
                'boards.name',
                'boards.description',
            ])->get();


        foreach ($boards as $board){
            $board->collaborators = Collaborator::query()
                ->join('users', 'users.id', '=', 'user_id')
                ->where('board_id', $board->id, 'id')
                ->get([
                    'user_id as id',
                    'users.name as name'
                ]);
        }

        return view('boards.index', [
            'boards' => $boards
        ]);
    }

    public function store(Request $request)
    {
        Board::create([
            'name' => $request->board_name,
            'description' => $request->board_description,
            'owner' => auth()->id(),
        ]);

        return redirect()->route('board.show');
    }

    public function edit(int $id, Request $request)
    {
        $board = Board::find($id);
        $board->name = $request->board_name;
        $board->description = $request->board_description;
        $board->save();
        return redirect()->route('board.show');
    }

    public function delete($id): RedirectResponse
    {
        $board = Board::find($id);
        $board->delete();
        return redirect()->route('board.show');
    }

}

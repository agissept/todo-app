<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRole;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function show()
    {
        $boards = Board::query()->join('users', 'users.id', '=', 'owner');
        if (!UserRole::isAdmin()){
            $boards->where('owner', auth()->id());
        }
        $boards = $boards->get([
            'boards.id',
            'users.name as username',
            'boards.name',
            'boards.description',
        ]);
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

    public function edit()
    {
        return view('boards.index');
    }


}

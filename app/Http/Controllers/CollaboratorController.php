<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    public function store(int $boardId, Request $request): RedirectResponse
    {
        Collaborator::create([
            'user_id' => $request->user_id,
            'board_id' => $boardId,
        ]);

        return redirect()->route('board.show', ['id' => $boardId]);
    }
}

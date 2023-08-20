<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Board;
use App\Models\Column;

class BoardController extends Controller
{
    public function show($id) {
        $board = Board::find($id);
        $columns = Column::where('board_id', $id)->get();
        foreach ($columns as &$column)
            $column->cards = $column->cards;
        return Inertia::render('Board', [
            'board' => $board,
            'columns' => $columns
        ]);
    }
}

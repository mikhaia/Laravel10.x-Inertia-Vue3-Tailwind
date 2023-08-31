<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Board;
use App\Models\Column;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    public function create() {
        return Inertia::render('Board');
    }

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

    public function store(Request $request) {

        // TODO: Add validation
        /*
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'icon',
            'background',
            'public' => 'boolean',
            'dark' => 'boolean'
        ]);

        if ($validator->fails()) {
            dd($validator);
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
                    }
        */
        // $data = $request->validate([
        //     'title' => 'required',
        //     'icon',
        //     'background',
        //     'public' => 'boolean',
        //     'dark' => 'boolean'
        // ]);
        $data = $request->input();
        $data['user_id'] = auth()->id();
        $board = Board::create($data);
        return redirect()->route('boards.show', [$board->id])->with('success', 'Welcome to your new board!');
    }

    public function update(Request $request, $id) {
        $data = $request->input();
        unset($data['_method']);
        $board = Board::where('id', $id)->where('user_id', auth()->id())->update($data);
        return redirect()->route('boards.show', $id)->with('success', 'Your board has been updated!');
    }
}

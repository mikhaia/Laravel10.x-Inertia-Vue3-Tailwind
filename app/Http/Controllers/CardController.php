<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Column;
use App\Models\Card;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'cover' => 'image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = $request->input();
        $data['position'] = intval($data['position']);
        $data['progress'] = intval($data['progress']);
        // Cover
        $data['cover'] = $this->changeImage('cover', 286, 161, $request, null, true);
        
        $card = Card::create($data);
        return redirect()->back()->with('success', 'Card saved successfully!');
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'cover' => 'image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = $request->input();
        $data['position'] = intval($data['position']);
        $data['progress'] = intval($data['progress']);
        unset($data['_method']);
        unset($data['cover']);

        $model = Card::find($id);
        // Cover
        $this->changeImage('cover', 286, 161, $request, $model, true);

        $card = Card::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Card saved successfully!');
    }

    public function todo(Request $request, $cardId) {
        $data = ['todo' => $request->input('todo')];
        Card::find($cardId)->update($data);
        return ['success' => 'Todo saved successfully!'];
    }
}

<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{
    public function show($userId)
    {
      $user = User::find(1);
      return Inertia::render('Show', [
          'user' => $user
      ]);
    }
}
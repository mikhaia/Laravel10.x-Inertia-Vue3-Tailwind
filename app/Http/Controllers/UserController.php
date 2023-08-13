<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show($user)
    {
      return Inertia::render('Show', [
          'user' => $user
      ]);
    }
}
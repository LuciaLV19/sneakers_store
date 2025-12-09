<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \app\Models\User::all();
        return view('users.index', compact('users'));
    }
}

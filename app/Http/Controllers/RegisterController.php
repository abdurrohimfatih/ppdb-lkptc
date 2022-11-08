<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('register')->with('error', 0);
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 1; // 1 =user
        $user->remember_token = Str::random(60);
        $user->save();
        if ($user) {
            return redirect(route('register'))->with('error', '');
        }
    }
}

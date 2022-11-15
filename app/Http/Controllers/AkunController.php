<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        if (Auth::user()->level >= 2) {
            $user = User::where('level', 1)->where('email', '!=', 'user@gmail.com')->get();
            return view('akun', compact('user'));
        }
    }

    public function processReset(Request $request)
    {
        try {
            $request->validate([
                'user' => 'required',
                'password' => 'required|min:6'
            ]);

            $akun = User::find($request->user);
            $akun->password = Hash::make($request->password);
            $akun->save();

            return redirect(route('akun'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('akun'))->with('error', 1);
        }
    }
}

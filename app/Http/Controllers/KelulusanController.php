<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelulusanController extends Controller
{
    public function index()
    {
        if (Auth::user()->level >= 2) {
            $user = User::where('level', 1)->with(['biodata'])->where('email', '!=', 'user@gmail.com')->get();
            return view('kelulusan', compact('user'));
        } else {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $kelulusan = Kelulusan::where('user_id', $user_id)->first();
            return view('kelulusan', compact(['user', 'kelulusan']));
        }
    }

    public function processKelulusan(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'status' => 'required'
        ]);

        try {
            $user_id = $request->user;
            $status = $request->status;
            $kelulusan = Kelulusan::where('user_id', $user_id)->first();

            if ($kelulusan == null) {
                $kelulusan = new Kelulusan;
            }

            $kelulusan->user_id = $user_id;
            $kelulusan->status = $status;
            $kelulusan->save();

            return redirect(route('kelulusan'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('kelulusan'))->with('error', 1);
        }
    }
}

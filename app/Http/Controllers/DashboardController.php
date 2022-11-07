<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->level >= 2) {
            $user = User::where('level', 1)->with(['biodata', 'jurusan', 'postNilai'])->get();
            return view('dashboard', compact('user'));
        } else {
            $jadwal = Jadwal::where('user_id', Auth::user()->id)->with(['biodata'])->get();
            return view('dashboard', compact('jadwal'));
        }
    }
}

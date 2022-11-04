<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $user = User::where('level', 1)->with(['biodata', 'jurusan', 'postNilai'])->get();
        return view('dashboard', compact('user'));
    }
}

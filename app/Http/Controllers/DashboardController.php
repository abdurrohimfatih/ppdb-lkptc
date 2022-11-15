<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Kelulusan;
use App\Models\PostJurusan;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->level >= 2) {
            $user = User::where('level', 1)->where('email', '!=', 'user@gmail.com')->get();
            $jurusan = Jurusan::all();
            $jurusan11 = PostJurusan::where('jurusan_id', 1)->where('kat', 1)->count();
            $jurusan12 = PostJurusan::where('jurusan_id', 1)->where('kat', 2)->count();
            $jurusan21 = PostJurusan::where('jurusan_id', 2)->where('kat', 1)->count();
            $jurusan22 = PostJurusan::where('jurusan_id', 2)->where('kat', 2)->count();
            $jurusan31 = PostJurusan::where('jurusan_id', 3)->where('kat', 1)->count();
            $jurusan32 = PostJurusan::where('jurusan_id', 3)->where('kat', 2)->count();
            $kelulusan0 = Kelulusan::where('status', 0)->count();
            $kelulusan1 = Kelulusan::where('status', 1)->count();
            $jkL = Biodata::where('jenis_kelamin', 'L')->count();
            $jkP = Biodata::where('jenis_kelamin', 'P')->count();

            return view('dashboard', compact(['user', 'jurusan', 'jurusan11', 'jurusan12', 'jurusan21', 'jurusan22', 'jurusan31', 'jurusan32', 'kelulusan0', 'kelulusan1', 'jkL', 'jkP']));
        } else {
            $jadwal = Jadwal::where('user_id', Auth::user()->id)->get();
            return view('dashboard', compact('jadwal'));
        }
    }

    public function processJadwal(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required',
            'waktu' => 'required',
            'ruangan' => 'required'
        ]);

        try {
            $user_id = $request->user_id;
            $password = $request->password;
            $waktu = $request->waktu;
            $ruangan = $request->ruangan;

            $jadwal = Jadwal::where('user_id', $user_id)->first();

            if ($jadwal == null) {
                $jadwal = new Jadwal;
            }

            $jadwal->user_id = $user_id;
            $jadwal->password = $password;
            $jadwal->waktu = $waktu;
            $jadwal->ruangan = $ruangan;
            $jadwal->save();

            return redirect(route('dashboard'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('dashboard'))->with('error', 1);
        }
    }
}

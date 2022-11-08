<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->level >= 2) {
            $user = User::where('level', 1)->get();
            return view('dashboard', compact('user'));
        } else {
            $jadwal = Jadwal::where('user_id', Auth::user()->id)->get();
            return view('dashboard', compact('jadwal'));
        }
    }

    public function storeGenerate(Request $request)
    {
        try {
            $user_id = $request->id;
            $jenis_kelamin = $request->jenis_kelamin;
            $password = $this->generate(8);
            $waktu = '2022-11-10 08:00:00';

            $jadwal = Jadwal::where('user_id', $user_id)->first();

            if ($jadwal == null) {
                $jadwal = new Jadwal;
                $jadwal->user_id = $request->id;
                $jadwal->password = $password;
                $jadwal->waktu = $waktu;
                switch ($jenis_kelamin) {
                    case "L":
                        $ruangan = 'Labkom A';
                        break;
                    case "P":
                        $ruangan = 'Labkom B';
                }
                $jadwal->ruangan = $ruangan;
                $jadwal->save();

                return redirect(route('dashboard'))->with('error', '');
            } else {
                return redirect(route('dashboard'))->with('error', 2);
            }
        } catch (QueryException $e) {
            return redirect(route('dashboard'))->with('error', 1);
        }
    }

    function generate($n)
    {
        $char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($char) - 1);
            $random .= $char[$index];
        }

        return $random;
    }
}

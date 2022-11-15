<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::all();
        if (Auth::user()->level == 1) {
            $prestasi = Prestasi::where('user_id', Auth::user()->id)->get();
            return view('prestasi', compact('prestasi'));
        } else {
            $user = User::where('level', 1)->with(['biodata'])->where('email', '!=', 'user@gmail.com')->get();
            return view('prestasi', compact('user'));
        }
    }

    public function storePrestasi(Request $request)
    {
        $data = [];
        $error = 1;
        foreach ($request->prestasi as $index => $p) {
            if (!empty($p) && $request->get('tingkat')[$index] != '') {
                $noId = 0;
                if (!empty($request->get('id')[$index]) && !$request->get('id')[$index] == 0) {
                    $noId = $request->get('id')[$index];
                }
                $data[] = [
                    'id' => $noId,
                    'user_id' => Auth::user()->id,
                    'prestasi' => $p,
                    'tingkat' => $request->get('tingkat')[$index],
                ];
            } else {
                $error = 2;
            }
        }
        // if ($request->prestasi != null) {
        //     dd($request->prestasi);
        // }
        // for ($x = 0; $x < count($request->get('prestasi')); $x++) {
        //     $noId = 0;
        //     if (!empty($request->get('id')[$x]) && !$request->get('id')[$x] == 0) {
        //         $noId = $request->get('id')[$x];
        //     }
        //     $data[] = [
        //         'id' => $noId,
        //         'user_id' => Auth::user()->id,
        //         'prestasi' => $request->get('prestasi')[$x],
        //         'tingkat' => $request->get('tingkat')[$x],
        //     ];
        // }

        if (count($data) > 0) {
            $error = '';
        }
        Prestasi::upsert($data, ['id', 'user_id', 'prestasi', 'tingkat']);
        return redirect(route('prestasi'))->with('error', $error);
    }
}

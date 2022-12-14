<?php

namespace App\Http\Controllers;


use App\Models\DataKeluarga;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKeluargaController extends Controller
{
    public function index()
    {
        $datakeluarga = DataKeluarga::all();

        if (Auth::user()->level == 1) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $datakeluarga = DataKeluarga::where('user_id', $user_id)->first();
            return view('datakeluarga', compact(['user', 'datakeluarga']))->with('error', 0);
        } else {
            $user = User::where('level', 1)->where('email', '!=', 'user@gmail.com')->get();
            return view('datakeluarga', compact('user'));
        }
    }


    public function processDataKeluarga(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required'
        ]);

        try {

            if ($request->id > 0) {
                // update data
                // $method = 'update';
                $datakeluarga = DataKeluarga::find($request->id);
            } else {
                // insert data
                // $method = 'insert';
                $datakeluarga = new DataKeluarga;
            }

            $datakeluarga->user_id = $request->user_id;
            $datakeluarga->nama_ayah = ucwords($request->nama_ayah);
            $datakeluarga->pekerjaan_ayah = ucwords($request->pekerjaan_ayah);
            $datakeluarga->usia_ayah = $request->usia_ayah;
            $datakeluarga->alamat_ayah = ucwords($request->alamat_ayah);
            $datakeluarga->no_telp_ayah = $request->no_telp_ayah;
            $datakeluarga->nama_ibu = ucwords($request->nama_ibu);
            $datakeluarga->pekerjaan_ibu = ucwords($request->pekerjaan_ibu);
            $datakeluarga->usia_ibu = $request->usia_ibu;
            $datakeluarga->alamat_ibu = ucwords($request->alamat_ibu);
            $datakeluarga->no_telp_ibu = $request->no_telp_ibu;

            $datakeluarga->save();

            return redirect(route('datakeluarga'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('datakeluarga'))->with('error', 1);
        }
    }
}

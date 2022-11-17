<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        if (Auth::user()->level == 1) {
            $user_id = Auth::user()->id;
            $user = User::where('id', $user_id)->first();
            $biodata = Biodata::where('user_id', $user_id)->first();
            return view('biodata', compact(['user', 'biodata']))->with('error', 0);
        } else {
            $user = User::where('level', 1)->where('email', '!=', 'user@gmail.com')->get();
            return view('biodata', compact('user'));
        }
    }

    public function processBiodata(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'no_telp' => 'required'
        ]);

        try {
            if ($request->id > 0) {
                // update data
                $method = 'update';
                $biodata = Biodata::find($request->id);
                $imgname = $biodata->img_user;
            } else {
                // insert data
                $method = 'insert';
                $biodata = new Biodata;
                $imgname = "";
            }

            // upload img
            if ($request->hasFile('img_user')) {
                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png,jpg'
                ]);

                if ($method == 'update') {
                    if ($imgname == "") {
                        $imgname = $request->img_user->hashName();
                    }
                } else {
                    $imgname = $request->img_user->hashName();
                }

                // $request->img_user->storeAs('upload/img', $imgname, 'public');
            }

            $biodata->user_id = $request->user_id;
            $biodata->nama_lengkap = ucwords($request->nama_lengkap);
            $biodata->no_telp = $request->no_telp;
            $biodata->tempat_lahir = ucwords($request->tempat_lahir);
            $biodata->tgl_lahir = $request->tgl_lahir;
            $biodata->jenis_kelamin = $request->jenis_kelamin;
            $biodata->status_perkawinan = $request->status_perkawinan;
            $biodata->agama = ucwords($request->agama);
            $biodata->anak_ke = $request->anak_ke;
            $biodata->jumlah_saudara = $request->jumlah_saudara;
            $biodata->alamat_lengkap = ucwords($request->alamat_lengkap);
            $biodata->img_user = $imgname;

            $biodata->jalur_tes = 1;
            $biodata->konfirmasi = 0;
            $biodata->status = 1;
            $biodata->save();

            if ($request->hasFile('img_user')) {
                $request->img_user->storeAs('upload/img', $imgname, 'public');
            }

            return redirect(route('biodata'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('biodata'))->with('error', 1);
        }
    }
}

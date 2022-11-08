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
            $biodata = Biodata::where('user_id', $user_id)->first();
            return view('biodata', ['biodata' => $biodata])->with('error', 0);
        } else {
            $user = User::where('level', 1)->get();
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
            } else {
                // insert data
                $method = 'insert';
                $biodata = new Biodata;
            }

            // upload img
            $imgname = "";
            if ($request->hasFile('img_user')) {
                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png,jpg'
                ]);

                $request->img_user->store('upload/img', 'public');
                $imgname = $request->img_user->hashName();
            }

            $biodata->user_id = $request->user_id;
            $biodata->nama_lengkap = $request->nama_lengkap;
            $biodata->no_telp = $request->no_telp;
            $biodata->tempat_lahir = $request->tempat_lahir;
            $biodata->tgl_lahir = $request->tgl_lahir;
            $biodata->jenis_kelamin = $request->jenis_kelamin;
            $biodata->status_perkawinan = $request->status_perkawinan;
            $biodata->agama = $request->agama;
            $biodata->anak_ke = $request->anak_ke;
            $biodata->jumlah_saudara = $request->jumlah_saudara;
            $biodata->alamat_lengkap = $request->alamat_lengkap;
            if ($method == 'update') {
                if (!empty($imgname)) {
                    $biodata->img_user = $imgname;
                }
            } else {
                $biodata->img_user = $imgname;
            }

            $biodata->jalur_tes = 1;
            $biodata->konfirmasi = 0;
            $biodata->status = 1;
            $biodata->save();

            return redirect(route('biodata'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('biodata'))->with('error', 1);
        }
    }
}

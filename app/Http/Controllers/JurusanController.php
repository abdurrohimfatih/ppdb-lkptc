<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\PostJurusan;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::all();
        $postJurusan = '';

        if (Auth::user()->level == 1) {
            $postJurusan = PostJurusan::where('user_id', Auth::user()->id)->get();
            return view('jurusan', compact('jurusan', 'postJurusan'));
        } else {
            $user = User::where('level', 1)->where('email', '!=', 'user@gmail.com')->get();
            return view('jurusan', compact('user'));
        }
    }

    // public function processJurusan(Request $request)
    // {
    //     $request->validate([
    //         'jurusan_name' => 'required'
    //     ]);

    //     try {

    //         if ($request->id > 0) {
    //             $jurusan = Jurusan::find($request->id);
    //         } else {
    //             $jurusan = new Jurusan;
    //         }

    //         $jurusan->jurusan_name = $request->jurusan_name;
    //         $jurusan->jurusan_prodi = $request->jurusan_prodi;
    //         $jurusan->jurusan_bidstudi = $request->jurusan_bidstudi;

    //         $jurusan->save();

    //         return redirect(route('jurusan'))->with('error', '');

    //     } catch (QueryException $e) {
    //         return redirect(route('jurusan'))->with('error', 1);
    //     }
    // }

    public function storePostJurusan(Request $request)
    {
        if (!empty($request->get('id')[0])) {
            $id1 = $request->get('id')[0];
        } else {
            $id1 = null;
        }

        if (!empty($request->get('id')[1])) {
            $id2 = $request->get('id')[1];
        } else {
            $id2 = null;
        }

        try {
            $data = [
                [
                    'id' => $id1,
                    'user_id' => $request->user_id,
                    'jurusan_id' => $request->jurusan1,
                    'kat' => 1
                ],
                [
                    'id' => $id2,
                    'user_id' => $request->user_id,
                    'jurusan_id' => $request->jurusan2,
                    'kat' => 2
                ]
            ];

            PostJurusan::upsert($data, ['id', 'user_id', 'jurusan_id', 'kat']);
            return redirect(route('jurusan'))->with('error', '');
        } catch (QueryException $e) {
            return redirect(route('jurusan'))->with('error', 1);
        }

        // $postJurusan->user_id = $request->user_id;
        // $postJurusan->jurusan_id = $request->jurusan1;
        // $postJurusan->kat = 1;

        // $postJurusan->user_id = $request->user_id;
        // $postJurusan->jurusan_id = $request->jurusan2;
        // $postJurusan->kat = 2;

        // $data = [];
        // $error = 1;
        // if (count($request->jurusan) > 0) {
        //     $countid = 0;
        //     foreach ($request->jurusan as $index => $j) {
        //         if (!empty($j) && $j != 0) {
        //             $noId = 0;
        //             if (!empty($request->get('id')[$index])) {
        //                 $noId = $request->get('id')[$index];
        //             }
        //             $data[] = [
        //                 'id' => $noId,
        //                 'user_id' => Auth::user()->id,
        //                 'jurusan_id' => $j,
        //                 'kat' => ($countid + 1)
        //             ];

        //             $countid++;
        //         }
        //     }
        // }
        // if (count($data) > 0) {
        //     $error = '';
        // }
    }
}

@extends('templates.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-4">
                    <h2>Selamat datang, {{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
                </div>


                {{-- This menu only for user level 2 and 3--}}
                @if(\Illuminate\Support\Facades\Auth::user()->level >= 2)
                <p class="text-muted mb-3">Data Pendaftar</p>
                {{-- <a href="{{route('export')}}" class="btn btn-success">Excel</a> --}}
                <button id="export" class="btn btn-success">Excel</button>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>PILIHAN 1</th>
                                <th>PILIHAN 2</th>
                                <th>NILAI MATEMATIKA</th>
                                <th>NILAI B. INGGRIS</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($user as $u)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                @if ($u->jurusan->isNotEmpty())
                                    @foreach ($u->jurusan as $j)
                                        <td>{{$j->jurusan_name}}</td>
                                    @endforeach
                                @else
                                    <td><i class="link-danger">belum diisi</i></td>
                                    <td><i class="link-danger">belum diisi</i></td>
                                @endif



                                @if ($u->postNilai->isNotEmpty())
                                @foreach ($u->postNilai as $n)
                                @php
                                    $array = array(
                                        $n->score_s1,
                                        $n->score_s2,
                                        $n->score_s3,
                                        $n->score_s4,
                                        $n->score_s5,
                                        $n->score_un
                                    );
                                @endphp
                                <td>
                                    {{ $array = array_sum($array) / count($array) }}
                                    {{-- @if ($array >= 60)
                                        <i class="link-success" data-feather="check"></i>
                                    @else
                                        <i class="link-danger" data-feather="x"></i>
                                    @endif --}}
                                </td>
                                @endforeach
                                @else
                                    <td><i class="link-danger">belum diisi</i></td>
                                    <td><i class="link-danger">belum diisi</i></td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- This is menu only for user--}}
                @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                <div class="row">
                    <div class="col-md-12"><p>Pastikan semua form pada menu tersedia sudah terisi dengan benar</p></div>
                </div>

                <div class="mt-2 alert alert-success">
                    <i class="link-icon" data-feather="check-circle"></i> Informasi Jadwal Ujian Masuk Akan di
                    Informasikan melalui Halaman ini dan No WA yang di daftarkan
                </div>
                <div class="mt-2 alert alert-warning">
                    <i class="link-icon" data-feather="alert-triangle"></i> Username Test Anda :
                    {{\Illuminate\Support\Facades\Auth::user()->email}}
                </div>
                <div class="mt-2 alert alert-warning">
                    <i class="link-icon" data-feather="alert-triangle"></i> Password Test Anda : Akan informasikan
                    sebelum test berlangsung
                </div>

                <div class="row">

                    <div class="mt-2 alert alert-danger">
                        <i class="link-icon" data-feather="alert-circle"></i> Pastikan username dan password dicatat dan
                        dibawa pas seleksi berlangsung
                    </div>

                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

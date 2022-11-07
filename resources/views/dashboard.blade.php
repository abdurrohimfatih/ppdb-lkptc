@extends('templates.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-4">
                        <h2>Selamat datang, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h2>
                    </div>

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <p class="text-muted mb-3">Data Pendaftar</p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Data Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>EMAIL</th>
                                        <th>NO HP/WA</th>
                                        <th>ALAMAT</th>
                                        <th>PILIHAN 1</th>
                                        <th>PILIHAN 2</th>
                                        <th>NILAI MATEMATIKA</th>
                                        <th>NILAI B. INGGRIS</th>
                                        <th>TEMPAT LAHIR</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata->isNotEmpty())
                                                @foreach ($u->biodata as $b)
                                                    <td>{{ $b->nama_lengkap }}</td>
                                                    <td>{{ $b->jenis_kelamin }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif

                                            <td>{{ $u->email }}</td>

                                            @if ($u->biodata->isNotEmpty())
                                                @foreach ($u->biodata as $b)
                                                    <td>{{ $b->no_telp }}</td>
                                                    <td>{{ $b->alamat_lengkap }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif

                                            @if ($u->jurusan->isNotEmpty())
                                                @foreach ($u->jurusan as $j)
                                                    <td>{{ $j->jurusan_name }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif

                                            @if ($u->postNilai->isNotEmpty())
                                                @foreach ($u->postNilai as $n)
                                                    @php
                                                        $array = [$n->score_s1, $n->score_s2, $n->score_s3, $n->score_s4, $n->score_s5, $n->score_un];
                                                        $array = array_sum($array) / count($array);
                                                        $nilai = number_format($array, 2);
                                                    @endphp
                                                    <td>{{ $nilai }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif

                                            @if ($u->biodata->isNotEmpty())
                                                @foreach ($u->biodata as $b)
                                                    <td>{{ $b->tempat_lahir }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{-- This is menu only for user --}}
                    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <p>Pastikan semua form pada menu tersedia sudah terisi dengan benar</p>
                            </div>
                        </div>

                        <div class="mt-2 alert alert-success">
                            <i class="link-icon" data-feather="check-circle"></i> Informasi Jadwal Ujian Masuk Akan di
                            Informasikan melalui Halaman ini dan No WA yang di daftarkan
                        </div>
                        <div class="mt-2 alert alert-warning">
                            <i class="link-icon" data-feather="alert-triangle"></i> Username Test Anda :
                            {{ \Illuminate\Support\Facades\Auth::user()->email }}
                        </div>
                        <div class="mt-2 alert alert-warning">
                            <i class="link-icon" data-feather="alert-triangle"></i> Password Test Anda : Akan informasikan
                            sebelum test berlangsung
                        </div>

                        <div>
                            <div class="mt-2 alert alert-danger">
                                <i class="link-icon" data-feather="alert-circle"></i> Pastikan username password dan dicatat
                                dan dibawa ketika test berlangsung
                            </div>
                        </div>

                        {{-- <div class="card col-5">
                            <div class="card-body">
                                <h3 class="text-center">Kartu Login Ujian</h3><br>
                                <table class="table-borderless">
                                    <tr>
                                        <td width="100">Username</td>
                                        <td>: <span class="badge badge-dark">skdhsa</span></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>: </td>
                                    </tr>
                                    <tr>
                                        <td>Waktu</td>
                                        <td>: </td>
                                    </tr>
                                </table>
                            </div>
                        </div> --}}
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@extends('templates.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row mb-4">
                        <h3>Selamat datang, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h3>
                    </div>

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        @if (session('error') === '')
                            <div class="mt-2 alert alert-success">
                                <i class="link-icon" data-feather="check-circle"></i> Berhasil generate kartu!
                            </div>
                        @elseif(session('error') == 1)
                            <div class="mt-2 alert alert-danger">
                                <i class="link-icon" data-feather="alert-circle"></i> Gagal saat mencoba generate kartu,
                                silahkan coba kembali!
                            </div>
                        @elseif(session('error') == 2)
                            <div class="mt-2 alert alert-warning">
                                <i class="link-icon" data-feather="alert-triangle"></i> User ini sudah di-generate
                                kartunya!
                            </div>
                        @endif
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
                                    <th>AKSI</th>
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
                                                <td>
                                                    <a href="{{ route('storeGenerate', [$u->id, $b->jenis_kelamin]) }}"
                                                       class="btn btn-success">Generate
                                                        Kartu</a>
                                                </td>
                                            @endforeach
                                        @else
                                            <td><i class="link-danger">belum diisi</i></td>
                                            <td><i class="link-danger">lengkapi data!</i></td>
                                        @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{-- This is menu only for user --}}
                    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-md-12">--}}
                        {{--                                <p>Pastikan semua form pada menu tersedia sudah terisi dengan benar</p>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="mt-2 alert alert-success">--}}
                        {{--                            <i class="link-icon" data-feather="check-circle"></i> Informasi Jadwal Ujian Masuk Akan di--}}
                        {{--                            Informasikan melalui Halaman ini dan No WA yang di daftarkan--}}
                        {{--                        </div>--}}
                        {{--                        <div class="mt-2 alert alert-warning">--}}
                        {{--                            <i class="link-icon" data-feather="alert-triangle"></i> Username Test Anda :--}}
                        {{--                            {{ \Illuminate\Support\Facades\Auth::user()->email }}--}}
                        {{--                        </div>--}}
                        {{--                        <div class="mt-2 alert alert-warning">--}}
                        {{--                            <i class="link-icon" data-feather="alert-triangle"></i> Password Test Anda : Akan--}}
                        {{--                            informasikan--}}
                        {{--                            sebelum test berlangsung--}}
                        {{--                        </div>--}}

                        <div class="card col-7">
                            <div class="card-header text-center bg-secondary bg-opacity-10  border-1 border-secondary">
                                <h5><b>KARTU LOGIN UJIAN</b></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Nama Akun</div>
                                        <div class="col-8">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Username</div>
                                        <div class="col-8">{{ \Illuminate\Support\Facades\Auth::user()->email }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Password</div>
                                        <div class="col-8">
                                            @if(count($jadwal) > 0)
                                                @foreach($jadwal as $j)
                                                    {{ $j->password }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu informasi selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Hari, tanggal</div>
                                        <div class="col-8">
                                            @if(count($jadwal) > 0)
                                                @foreach($jadwal as $j)
                                                    @php
                                                        setlocale(LC_ALL, 'ID');
                                                        $date = strtotime($j->waktu);
                                                        $date = strftime("%A, %e %B %Y", $date);
                                                    @endphp
                                                    {{ $date }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu informasi selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Waktu</div>
                                        <div class="col-8">
                                            @if(count($jadwal) > 0)
                                                @php
                                                    $date = date_create($j->waktu);
                                                @endphp
                                                {{ date_format($date, 'H.i') }} - selesai
                                            @else
                                                <i class="link-warning">harap tunggu informasi selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Ruangan</div>
                                        <div class="col-8">
                                            @if(count($jadwal) > 0)
                                                @foreach($jadwal as $j)
                                                    {{ $j->ruangan }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu informasi selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4 alert alert-danger col-7">
                            <i class="link-icon" data-feather="alert-circle"></i>Pastikan username dan password dicatat
                            dan dibawa ketika ujian berlangsung!
                        </div>
                        <div class="mt-3 alert alert-warning col-7">
                            <i class="link-icon" data-feather="alert-triangle"></i>Pastikan semua form pada menu yang
                            tersedia sudah diisi dengan benar!
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

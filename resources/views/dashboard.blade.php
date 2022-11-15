@extends('templates.master')
@section('content')

    {{-- This menu only for user level 2 and 3 --}}
    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
        @php
            foreach ($jurusan as $j) {
                $namaJurusan[] = $j->jurusan_name;
            }
        @endphp

        <div class="row mb-4">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><b>Jumlah Peserta</b></h6>
                        <div class="relative">
                            <canvas id="jkPieChart" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><b>Pilihan 1 dan 2 Setiap Jurusan</b></h6>
                        <div class="relative">
                            <canvas id="jurusanBarChart" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title"><b>Kelulusan Peserta</b></h6>
                        <div class="relative">
                            <canvas id="kelulusanDoughnutChart" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row mb-4">

        </div> --}}

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if (session('error') === '')
                            <div class="mt-2 alert alert-success">
                                <i class="link-icon" data-feather="check-circle"></i> Berhasil generate
                                kartu!
                            </div>
                        @elseif(session('error') == 1)
                            <div class="mt-2 alert alert-danger">
                                <i class="link-icon" data-feather="alert-circle"></i> Gagal saat mencoba
                                generate kartu,
                                silahkan coba kembali!
                            </div>
                        @endif

                        <div class="row">
                            <h6 class="card-title col-10"><b>Data Pendaftar</b></h6>
                            <div class="col-2">
                                <button type="button" class="btn btn-success col-12" data-bs-toggle="modal"
                                    data-bs-target="#modalJadwal">Generate Kartu</button>
                            </div>
                        </div>
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
                                        <th>PASSWORD UJIAN</th>
                                        {{-- <th>AKSI</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata != null)
                                                <td>{{ $u->biodata->nama_lengkap }}</td>
                                                <td>{{ $u->biodata->jenis_kelamin }}</td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                                <td><i class="link-danger">-</i></td>
                                            @endif

                                            <td>{{ $u->email }}</td>

                                            @if ($u->biodata != null)
                                                <td>{{ $u->biodata->no_telp }}</td>
                                                <td>{{ $u->biodata->alamat_lengkap }}</td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                                <td><i class="link-danger">-</i></td>
                                            @endif

                                            @if ($u->jurusan->isNotEmpty())
                                                @if (count($u->jurusan) >= 2)
                                                    @foreach ($u->jurusan as $j)
                                                        <td>{{ $j->jurusan_name }}</td>
                                                    @endforeach
                                                @else
                                                    <td>{{ $j->jurusan_name }}</td>
                                                    <td><i class="link-danger">-</i></td>
                                                @endif
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                                <td><i class="link-danger">-</i></td>
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
                                                <td><i class="link-danger">-</i></td>
                                                <td><i class="link-danger">-</i></td>
                                            @endif

                                            @if ($u->biodata != null)
                                                <td>{{ $u->biodata->tempat_lahir }}</td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                            @endif

                                            @if ($u->jadwal != null)
                                                <td>{{ $u->jadwal->password }}</td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                            @endif
                                            {{-- <td>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalJadwal" data-bs-id="{{ $u->id }}">Generate
                                                    Kartu</button>
                                            </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade modal-form" id="modalJadwal" tabindex="-1" aria-hidden="true"
                            aria-labelledby="modalJadwalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalJadwalLabel">Generate Kartu Login
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <form action="{{ route('processJadwal') }}" method="POST" id="modal-form">
                                        @csrf
                                        <div class="modal-body">
                                            {{-- <input type="hidden" name="user_id" id="userId"> --}}
                                            <div class="mb-3">
                                                <label for="user" class="form-label">Peserta</label>
                                                @if (count($user) > 0)
                                                    <select name="user_id" id="user" class="select-option"
                                                        data-width="100%" data-placeholder="Pilih Peserta" required>
                                                        <option value="">Pilih Peserta</option>
                                                        @foreach ($user as $u)
                                                            <option value="{{ $u->id }}">
                                                                {{ $u->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password
                                                    Ujian</label>
                                                <input type="text" class="form-control" id="password" name="password"
                                                    autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="datetime" class="form-label">Tanggal &
                                                    Waktu</label>
                                                <input name="waktu" class="form-control" id="datetime"
                                                    data-inputmask="'alias': 'datetime'"
                                                    data-inputmask-inputformat="yyyy/mm/dd HH:MM:ss" inputmode="numeric"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ruangan" class="form-label">Ruangan</label>
                                                <select name="ruangan" id="ruangan" class="select-option"
                                                    data-width="100%" data-placeholder="Pilih Ruangan" required>
                                                    <option value="">Pilih Ruangan</option>
                                                    <option value="Ruang Tes 1">Ruang Tes 1</option>
                                                    <option value="Ruang Tes 2">Ruang Tes 2</option>
                                                    <option value="Ruang Tes 3">Ruang Tes 3</option>
                                                    <option value="Ruang Tes 4">Ruang Tes 4</option>
                                                    <option value="Ruang Tes 5">Ruang Tes 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- This is menu only for user --}}
    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <h3>Selamat datang,
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}</h3>
                        </div>
                        <div class="card col-12 col-sm-12 col-md-7 col-lg-7" id="card">
                            <div class="card-header text-center bg-secondary bg-opacity-10  border-1 border-secondary">
                                <h5><b>KARTU LOGIN UJIAN</b></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Nama Akun</div>
                                        <div class="col-8">
                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Username</div>
                                        <div class="col-8">
                                            {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Password</div>
                                        <div class="col-8">
                                            @if (count($jadwal) > 0)
                                                @foreach ($jadwal as $j)
                                                    {{ $j->password }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu
                                                    informasi
                                                    selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Hari, tanggal</div>
                                        <div class="col-8">
                                            @if (count($jadwal) > 0)
                                                @foreach ($jadwal as $j)
                                                    @php
                                                        setlocale(LC_ALL, 'ID');
                                                        $date = strtotime($j->waktu);
                                                        $date = strftime('%A, %e %B %Y', $date);
                                                    @endphp
                                                    {{ $date }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu
                                                    informasi
                                                    selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Waktu</div>
                                        <div class="col-8">
                                            @if (count($jadwal) > 0)
                                                @php
                                                    $date = date_create($j->waktu);
                                                @endphp
                                                {{ date_format($date, 'H.i') }} - selesai
                                            @else
                                                <i class="link-warning">harap tunggu
                                                    informasi
                                                    selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col">Ruangan</div>
                                        <div class="col-8">
                                            @if (count($jadwal) > 0)
                                                @foreach ($jadwal as $j)
                                                    {{ $j->ruangan }}
                                                @endforeach
                                            @else
                                                <i class="link-warning">harap tunggu
                                                    informasi
                                                    selanjutnya!</i>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success col-12 col-sm-12 col-md-7 col-lg-7" id="cetak-kartu">CETAK
                                KARTU</button>
                        </div>
                        <div class="mt-3 alert alert-danger col-12 col-sm-12 col-md-7 col-lg-7">
                            <i class="link-icon" data-feather="alert-circle"></i>Pastikan
                            kartu ini
                            dicetak
                            dan dibawa ketika hendak ujian!
                        </div>
                        <div class="mt-3 alert alert-warning col-12 col-sm-12 col-md-7 col-lg-7">
                            <i class="link-icon" data-feather="alert-triangle"></i>Pastikan semua form
                            pada menu yang
                            tersedia sudah diisi dengan benar!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@extends('templates.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <p class="text-muted mb-3">Nilai Pendaftar</p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Nilai Pendaftar">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="align-middle">NO</th>
                                        <th rowspan="2" class="align-middle">NAMA</th>
                                        <th rowspan="2" class="align-middle">EMAIL</th>
                                        <th colspan="7" class="align-middle text-center">MATEMATIKA</th>
                                        <th colspan="7" class="align-middle text-center">B. INGGRIS</th>
                                    </tr>
                                    <tr>
                                        @for ($i = 0; $i < 2; $i++)
                                            <th>SM 1</th>
                                            <th>SM 2</th>
                                            <th>SM 3</th>
                                            <th>SM 4</th>
                                            <th>SM 5</th>
                                            <th>UN</th>
                                            <th>RERATA</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata->isNotEmpty())
                                                @foreach ($u->biodata as $b)
                                                    <td>{{ $b->nama_lengkap }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                            @endif

                                            <td>{{ $u->email }}</td>

                                            @if ($u->postNilai->isNotEmpty())
                                                @foreach ($u->postNilai as $pn)
                                                    <td>
                                                        @if ($pn->score_s1 <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_s1 }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pn->score_s2 <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_s2 }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pn->score_s3 <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_s3 }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pn->score_s4 <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_s4 }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pn->score_s5 <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_s5 }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($pn->score_un <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $pn->score_un }}
                                                        @endif
                                                    </td>
                                                    @php
                                                        $array = [$pn->score_s1, $pn->score_s2, $pn->score_s3, $pn->score_s4, $pn->score_s5, $pn->score_un];
                                                        $array = array_sum($array) / count($array);
                                                        $avg = number_format($array, 2);
                                                    @endphp
                                                    <td>
                                                        @if ($avg <= 0)
                                                            <i class="link-danger">0</i>
                                                        @else
                                                            {{ $avg }}
                                                    </td>
                                                @endif
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 14; $i++)
                                                <td><i class="link-danger">0</i></td>
                                            @endfor
                                    @endif
                                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>
            @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                <div class="row mb-4">
                    <h6>Daftar Nilai</h6>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>Silahkan isi nilai sesuai dengan nama pelajaran masing-masing!</p>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route('storePostNilai') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                        @foreach ($postnilai as $pn)
                            <input type="hidden" name="id[]" value="{{ $pn->id }}">
                        @endforeach

                        @if (session('error') === '')
                            <div class="mt-2 alert alert-success">
                                <i class="link-icon" data-feather="check-circle"></i> Berhasil menyimpan data!
                            </div>
                        @elseif(session('error') == 1)
                            <div class="mt-2 alert alert-danger">
                                <i class="link-icon" data-feather="alert-circle"></i> Gagal saat mencoba menyimpan
                                data, silahkan coba kembali!
                            </div>
                        @endif

                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama Pelajaran</th>
                                    <th colspan="5" class="text-center">Data Nilai</th>
                                </tr>
                                <tr>
                                    <th>Semester 1</th>
                                    <th>Semester 2</th>
                                    <th>Semester 3</th>
                                    <th>Semester 4</th>
                                    <th>Semester 5</th>
                                    <th>Nilai Ujian Nasional (UN)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $index => $val)
                                    <input type="hidden" name="nilai_id[]" value="{{ $val->id }}">
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $val->nilai_name }}</td>
                                        <td><input name="s1[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_s1) ? $postnilai[$index]->score_s1 : 0 }}">
                                        </td>
                                        <td><input name="s2[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_s2) ? $postnilai[$index]->score_s2 : 0 }}">
                                        </td>
                                        <td><input name="s3[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_s3) ? $postnilai[$index]->score_s3 : 0 }}">
                                        </td>
                                        <td><input name="s4[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_s4) ? $postnilai[$index]->score_s4 : 0 }}">
                                        </td>
                                        <td><input name="s5[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_s5) ? $postnilai[$index]->score_s5 : 0 }}">
                                        </td>
                                        <td><input name="s6[]" class="form-control" type="text"
                                                value="{{ isset($postnilai[$index]->score_un) ? $postnilai[$index]->score_un : 0 }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-1">
                            <button type="submit" class="btn btn-sm btn-danger me-2 mb-2">
                                <i class="btn-icon-prepend" data-feather="link"></i>
                                Simpan Nilai
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>

@endsection

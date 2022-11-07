@extends('templates.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <p class="text-muted mb-3">Prestasi Pendaftar</p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Prestasi Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>PRESTASI 1</th>
                                        <th>PRESTASI 2</th>
                                        <th>PRESTASI 3</th>
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

                                            @if ($u->prestasi->isNotEmpty())
                                                @foreach ($u->prestasi as $p)
                                                    <td>
                                                        @if ($p->tingkat == 0)
                                                            -
                                                        @else
                                                            {{ $p->prestasi }}<br>({{ $p->tingkat }})
                                                    </td>
                                                @endif
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 3; $i++)
                                                <td>-</td>
                                            @endfor
                                    @endif
                                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>

                {{-- This is menu only for user --}}
            @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                <div class="row mb-4">
                    <h6>Daftar Prestasi</h6>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>Silahkan isi prestasi berdasarkan nama dan tingkat jika ada!</p>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route('storePrestasi') }}" method="POST">
                        {{ csrf_field() }}
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

                        @for ($x = 0; $x < 3; $x++)
                            @php
                                $strPrestasi = isset($prestasi[$x]) ? $prestasi[$x]->prestasi : '';
                                $strTingkat = isset($prestasi[$x]) ? $prestasi[$x]->tingkat : '';
                            @endphp
                            <div class="mb-3 mt-4">
                                <input type="hidden" name="id[]" value="{{ $prestasi[$x]->id ?? 0 }}">
                                <label for="prestasi" class="form-label text-muted">Prestasi
                                    {{ $x + 1 }}</label>
                                <div class="row mb-3">
                                    <div class="col-sm-5">
                                        <input name="prestasi[]" type="text" class="form-control"
                                            value="{{ $strPrestasi }}">
                                    </div>

                                    <div class="col-sm-7">
                                        <select class="form-control" name="tingkat[]">
                                            <option value="0">Pilih Tingkat</option>
                                            @php
                                                $optTingkat = ['Tingkat Nasional', 'Tingkat Provinsi', 'Tingkat Kabupaten'];
                                            @endphp
                                            @for ($opt = 0; $opt < count($optTingkat); $opt++)
                                                <option value="{{ $optTingkat[$opt] }}"
                                                    {{ $optTingkat[$opt] == $strTingkat ? 'selected=true' : '' }}>
                                                    {{ $optTingkat[$opt] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                            </div>
                        @endfor

                        <div class="mt-1">
                            <button type="submit" class="btn btn-sm btn-danger me-2 mb-2">
                                <i class="btn-icon-prepend" data-feather="link"></i>
                                Simpan Semua Prestasi
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

@extends('templates.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <h6 class="card-title"><b>Jurusan Pendaftar</b></h6>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Jurusan Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>PILIHAN 1</th>
                                        <th>PILIHAN 2</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata != null)
                                                <td>{{ $u->biodata->nama_lengkap }}</td>
                                            @else
                                                <td><span class="text-danger">-</span></td>
                                            @endif

                                            <td>{{ $u->email }}</td>

                                            @if ($u->jurusan->isNotEmpty())
                                                @if (count($u->jurusan) > 1)
                                                    @foreach ($u->jurusan as $j)
                                                        <td>{{ $j->jurusan_name }}</td>
                                                    @endforeach
                                                @else
                                                    <td>{{ $j->jurusan_name }}</td>
                                                    <td><span class="text-danger">-</span></td>
                                                @endif
                                            @else
                                                <td><span class="text-danger">-</span></td>
                                                <td><span class="text-danger">-</span></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        {{-- This is menu only for user --}}
                    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                        <div class="row mb-4">
                            <h6>Jurusan Pilihan Peserta</h6>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p>Silahkan pilih jurusan, Jurusan bisa lebih dari satu!</p>
                            </div>
                        </div>

                        <div class="row">
                            <form action="{{ route('storePostJurusan') }}" method="POST" id="jurusan-form">
                                {{ csrf_field() }}
                                <h5 class="mt-4">Daftar Jurusan yang tersedia</h5>
                                <input type="hidden" name="user_id"
                                    value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                                @foreach ($postJurusan as $pj)
                                    <input type="hidden" name="id[]" value="{{ $pj->id }}">
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

                                <div class="mb-3 mt-4">
                                    <label for="jurusan" class="form-label text-muted">Jurusan 1<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="jurusan1" required>
                                        <option value="">Pilih Jurusan</option>
                                        @php
                                            $selectedID = '';
                                            if (!empty($postJurusan) && count($postJurusan) > 0) {
                                                $selectedID = $postJurusan[0]['jurusan_id'];
                                            }
                                        @endphp

                                        @foreach ($jurusan as $datajurusan)
                                            <option value="{{ $datajurusan->id }}"
                                                {{ $datajurusan->id == $selectedID ? 'selected=true' : '' }}>
                                                {{ $datajurusan->jurusan_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3 mt-4">
                                    <label for="jurusan" class="form-label text-muted">Jurusan 2<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="jurusan2" required>
                                        <option value="">Pilih Jurusan</option>
                                        @php
                                            $selectedID = '';
                                            if (!empty($postJurusan) && count($postJurusan) > 1) {
                                                $selectedID = $postJurusan[1]['jurusan_id'];
                                            }
                                        @endphp

                                        @foreach ($jurusan as $datajurusan)
                                            <option value="{{ $datajurusan->id }}"
                                                {{ $datajurusan->id == $selectedID ? 'selected=true' : '' }}>
                                                {{ $datajurusan->jurusan_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- @for ($x = 0; $x < 2; $x++)
                                    <div class="mb-3 mt-4">
                                        <label for="jurusan" class="form-label text-muted">Jurusan
                                            {{ $x + 1 }}<span class="text-danger">*</span></label>
                                        <select class="form-control" name="jurusan[]" required>
                                            <option value="">Pilih Jurusan</option>
                                            @php
                                                $selectedID = '';
                                                if (!empty($postJurusan) && count($postJurusan) > $x) {
                                                    $selectedID = $postJurusan[$x]['jurusan_id'];
                                                }
                                            @endphp

                                            @foreach ($jurusan as $datajurusan)
                                                <option value="{{ $datajurusan->id }}"
                                                    {{ $datajurusan->id == $selectedID ? 'selected=true' : '' }}>
                                                    {{ $datajurusan->jurusan_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                @endfor --}}

                                <div class="mt-1">
                                    <button type="submit" class="btn btn-sm btn-danger me-2 mb-2">
                                        <i class="btn-icon-prepend" data-feather="link"></i>
                                        Simpan Jurusan
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

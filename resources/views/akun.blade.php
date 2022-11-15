@extends('templates.master')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
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

                        <div class="row">
                            <h6 class="card-title col-10"><b>Akun yang Terdaftar</b></h6>
                            <div class="col-2">
                                <button type="button" class="btn btn-success col-12" data-bs-toggle="modal"
                                    data-bs-target="#modalReset">Reset Password</button>
                            </div>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Akun yang Terdaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA AKUN</th>
                                        <th>BIODATA</th>
                                        <th>NILAI</th>
                                        <th>JURUSAN</th>
                                        <th>DATA KELUARGA</th>
                                        <th>PRESTASI</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $u->name }}</td>

                                            @if ($u->biodata != null)
                                                @if ($u->biodata->tempat_lahir != null &&
                                                    $u->biodata->tgl_lahir != null &&
                                                    $u->biodata->status_perkawinan != null &&
                                                    $u->biodata->agama != null &&
                                                    $u->biodata->anak_ke != null &&
                                                    $u->biodata->jumlah_saudara != null &&
                                                    $u->biodata->alamat_lengkap != null)
                                                    <td><span class="badge bg-success">LENGKAP</span></td>
                                                @else
                                                    <td><span class="badge bg-warning">BELUM LENGKAP</span></td>
                                                @endif
                                            @else
                                                <td><span class="badge bg-danger">BELUM DIISI</span></td>
                                            @endif

                                            @if ($u->postNilai->isNotEmpty())
                                                @php
                                                    for ($i = 0; $i < count($u->postNilai); $i++) {
                                                        if ($u->postNilai[0]->score_s1 > 0 && $u->postNilai[0]->score_s2 > 0 && $u->postNilai[0]->score_s3 > 0 && $u->postNilai[0]->score_s4 > 0 && $u->postNilai[0]->score_s5 > 0 && $u->postNilai[0]->score_un > 0 && $u->postNilai[1]->score_s1 > 0 && $u->postNilai[1]->score_s2 > 0 && $u->postNilai[1]->score_s3 > 0 && $u->postNilai[1]->score_s4 > 0 && $u->postNilai[1]->score_s5 > 0 && $u->postNilai[1]->score_un > 0) {
                                                            $nilai = 'LENGKAP';
                                                        } else {
                                                            $nilai = 'BELUM LENGKAP';
                                                        }
                                                    }
                                                @endphp
                                                @if ($nilai == 'LENGKAP')
                                                    <td><span class="badge bg-success">LENGKAP</span></td>
                                                @else
                                                    <td><span class="badge bg-warning">BELUM LENGKAP</span></td>
                                                @endif
                                            @else
                                                <td><span class="badge bg-danger">BELUM DIISI</span></td>
                                            @endif

                                            @if ($u->jurusan->isNotEmpty())
                                                @php
                                                    for ($i = 0; $i < count($u->jurusan); $i++) {
                                                        if (count($u->jurusan) > 1) {
                                                            if ($u->jurusan[0]->id != null && $u->jurusan[1]->id != null) {
                                                                $jurusan = 'LENGKAP';
                                                            } else {
                                                                $jurusan = 'BELUM LENGKAP';
                                                            }
                                                        } else {
                                                            $jurusan = 'BELUM LENGKAP';
                                                        }
                                                    }
                                                @endphp
                                                @if ($jurusan == 'LENGKAP')
                                                    <td><span class="badge bg-success">LENGKAP</span></td>
                                                @else
                                                    <td><span class="badge bg-warning">BELUM LENGKAP</span></td>
                                                @endif
                                            @else
                                                <td><span class="badge bg-danger">BELUM DIISI</span></td>
                                            @endif

                                            @if ($u->datakeluarga != null)
                                                @if ($u->datakeluarga->usia_ayah != null &&
                                                    $u->datakeluarga->usia_ibu != null &&
                                                    $u->datakeluarga->alamat_ayah != null &&
                                                    $u->datakeluarga->alamat_ibu != null &&
                                                    $u->datakeluarga->no_telp_ayah != null &&
                                                    $u->datakeluarga->no_telp_ibu != null)
                                                    <td><span class="badge bg-success">LENGKAP</span></td>
                                                @else
                                                    <td><span class="badge bg-warning">BELUM LENGKAP</span></td>
                                                @endif
                                            @else
                                                <td><span class="badge bg-danger">BELUM DIISI</span></td>
                                            @endif

                                            @if ($u->prestasi->isNotEmpty())
                                                @switch(count($u->prestasi))
                                                    @case(1)
                                                        <td><span class="badge bg-secondary">1 PRESTASI</span></td>
                                                    @break

                                                    @case(2)
                                                        <td><span class="badge bg-primary">2 PRESTASI</span></td>
                                                    @break

                                                    @case(3)
                                                        <td><span class="badge bg-success">3 PRESTASI</span></td>
                                                    @break

                                                    @default
                                                        <td><span class="badge bg-danger">-</span></td>
                                                @endswitch
                                            @else
                                                <td><span class="badge bg-danger">-</span></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade modal-form" id="modalReset" tabindex="-1" aria-hidden="true"
                            aria-labelledby="modalResetLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalResetLabel">Reset Password Peserta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <form action="{{ route('processReset') }}" method="POST" id="modal-form">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="user" class="form-label">Peserta</label>
                                                @if (count($user) > 0)
                                                    <select name="user" id="user" class="select-option"
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
                                                <label for="password" class="form-label">Password Baru</label>
                                                <input type="text" name="password" id="password" class="form-control"
                                                    autocomplete="off" required>
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
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection

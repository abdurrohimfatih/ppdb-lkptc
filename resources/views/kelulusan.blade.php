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
                            <h6 class="card-title col-10"><b>Kelulusan Pendaftar</b></h6>
                            <div class="col-2">
                                <button type="button" class="btn btn-success col-12" data-bs-toggle="modal"
                                    data-bs-target="#modalLulus">Buat Kelulusan</button>
                            </div>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Kelulusan Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>STATUS LULUS</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata != null)
                                                <td>{{ $u->biodata->nama_lengkap }}</td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                            @endif

                                            <td>{{ $u->email }}</td>

                                            @if ($u->kelulusan != null)
                                                <td>
                                                    @if ($u->kelulusan->status == 1)
                                                        <span class="badge bg-success">LULUS</span>
                                                    @else
                                                        <span class="badge bg-danger">TIDAK LULUS</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td><i class="link-danger">-</i></td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade modal-form" id="modalLulus" tabindex="-1" aria-hidden="true"
                            aria-labelledby="modalLulusLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLulusLabel">Buat Kelulusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <form action="{{ route('processKelulusan') }}" method="POST" id="modal-form">
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
                                                <label for="status" class="form-label">Status Lulus</label>
                                                <select name="status" id="status" class="select-option"
                                                    data-width="100%" data-placeholder="Pilih Status Lulus" required>
                                                    <option value="">Pilih Status Lulus</option>
                                                    <option value="1">Lulus</option>
                                                    <option value="0">Tidak Lulus</option>
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

                        {{-- This is menu only for user --}}
                    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                        <div class="row mb-4">
                            <h6>Pengumuman Kelulusan</h6>
                        </div>

                        <div class="row">
                            <div class="ml-3">
                                @if ($kelulusan != null)
                                    @if ($kelulusan->status == 1)
                                        <div class="alert alert-success">
                                            Selamat, Anda dinyatakan
                                            <span class="badge bg-success">LULUS</span><br>
                                            Silakan menunggu informasi selanjutnya!
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            Mohon maaf, Anda dinyatakan
                                            <span class="badge bg-danger">BELUM LULUS</span><br>
                                            Tetap semangat!
                                        </div>
                                    @endif
                                @else
                                    <div class="alert alert-warning">
                                        Mohon bersabar,
                                        <span class="badge bg-warning">BELUM ADA</span>
                                        pengumuman kelulusan!
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection

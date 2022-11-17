@extends('templates.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <h6 class="card-title"><b>Data Keluarga Pendaftar</b></h6>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Data Keluarga Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>NAMA AYAH</th>
                                        <th>PEKERJAAN AYAH</th>
                                        <th>USIA AYAH</th>
                                        <th>ALAMAT AYAH</th>
                                        <th>NO HP/WA AYAH</th>
                                        <th>NAMA IBU</th>
                                        <th>PEKERJAAN IBU</th>
                                        <th>USIA IBU</th>
                                        <th>ALAMAT IBU</th>
                                        <th>NO HP/WA IBU</th>
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

                                            @if ($u->datakeluarga != null)
                                                <td>{{ $u->datakeluarga->nama_ayah }}</td>
                                                <td>{{ $u->datakeluarga->pekerjaan_ayah }}</td>
                                                <td>
                                                    @if ($u->datakeluarga->usia_ayah != null)
                                                        {{ $u->datakeluarga->usia_ayah }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($u->datakeluarga->alamat_ayah != null)
                                                        {{ $u->datakeluarga->alamat_ayah }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($u->datakeluarga->no_telp_ayah != null)
                                                        {{ $u->datakeluarga->no_telp_ayah }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $u->datakeluarga->nama_ibu }}</td>
                                                <td>{{ $u->datakeluarga->pekerjaan_ibu }}</td>
                                                <td>
                                                    @if ($u->datakeluarga->usia_ibu != null)
                                                        {{ $u->datakeluarga->usia_ibu }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($u->datakeluarga->alamat_ibu != null)
                                                        {{ $u->datakeluarga->alamat_ibu }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($u->datakeluarga->no_telp_ibu != null)
                                                        {{ $u->datakeluarga->no_telp_ibu }}
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                            @else
                                                @for ($i = 0; $i < 10; $i++)
                                                    <td><span class="text-danger">-</span></td>
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
                            <h6>Data Keluarga</h6>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p>Silahkan Lengkapi Data Keluarga Anda!</p>
                            </div>
                        </div>

                        <div class="row">
                            <form action="{{ route('processDataKeluarga') }}" method="POST" enctype="multipart/form-data"
                                id="datakeluarga-form">
                                {{ csrf_field() }}

                                <h5 class="mt-4">Biodata Ayah</h5>

                                <input type="hidden" name="id" value="{{ $datakeluarga->id ?? null }}">
                                <input type="hidden" name="user_id"
                                    value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

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
                                    <div class="mb-3 mt-4">
                                        <label for="nama_ayah" class="form-label text-muted">Nama Ayah<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_ayah" id="nama_ayah"
                                            placeholder="Masukkan nama ayah anda"
                                            value="{{ $datakeluarga->nama_ayah ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="pekerjaan_ayah" class="form-label text-muted">Pekerjaan Ayah<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                            placeholder="Masukkan pekerjaan ayah anda"
                                            value="{{ $datakeluarga->pekerjaan_ayah ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="usia_ayah" class="form-label text-muted">Usia Ayah</label>
                                        <input type="text" class="form-control" name="usia_ayah" id="usia_ayah"
                                            placeholder="Masukkan usia ayah anda"
                                            value="{{ $datakeluarga->usia_ayah ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="alamat_ayah" class="form-label text-muted">Alamat Ayah</label>
                                        <input type="text" class="form-control" name="alamat_ayah" id="alamat_ayah"
                                            placeholder="Masukkan alamat ayah anda"
                                            value="{{ $datakeluarga->alamat_ayah ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="no_telp_ayah" class="form-label text-muted">No Telepon / WA Ayah</label>
                                        <input type="text" class="form-control" name="no_telp_ayah" id="no_telp_ayah"
                                            placeholder="Masukkan no telp/WA ayah anda"
                                            value="{{ $datakeluarga->no_telp_ayah ?? null }}">
                                    </div>
                                </div>
                                <p></p>
                                <p></p>



                                <h5 class="mt-4">Biodata Ibu</h5>
                                <div class="row">


                                    <div class="mb-3 mt-4">
                                        <label for="nama_ibu" class="form-label text-muted">Nama Ibu<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nama_ibu" id="nama_ibu"
                                            placeholder="Masukkan nama ibu anda"
                                            value="{{ $datakeluarga->nama_ibu ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="pekerjaan_ibu" class="form-label text-muted">Pekerjaan Ibu<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pekerjaan_ibu"
                                            id="pekerjaan_ibu" placeholder="Masukkan pekerjaan ibu anda"
                                            value="{{ $datakeluarga->pekerjaan_ibu ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="usia_ibu" class="form-label text-muted">Usia Ibu</label>
                                        <input type="text" class="form-control" name="usia_ibu" id="usia_ibu"
                                            placeholder="Masukkan usia ibu anda"
                                            value="{{ $datakeluarga->usia_ibu ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="alamat_ibu" class="form-label text-muted">Alamat Ibu</label>
                                        <input type="text" class="form-control" name="alamat_ibu" id="alamat_ibu"
                                            placeholder="Masukkan alamat ibu anda"
                                            value="{{ $datakeluarga->alamat_ibu ?? null }}">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <label for="no_telp_ibu" class="form-label text-muted">No Telepon / WA Ibu</label>
                                        <input type="text" class="form-control" name="no_telp_ibu" id="no_telp_ibu"
                                            placeholder="Masukkan no telp/WA ibu anda"
                                            value="{{ $datakeluarga->no_telp_ibu ?? null }}">
                                    </div>

                                </div>

                                <div class="mt-1">
                                    <button type="submit" class="btn btn-sm btn-danger me-2 mb-2">
                                        <i class="btn-icon-prepend" data-feather="link"></i>
                                        Simpan Data Keluarga
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

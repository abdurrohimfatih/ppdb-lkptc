@extends('templates.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- This menu only for user level 2 and 3 --}}
                    @if (\Illuminate\Support\Facades\Auth::user()->level >= 2)
                        <p class="text-muted mb-3">Biodata Pendaftar</p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered table-striped table-hover" id="table"
                                data-fileName="Biodata Pendaftar">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NAMA</th>
                                        <th>EMAIL</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>NO HP/WA</th>
                                        <th>TEMPAT LAHIR</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>STATUS MARITAL</th>
                                        <th>AGAMA</th>
                                        <th>ANAK KE</th>
                                        <th>JML SAUDARA</th>
                                        <th>ALAMAT</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            @if ($u->biodata->isNotEmpty())
                                                @foreach ($u->biodata as $b)
                                                    <td>{{ $b->nama_lengkap }}</td>
                                                    <td>{{ $u->email }}</td>
                                                    <td>{{ $b->jenis_kelamin }}</td>
                                                    <td>{{ $b->no_telp }}</td>
                                                    <td>{{ $b->tempat_lahir }}</td>

                                                    @php
                                                        $date = date_create($b->tgl_lahir);
                                                    @endphp

                                                    <td>{{ date_format($date, 'd-m-Y') }}</td>
                                                    <td>{{ $b->status_perkawinan }}</td>
                                                    <td>{{ $b->agama }}</td>
                                                    <td>{{ $b->anak_ke }}</td>
                                                    <td>{{ $b->jumlah_saudara }}</td>
                                                    <td>{{ $b->alamat_lengkap }}</td>
                                                @endforeach
                                            @else
                                                <td><i class="link-danger">belum diisi</i></td>
                                                <td>{{ $u->email }}</td>
                                                @for ($i = 0; $i < 9; $i++)
                                                    <td><i class="link-danger">belum diisi</i></td>
                                                @endfor
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @elseif(\Illuminate\Support\Facades\Auth::user()->level == 1)
                        <div class="row mb-4">
                            <h6>Biodata</h6>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p>Silahkan lengkapi biodata anda!</p>
                            </div>
                        </div>

                        <div class="row">
                            <form action="{{ route('processBiodata') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <h5 class="mt-4">Data Pribadi</h5>

                                <input type="hidden" name="id" value="{{ $biodata->id ?? null }}">
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

                                @php
                                    $imguser = 'no-img.png';
                                    if (!empty($biodata)) {
                                        $imguser = $biodata->img_user ?? null;
                                    }
                                @endphp

                                <div class="mb-3 mt-1 d-flex align-items-center">
                                    <!--                            <img width="80px" alt="User Img" src="{{ asset('storage/upload/img/') . '/' . $imguser }}">-->
                                    <!--                            <div class="ms-2">-->
                                    <!--                                <input type="file" class="form-control" name="img_user" id="img_user">-->
                                    <!--                            </div>-->
                                </div>


                                <div class="mb-3 mt-4">
                                    <label for="nama_lengkap" class="form-label text-muted">Nama Lengkap<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                        placeholder="Masukkan nama lengkap anda"
                                        value="{{ $biodata->nama_lengkap ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="no_telp" class="form-label text-muted">No Telepon / WA<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="no_telp" id="no_telp"
                                        placeholder="Masukkan No Telp/WA anda" value="{{ $biodata->no_telp ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="tempat_lahir" class="form-label text-muted">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                                        placeholder="Masukkan tempat lahir anda"
                                        value="{{ $biodata->tempat_lahir ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="tgl_lahir" class="form-label text-muted">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                        value="{{ $biodata->tgl_lahir ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label class="form-label text-muted">Jenis Kelamin</label>
                                    @php
                                        $strL = 'checked';
                                        $strP = '';
                                        $jk = $biodata->jenis_kelamin ?? null;
                                    @endphp
                                    @if ($jk == 'P')
                                        @php
                                            $strL = '';
                                            $strP = 'checked';
                                        @endphp
                                    @endif
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input value="L" type="radio" class="form-check-input"
                                                name="jenis_kelamin" id="l" {{ $strL }}>
                                            <label class="form-check-label" for="l">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input value="P" type="radio" class="form-check-input"
                                                name="jenis_kelamin" id="p" {{ $strP }}>
                                            <label class="form-check-label" for="p">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="agama" class="form-label text-muted">Agama</label>
                                    <input type="text" class="form-control" name="agama" id="agama"
                                        placeholder="Agama anda" value="{{ $biodata->agama ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="status_perkawinan" class="form-label text-muted">Status Perkawinan (Tulis
                                        Salah Satu)</label>
                                    <input type="text" class="form-control" name="status_perkawinan"
                                        id="status_perkawinan" placeholder="Belum Kawin / Kawin / Duda / Janda"
                                        value="{{ $biodata->status_perkawinan ?? null }}">
                                </div>



                                <div class="mb-3 mt-1">
                                    <label for="anak_ke" class="form-label text-muted">Anak Ke</label>
                                    <input type="text" class="form-control" name="anak_ke" id="anak_ke"
                                        placeholder="Anak ke" value="{{ $biodata->anak_ke ?? null }}">
                                </div>

                                <div class="mb-3 mt-1">
                                    <label for="jumlah_saudara" class="form-label text-muted">Jumlah Saudara</label>
                                    <input type="text" class="form-control" name="jumlah_saudara" id="jumlah_saudara"
                                        placeholder="jumlah saudara" value="{{ $biodata->jumlah_saudara ?? null }}">
                                </div>


                                <div class="mb-3 mt-1">
                                    <label for="alamat_lengkap" class="form-label text-muted">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat_lengkap" cols="12" rows="2" id="alamat_lengkap"
                                        placeholder="Tuliskan alamat lengkap anda">{{ $biodata->alamat_lengkap ?? null }}</textarea>
                                </div>

                                <div class="mt-1">
                                    <button type="submit" class="btn btn-sm btn-info me-2 mb-2">
                                        <i class="btn-icon-prepend" data-feather="link"></i>
                                        Simpan Biodata
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

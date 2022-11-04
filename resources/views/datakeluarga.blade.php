
@extends('templates.master')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-4">
                    <h6>Data Keluarga</h6>
                </div>

                <div class="row">
                    <div class="col-md-12"><p>Silahkan Lengkapi Data Keluarga Anda!</p></div>
                </div>

                <div class="row">
                    <form action="{{route('processDataKeluarga')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <h5 class="mt-4">Biodata Ayah</h5>

                        <input type="hidden" name="id" value="{{$datakeluarga->id??null}}">
                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                        @if (session('error') === '')
                        <div class="mt-2 alert alert-success">
                            <i class="link-icon" data-feather="check-circle"></i> Berhasil menyimpan data!
                        </div>
                        @elseif(session('error') == 1)
                        <div class="mt-2 alert alert-danger">
                            <i class="link-icon" data-feather="alert-circle"></i> Gagal saat mencoba menyimpan data, silahkan coba kembali!
                        </div>
                        @endif

                        <div class="row">
                        <div class="mb-3 mt-4">
                            <label for="nama_ayah" class="form-label text-muted">Nama Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" placeholder="Masukkan ayah anda" value="{{$datakeluarga->nama_ayah??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="pekerjaan_ayah" class="form-label text-muted">Pekerjaan Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" placeholder="Masukkan pekerjaan ayah anda" value="{{$datakeluarga->pekerjaan_ayah??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="usia_ayah" class="form-label text-muted">Usia Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="usia_ayah" id="usia_ayah" placeholder="Masukkan usia ayah anda" value="{{$datakeluarga->usia_ayah??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="alamat_ayah" class="form-label text-muted">Alamat Ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat_ayah" id="alamat_ayah" placeholder="Masukkan alamat ayah anda" value="{{$datakeluarga->alamat_ayah??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="no_telp_ayah" class="form-label text-muted">No Telepon / WA ayah<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telp_ayah" id="no_telp_ayah" placeholder="Masukkan no tlp/wa ayah anda" value="{{$datakeluarga->no_telp_ayah??null}}">
                        </div>
                        </div>
                        <p></p>
                        <p></p>



                        <h5 class="mt-4">Biodata Ibu</h5>
                        <div class="row">


                        <div class="mb-3 mt-4">
                            <label for="nama_ibu" class="form-label text-muted">Nama ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Masukkan ibu anda" value="{{$datakeluarga->nama_ibu??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="pekerjaan_ibu" class="form-label text-muted">Pekerjaan ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" placeholder="Masukkan pekerjaan ibu anda" value="{{$datakeluarga->pekerjaan_ibu??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="usia_ibu" class="form-label text-muted">Usia ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="usia_ibu" id="usia_ibu" placeholder="Masukkan usia ibu anda" value="{{$datakeluarga->usia_ibu??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="alamat_ibu" class="form-label text-muted">Alamat ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat_ibu" id="alamat_ibu" placeholder="Masukkan alamat ibu anda" value="{{$datakeluarga->alamat_ibu??null}}">
                        </div>

                        <div class="mb-3 mt-4">
                            <label for="no_telp_ibu" class="form-label text-muted">No Telepon / WA ibu<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telp_ibu" id="no_telp_ibu" placeholder="Masukkan no tlp/wa ibu anda" value="{{$datakeluarga->no_telp_ibu??null}}">
                        </div>

                        </div>

                        <div class="mt-1">
                            <button type="submit" class="btn btn-sm btn-info me-2 mb-2">
                                <i class="btn-icon-prepend" data-feather="link"></i>
                                Simpan Data Keluarga
                            </button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

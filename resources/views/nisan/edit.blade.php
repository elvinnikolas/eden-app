@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Baru</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/nisan">Nisan</a></li>
                    <li class="breadcrumb-item active">Ubah</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ url('/nisan/update/'. $nisan->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><b>Data Almarhum</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nomor Urut:</label>
                                <input type="text" class="form-control" name="nomor" required value="{{$nisan->nomor}}">
                            </div>
                            <div class="form-group">
                                <label>Blok & Nomor Nisan:</label>
                                <input type="text" class="form-control" name="blok_nomor_nisan" required value="{{$nisan->blok_nomor_nisan}}">
                            </div>
                            <div class="form-group">
                                <label>Nama:</label>
                                <input type="text" class="form-control" name="nama" required value="{{$nisan->nama}}">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Meninggal:</label>
                                <div class="input-group date" id="tanggal">
                                    <input type="text" class="form-control" name="tanggal" required value="{{$nisan->tanggal}}" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Asal Gereja:</label>
                                <input type="text" class="form-control" name="gereja" required value="{{$nisan->gereja}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Foto:</label>
                                <div class="input-group">
                                    <!-- <div class="custom-file"> -->
                                    <!-- <input type="file" class="custom-file-input"> -->
                                    <input type="file" name="foto">
                                    @error('foto')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Keluarga</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama & No HP Keluarga:</label>
                            <input type="text" class="form-control" name="nama_nomor_keluarga" required value="{{$nisan->nama_nomor_keluarga}}">
                        </div>
                        <div class="form-group">
                            <label>Email Keluarga:</label>
                            <input type="text" class="form-control" name="email" required value="{{$nisan->email}}">
                        </div>
                        <div class="form-group">
                            <label>Pembayaran Iuran Terakhir:</label>
                            <div class="input-group date" id="tanggal_iuran">
                                <input type="text" class="form-control" name="pembayaran_terakhir" required value="{{$nisan->pembayaran_terakhir}}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <button type="submit" class="btn btn-lg btn-primary float-right" onclick="return confirm('Apakah anda yakin ingin menyimpan data ini?')">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $('#tanggal').datepicker({
        format: 'yyyy/mm/dd',
        orientation: "bottom"
    });
    $('#tanggal_iuran').datepicker({
        format: "yyyy/mm",
        orientation: "bottom",
        viewMode: "months",
        minViewMode: "months"
    });

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menyimpan data ini?")) {

        } else {
            return false;
        }
    }
</script>
@endpush
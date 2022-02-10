@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Nisan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Nisan</li>
                </ol>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <form action="{{ url('/nisan') }}" method="get" style="display:inline-block;">
            <input type="submit" value="Tampilkan Semua" class="btn btn-outline-primary">
        </form>
        &nbsp;
        <form style="display:inline-block;">
            <button class="btn btn-outline-primary" data-toggle="collapse" data-target="#filter_nama" type="button">
                Filter Nama
            </button>
        </form>
        &nbsp;
        <form style="display:inline-block;">
            <button class="btn btn-outline-primary" data-toggle="collapse" data-target="#filter_tahun" type="button">
                Filter Tahun
            </button>
        </form>
        <a href="{{ url('/nisan/create')}}" class="btn btn-primary float-right">
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
            <b>Tambah Data</b>
        </a>
    </div>
    <br>
    <div id="filter_nama" class="collapse">
        <form action="{{ url('/nisan/filter/name')}}" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label>Nama:</label>
                            <div class="input-group text">
                                <input type="text" class="form-control" name="name" value="{{ Request::get('name')}}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <div class="form-group">
                            <label for=""> </label>
                            <div class="input-group">
                                <button type="submit" class="btn btn-md btn-block btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="filter_tahun" class="collapse">
        <form action="{{ url('/nisan/filter/year')}}" method="post">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label>Dari:</label>
                            <div class="input-group date" id="tahun_mulai">
                                <input type="text" class="form-control" name="start" value="{{ Request::get('start')}}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group">
                            <label>Sampai:</label>
                            <div class="input-group date" id="tahun_sampai">
                                <input type="text" class="form-control" name="end" value="{{ Request::get('end') }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-1">
                        <div class="form-group">
                            <label for=""> </label>
                            <div class="input-group">
                                <button type="submit" class="btn btn-md btn-block btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Alert -->
@if(session()->get('created'))
<div class="alert alert-success alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session()->get('created') }}
</div>

@elseif(session()->get('edited'))
<div class="alert alert-info alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session()->get('edited') }}
</div>

@elseif(session()->get('deleted'))
<div class="alert alert-danger alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session()->get('deleted') }}
</div>
@endif

<!-- Main content -->
<section class="content">
    <table class="table table-light table-striped" id="table-nisan">
        <thead class="thead-light">
            <tr>
                <th>No Urut</th>
                <th>No Nisan</th>
                <th>Nama Almarhum</th>
                <th>Tanggal Meninggal</th>
                <th>Asal Gereja</th>
                <th>Pembayaran Terakhir</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $nisan)
            <tr>
                <td>{{ $nisan->nomor}}</td>
                <td>{{ $nisan->blok_nomor_nisan}}</td>
                <td>{{ $nisan->nama}}</td>
                <td>{{ $nisan->tanggal}}</td>
                <td>{{ $nisan->gereja}}</td>
                <td>{{ $nisan->pembayaran_terakhir}}</td>
                <td>
                    <a href="{{ url('/nisan/show/' . $nisan->id )}}" class="btn-sm btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Lihat">
                        <i class=" fa fa-eye" id="action_button"></i>&nbsp;&nbsp;
                    </a>
                    <a href="{{ url('/nisan/edit/' . $nisan->id )}}" class="btn-sm btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Ubah">
                        <i class="fa fa-edit"></i>&nbsp;&nbsp;
                    </a>
                    <a href="{{ url('/nisan/destroy/' . $nisan->id)}}" class="btn-sm btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <i class="fa fa-trash"></i>&nbsp;&nbsp;
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection

@push('scripts')
<script>
    $('#table-nisan').DataTable({
        "order": []
    });

    $('#tahun_mulai').datepicker({
        format: 'yyyy',
        orientation: "bottom",
        viewMode: "years",
        minViewMode: "years"
    });

    $('#tahun_sampai').datepicker({
        format: 'yyyy',
        orientation: "bottom",
        viewMode: "years",
        minViewMode: "years"
    });

    function showConfirm() {
        if (confirm("Apakah anda yakin ingin menghapus data ini?")) {

        } else {
            return false;
        }
    }
</script>
@endpush
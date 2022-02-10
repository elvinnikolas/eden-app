@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Nisan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/nisan">Nisan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Almarhum</b></h3>
                    </div>
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('/images/'.$nisan->image)}}" style=" width:80%">
                        </div>

                        <h3 class="profile-username text-center">{{$nisan->nama}}</h3>

                        <p class="text-muted text-center">{{$nisan->tanggal}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>No Urut:</b>
                                <p class="float-right">{{$nisan->nomor}}</p>
                            </li>
                            <li class="list-group-item">
                                <b>Blok & No Nisan:</b>
                                <p class="float-right">{{$nisan->blok_nomor_nisan}}</p>
                            </li>
                            <li class="list-group-item">
                                <b>Asal Gereja:</b>
                                <p class="float-right">{{$nisan->gereja}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><b>Data Keluarga</b></h3>
                    </div>
                    <div class="card-body">
                        <strong>Nama & No Hp Keluarga:</strong>
                        <p class="text-muted">
                            {{$nisan->nama_nomor_keluarga}}
                        </p>
                        <hr>
                        <strong>Email Keluarga:</strong>
                        <p class="text-muted">
                            {{$nisan->email}}
                        </p>
                        <hr>
                        <strong>Pembayaran Iuran Terakhir:</strong>
                        <p class="text-muted">
                            {{$nisan->pembayaran_terakhir}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
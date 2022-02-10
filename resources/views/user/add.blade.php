@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/user">User</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if (Auth::user() && Auth::user()->name == 'admin')
                <form action="{{ url('/user/store') }}" method="post" style="display:inline-block;">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @method('POST')
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Email: </label>
                                <input type="text" required="required" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama: </label>
                                <input type="text" required="required" name="name" placeholder="Nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password: </label>
                                <input type="password" required="required" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password: </label>
                                <input type="password" required="required" name="password_confirmation" placeholder="Password" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-success" style="width:120px;" onclick="return confirm('Simpan data ini?')">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
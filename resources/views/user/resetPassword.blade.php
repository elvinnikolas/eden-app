@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reset Password</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/user">User</a></li>
                    <li class="breadcrumb-item active">Password</li>
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
                @if (Auth::user()->name == 'admin')
                <form action="{{ url('/user/reset') }}" method="get" style="display:inline-block;">
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

                    @method('GET')
                    <div class="card card-primary">
                        <div class="card-body">
                            <input type="hidden" name="name" value="{{ $user->name }}" class="form-control">
                            <div class="form-group">
                                <label>Password Baru: </label>
                                <input type="password" required="required" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password: </label>
                                <input type="password" required="required" name="password_confirmation" placeholder="Password" class="form-control">
                            </div>
                            <br>
                            <button class="btn btn-success" style="width:120px;" onclick="return confirm('Konfirmasi ubah password?')">Simpan</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#Tipe').select2();
    });
</script>
@endpush
@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
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
    <div class="container-fluid">
        <br>
        @if (Auth::user() && Auth::user()->name == 'admin')
        <a href="{{ url('/user/add')}}" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
            <b>Tambah User</b>
        </a>
        @endif
        <br><br>
        <table class="table table-light" id="table">
            <thead class="thead-light">
                <tr>
                    <th>Email</th>
                    <th>Nama</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        @if (Auth::user()->name == 'admin' && $user->name !== 'admin')
                        <a href="{{ url('/user/reset/'. $user->name )}}" class="btn-sm btn btn-primary">
                            <i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;Reset password
                        </a>
                        @endif
                        @if ((Auth::user()->name == 'admin' && Auth::user()->email == $user->email) || (Auth::user()->name !== 'admin' && Auth::user()->email == $user->email))
                        <a href="{{ url('/user/change/'. $user->name )}}" class="btn-sm btn btn-primary">
                            <i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;Ubah password
                        </a>
                        @endif
                        @if (Auth::user()->name == 'admin')
                        @if ($user->name !== 'admin')
                        <a href="{{ url('/user/destroy/'.$user->name )}}" class="btn-sm btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?')">
                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Hapus
                        </a>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#tanggal').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tanggalsampai').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    $('#table').DataTable({
        "order": [
            [0, "asc"]
        ]
    });
</script>
@endpush
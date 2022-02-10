@extends('index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Backup</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Backup</li>
                </ol>
            </div>
        </div>
    </div>
    <br>
</section>

<!-- Alert -->
@if(session()->get('created'))
<div class="alert alert-success alert-dismissible fade-show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session()->get('created') }}
</div>
@endif

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <br>
        <a href="{{ url('/backup/create')}}" class="btn btn-primary">
            <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Backup Data
        </a>
    </div>
</section>

@endsection

@push('scripts')
@endpush
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Log;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }

    public function create()
    {
        Artisan::call('backup:run');

        $pesan = 'Data berhasil dibackup';
        return redirect('/backup')->with(['created' => $pesan]);
    }
}

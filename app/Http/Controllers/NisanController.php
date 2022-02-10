<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nisan;
use Carbon\Carbon;
use DB;
use DataTables;

class NisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, 'id_ID');
        $data = Nisan::latest()->where('deleted_at', '=', null)->get();
        foreach ($data as $key => $value) {
            $value->tanggal = Carbon::parse($value->tanggal)->format('d M Y');
            $value->pembayaran_terakhir = Carbon::parse($value->pembayaran_terakhir)->format('M Y');
        }

        return view('nisan.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nisan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $foto = $request->file('foto');
            $path = $foto->store('public/images');
            $foto_name = str_replace('public/images/', '', $path);
            $foto->move('images', $foto_name);
            \Storage::delete('public/images/' . $foto_name);

            $tanggal_iuran = $request->pembayaran_terakhir . '/01';
            DB::table('nisans')->insert([
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'gereja' => $request->gereja,
                'blok_nomor_nisan' => $request->blok_nomor_nisan,
                'nama_nomor_keluarga' => $request->nama_nomor_keluarga,
                'email' => $request->email,
                'pembayaran_terakhir' => $tanggal_iuran,
                'image' => $foto_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } else {
            $tanggal_iuran = $request->pembayaran_terakhir . '/01';
            DB::table('nisans')->insert([
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'gereja' => $request->gereja,
                'blok_nomor_nisan' => $request->blok_nomor_nisan,
                'nama_nomor_keluarga' => $request->nama_nomor_keluarga,
                'email' => $request->email,
                'pembayaran_terakhir' => $tanggal_iuran,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        $pesan = 'Data ' . $request->nama . ' berhasil ditambahkan';
        return redirect('/nisan')->with(['created' => $pesan]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        setlocale(LC_TIME, 'id_ID');
        $nisan = DB::table('nisans')->where('id', $id)->first();
        $nisan->tanggal = Carbon::parse($nisan->tanggal)->format('d M Y');
        $nisan->pembayaran_terakhir = Carbon::parse($nisan->pembayaran_terakhir)->format('M Y');
        return view('nisan.show', ['nisan' => $nisan]);
    }

    public function filter_name(Request $request)
    {
        $name = $request->get('name');

        $data = DB::select("SELECT * 
            FROM nisans n
            WHERE n.deleted_at is null
            AND n.nama LIKE '" . $name . "%'
            ORDER BY n.nama ASC
        ");

        foreach ($data as $key => $value) {
            $value->tanggal = Carbon::parse($value->tanggal)->format('d M Y');
            $value->pembayaran_terakhir = Carbon::parse($value->pembayaran_terakhir)->format('M Y');
        }

        return view('nisan.index', [
            'data' => $data,
            'name' => $name
        ]);
    }

    public function filter_year(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $data = DB::select("SELECT * 
            FROM nisans n
            WHERE n.deleted_at is null
            AND YEAR(n.Tanggal) BETWEEN '" . $start . "' AND '" . $end . "'
            ORDER BY n.Tanggal ASC
        ");

        foreach ($data as $key => $value) {
            $value->tanggal = Carbon::parse($value->tanggal)->format('d M Y');
            $value->pembayaran_terakhir = Carbon::parse($value->pembayaran_terakhir)->format('M Y');
        }

        return view('nisan.index', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nisan = DB::table('nisans')->where('id', $id)->first();
        return view('nisan.edit', ['nisan' => $nisan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nisan  $nisan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->file('foto')) {
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $foto = $request->file('foto');
            $path = $foto->store('public/images');
            $foto_name = str_replace('public/images/', '', $path);
            $foto->move('images', $foto_name);
            \Storage::delete('public/images/' . $foto_name);

            $tanggal_iuran = $request->pembayaran_terakhir . '/01';
            DB::table('nisans')->where('id', $request->id)->update([
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'gereja' => $request->gereja,
                'blok_nomor_nisan' => $request->blok_nomor_nisan,
                'nama_nomor_keluarga' => $request->nama_nomor_keluarga,
                'email' => $request->email,
                'pembayaran_terakhir' => $tanggal_iuran,
                'image' => $foto_name,
                'updated_at' => Carbon::now()
            ]);
        } else {
            $tanggal_iuran = $request->pembayaran_terakhir . '/01';
            DB::table('nisans')->where('id', $request->id)->update([
                'nomor' => $request->nomor,
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'gereja' => $request->gereja,
                'blok_nomor_nisan' => $request->blok_nomor_nisan,
                'nama_nomor_keluarga' => $request->nama_nomor_keluarga,
                'email' => $request->email,
                'pembayaran_terakhir' => $tanggal_iuran,
                'updated_at' => Carbon::now()
            ]);
        }

        $pesan = 'Data ' . $request->nama . ' berhasil diubah';
        return redirect('/nisan')->with(['edited' => $pesan]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nisan  $nisan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nisan = Nisan::find($id);
        $nisan->deleted_at = Carbon::now();
        $nisan->save();

        $pesan = 'Data ' . $nisan->nama . ' berhasil dihapus';
        return redirect('/nisan')->with(['deleted' => $pesan]);
    }
}

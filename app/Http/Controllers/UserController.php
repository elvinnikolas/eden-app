<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('user.index', compact('users'));
    }

    public function add()
    {
        return view('user.add');
    }

    public function showreset($id)
    {
        $user = DB::table('users')->where('name', $id)->first();
        return view('user.resetPassword', compact('user'));
    }

    public function showchange($id)
    {
        $user = DB::table('users')->where('name', $id)->first();
        return view('user.changePassword', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'name' => 'required|unique:users',
            'password' => 'confirmed|min:6',
        ]);

        DB::table('users')->insert([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $pesan = 'User ' . $request->name . ' berhasil ditambahkan';
        return redirect('/user')->with(['created' => $pesan]);
    }

    public function reset(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6',
        ]);

        DB::table('users')->where('name', $request->name)->update([
            'password' => Hash::make($request->password)
        ]);

        $pesan = 'Password user ' . $request->name . ' berhasil diubah';
        return redirect('/user')->with(['edited' => $pesan]);
    }

    public function change(Request $request)
    {
        $user = DB::table('users')->where('name', $request->name)->first();
        $check = Hash::check($request->password, $user->password);

        if ($check == true) {
            $this->validate($request, [
                'newpassword' => 'confirmed|min:6',
            ]);

            DB::table('users')->where('name', $request->name)->update([
                'password' => Hash::make($request->newpassword)
            ]);

            $pesan = 'Password berhasil diubah';
            return redirect('/user')->with(['edited' => $pesan]);
        } else {
            $pesan = 'Password lama tidak sesuai';
            return redirect('/user')->with(['deleted' => $pesan]);
        }
    }

    public function destroy($id)
    {
        DB::table('users')->where('name', $id)->delete();

        $pesan = 'User ' . $id . ' berhasil dihapus';
        return redirect('/user')->with(['deleted' => $pesan]);
    }
}

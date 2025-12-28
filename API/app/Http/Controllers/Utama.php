<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mdata;
use Illuminate\Support\Facades\Hash;


class Utama extends Controller
{

public function login(Request $z)
{
    // Tangkap input manual dan trim
    $username = ($z->input('usernamex'));
    $password = ($z->input('passwordx'));

    // Cek input kosong
    if (!$username || !$password) {
        return response()->json([
            'kode' => "00",
            'message' => 'Username dan password wajib diisi'
        ], 422);
    }

    // Ambil user dari database
    $model = new Mdata();
    $user = $model->cekLogin($username);

    if (!$user) {
        return response()->json([
            'kode' => "00",
            'message' => 'Username tidak ditemukan'
        ], 401);
    }

    // Cek password hash
    if (!Hash::check($password, $user->password)) {
        return response()->json([
            'kode' => "00",
            'message' => 'Password salah'
        ], 401);
    }

    // Login berhasil
    return response()->json([
        'kode' => "01",
        'message' => 'Login berhasil',
        'data' => [
            'id_pengguna' => $user->id_pengguna,
            'username'    => $user->username,
            'role'        => $user->role
        ]
    ]);
}

}
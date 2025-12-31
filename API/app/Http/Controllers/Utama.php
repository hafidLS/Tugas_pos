<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mdata;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Utama extends Controller
{
    public function login(Request $z)
    {
        $username = $z->input('usernamex');
        $password = $z->input('passwordx');

        if (!$username || !$password) {
            return response()->json([
                'kode' => "00",
                'message' => 'Username dan password wajib diisi'
            ], 422);
        }

        $model = new Mdata();
        $user = $model->cekLogin($username);

        if (!$user) {
            return response()->json([
                'kode' => "00",
                'message' => 'Username tidak ditemukan'
            ], 401);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'kode' => "00",
                'message' => 'Password salah'
            ], 401);
        }

        // generate token
        $token = Str::random(60);

        // simpan token + expired
        $user->api_token = hash('sha256', $token);
        $user->token_expired_at = now()->addHours(1);
        $user->save();

        return response()->json([
            'kode' => "01",
            'message' => 'Login berhasil',
            'token' => $token,
            'expired_at' => $user->token_expired_at,
            'data' => [
                'id_pengguna' => $user->id_pengguna,
                'username'    => $user->username,
                'role'        => $user->role
            ]
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mdata extends Model
{
  

public function cekLogin($username)
{
    return DB::table('pengguna')
        ->select('id_pengguna', 'username', 'role', 'password')
        ->where('username', $username)
        ->first();
}

}
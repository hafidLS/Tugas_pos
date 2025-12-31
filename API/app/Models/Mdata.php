<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mdata extends Model
{
  
protected $table = 'pengguna';      
    protected $primaryKey = 'id_pengguna';
    public $timestamps = false;

public function simpanToken($id, $token)
{
    return $this->where('id_pengguna', $id)
                ->update(['api_token' => $token]);
}
 public function cekLogin($username)
    {
        return $this->where('username', $username)->first();
    }

}
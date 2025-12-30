<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'username',
        'password',
        'api_token',
        'token_expired_at'
    ];

    protected $hidden = [
        'password',
        'api_token'
    ];

    public $timestamps = false;
}

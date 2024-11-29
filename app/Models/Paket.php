<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'pakets';

    // Set the primary key column name
    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'nama_paket',
        'harga',
        'fitur',
    ];
}


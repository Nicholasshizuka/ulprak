<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapans';

    protected $fillable = [
        'id_pesanan',
        'tgl_tanggapan',
        'tanggapan',
        'user_id',
    ];
    

    // Correct the relationship
    public function pesanans()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan'); // Use 'id_pesanan' instead of 'pesanan_id'
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


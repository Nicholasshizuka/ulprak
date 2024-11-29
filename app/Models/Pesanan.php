<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan'; // Primary key yang benar
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'id_paket',
        'detail',
        'tgl_pesanan',
        'foto',
        'status',
    ];
    

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Paket
     */
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pesanan');
    }


}

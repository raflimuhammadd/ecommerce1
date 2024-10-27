<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['users_id', 'status', 'no_telepon', 'total'];

    // Relasi dengan tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tabel detail_transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}

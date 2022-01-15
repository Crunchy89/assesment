<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = ['nama', 'tanggal_masuk', 'total_gaji'];
    protected $hidden = ['created_at', 'updated_at', 'id'];
    protected $casts = [
        'tanggal_masuk'  => 'date:d/m/Y',
        'nama'           => 'string:nama',
        'total_gaji'     => 'string:total_gaji'
    ];
    public function getNamaAttribute($value)
    {
        return strtoupper(explode(' ', $value)[0]);
    }
    public function getTotalGajiAttribute($value)
    {
        $hasil_rupiah = number_format($value, 0, ',', '.');
        return $hasil_rupiah;
    }
}

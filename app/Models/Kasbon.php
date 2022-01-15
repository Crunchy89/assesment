<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasbon extends Model
{
    use HasFactory;
    protected $table = 'kasbon';
    protected $fillable = ['tanggal_diajukan', 'tanggal_disetujui', 'pegawai_id', 'total_kasbon'];
    protected $hidden = ['created_at', 'updated_at', 'pegawai_id', 'id'];
    protected $appends = ['nama_pegawai'];
    protected $casts = [
        'tanggal_diajukan' => 'date:d/m/Y',
        'tanggal_disetujui' => 'date:d/m/Y',
        'total_kasbon' => 'string:total_kasbon',
    ];
    public function getTotalKasbonAttribute($value)
    {
        $hasil_rupiah = number_format($value, 0, ',', '.');
        return $hasil_rupiah;
    }
    public function getNamaPegawaiAttribute($value)
    {
        $pegawai = Pegawai::find($this->pegawai_id);
        return $pegawai->nama;
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktifitasMahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'tipe_aktifitas_mahasiswa_id',
        'label',
        'label_detail',
        'tanggal_mulai',
        'tanggal_selesai',
        'semester',
        'durasi',
        'file',
        'keterangan',
        'status',
        'validasi_user_id',
        'keterangan_validasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipe()
    {
        return $this->belongsTo(TipeAktifitasMahasiswa::class, 'tipe_aktifitas_mahasiswa_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validasi_user_id');
    }
}

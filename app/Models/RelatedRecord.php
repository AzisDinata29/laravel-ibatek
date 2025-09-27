<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelatedRecord extends Model
{
    protected $fillable = [
        'user_id',
        'organization_id',
        'kepaniitiaan_id',
        'magang_id',
        'tridharma_id',
        'lomba_id',
        'fakultas_id',
        'prodi_id',
        'ukm_id',
        'semester',
        'durasi',
        'bukti_file',
        'is_verified',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function kepaniitiaan(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Kepaniitiaan::class);
    }

    public function magang(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Magang::class);
    }

    public function tridharma(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tridharma::class);
    }

    public function lomba(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Lomba::class);
    }

    public function fakultas(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Fakultas::class);
    }

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Prodi::class);
    }

    public function ukm(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Ukm::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}

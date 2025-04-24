<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
  protected $table = 'jobs';

  protected $fillable = [
    'alumni_id',
    'nama_perusahaan',
    'jabatan',
    'bidang',
    'alamat_perusahaan',
    'tahun_masuk',
    'tahun_keluar',
    'pekerjaan_saat_ini'
  ];

  protected $casts = [
    'pekerjaan_saat_ini' => 'boolean'
  ];

  public function alumni(): BelongsTo
  {
    return $this->belongsTo(Alumni::class);
  }
}

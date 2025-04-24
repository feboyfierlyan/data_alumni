<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
  protected $table = 'educations';

  protected $fillable = [
    'alumni_id',
    'jurusan',
    'fakultas',
    'tahun_masuk',
    'tahun_lulus',
    'ipk'
  ];

  public function alumni(): BelongsTo
  {
    return $this->belongsTo(Alumni::class);
  }
}

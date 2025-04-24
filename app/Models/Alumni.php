<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
  protected $table = 'alumnis';

  protected $fillable = [
    'nama',
    'nim',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat',
    'email',
    'no_telepon',
    'foto'
  ];

  public function education(): HasOne
  {
    return $this->hasOne(Education::class);
  }

  public function jobs(): HasMany
  {
    return $this->hasMany(Job::class);
  }
}

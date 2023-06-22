<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kriteria',
        'kriteria',
        'jenis',
        'bobot_kriteria'
    ];

    public function sub_kriteria()
    {
        return $this->hasOne('App\Models\subKriteria', 'id_kriteria');
    }

    // public function detail()
    // {
    //     return $this->hasOne('App\Models\detail_alternatif', 'id_kriteria');
    // }
}

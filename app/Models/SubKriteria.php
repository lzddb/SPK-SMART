<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kriteria',
        'sub_kriteria',
        'bobot_sub'
    ];

    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'id_kriteria');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\detail_alternatif', 'id_sub');
    }

    // new

    /**
     * The alternatifs that belong to the SubKriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alternatifs(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\alternatif', 'detail_alternatifs', 'id_sub', 'id_alternatif');
    }
}

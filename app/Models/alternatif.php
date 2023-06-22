<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class alternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternatif'
    ];
    public function sub()
    {
        return $this->belongsToMany('App\Models\SubKriteria');
    }

    /**
     * The subKriteria that belong to the alternatif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subKriteria(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\SubKriteria', 'detail_alternatifs', 'id_alternatif', 'id_sub');
    }
}

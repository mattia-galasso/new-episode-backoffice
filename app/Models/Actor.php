<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'birth_date',
    ];

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class)->withPivot('role');
    }
}

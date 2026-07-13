<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class);
    }
}

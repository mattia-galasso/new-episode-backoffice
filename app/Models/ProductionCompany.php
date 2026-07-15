<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionCompany extends Model
{
    protected $fillable = [
        'name',
    ];

    public function tvSeries()
    {
        return $this->hasMany(TvSeries::class);
    }
}

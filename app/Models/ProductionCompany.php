<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionCompany extends Model
{
    public function tvSeries()
    {
        return $this->hasMany(TvSeries::class);
    }
}

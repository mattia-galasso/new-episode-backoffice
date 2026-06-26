<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvSeries extends Model
{
    // One to Many production_companies table
    public function productionCompany()
    {
        return $this->belongsTo(ProductionCompany::class);
    }

    // Many to Many genres table
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    // Many to Many platforms table
    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    // Many to Many actors table and role column on pivot table
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->withPivot('role');
    }
}

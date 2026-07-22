<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvSeries extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'original_language',
        'country',
        'start_year',
        'end_year',
        'status',
        'age_rating',
        'season_count',
        'poster',
        'banner',
        'trailer_youtube_id',
        'production_company_id',
    ];

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
        return $this->belongsToMany(Platform::class)
            ->withPivot('url');
    }

    // Many to Many actors table and role column on pivot table
    public function actors()
    {
        return $this->belongsToMany(Actor::class)->withPivot('role');
    }
}

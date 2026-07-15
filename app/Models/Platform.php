<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = [
        'logo_img',
        'name',
        'website',
    ];

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class)
            ->withPivot('url');
    }
}

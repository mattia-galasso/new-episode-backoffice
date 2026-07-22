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

    public function getBirthDateFormattedAttribute()
    {
        return $this->birth_date
            ? \Carbon\Carbon::parse($this->birth_date)->format('d/m/Y')
            : null;
    }

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class)->withPivot('role');
    }
}

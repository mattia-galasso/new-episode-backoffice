<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'photo',
        'name',
        'slug',
        'birth_date',
        'biography'
    ];

    protected $appends = [
        'birth_date_formatted',
        'age'
    ];

    public function getBirthDateFormattedAttribute()
    {
        return $this->birth_date
            ? \Carbon\Carbon::parse($this->birth_date)->format('d/m/Y')
            : null;
    }

    public function getAgeAttribute()
    {
        return $this->birth_date
            ? \Carbon\Carbon::parse($this->birth_date)->age
            : null;
    }

    public function tvSeries()
    {
        return $this->belongsToMany(TvSeries::class)->withPivot('role');
    }
}

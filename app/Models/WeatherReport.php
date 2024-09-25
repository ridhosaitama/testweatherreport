<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'weatherreport';
    protected $fillable = [
        'datetime',
        'datesave',
        'weather_main' ,
        'weather_description',
        'weather_icon',
        'temp',
        'temp_min',
        'temp_max',
        'feels_like',
        'pressure',
        'humidity',
        'wind_speed',
        'wind_degree',
    ];

}

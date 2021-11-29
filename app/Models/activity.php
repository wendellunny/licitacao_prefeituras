<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
        'status',
        'scheduled_date',
        'postponed_date' ,
        'city_hall_id',
    ];
}

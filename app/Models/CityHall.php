<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'razao_social',
        'id_city',
        'city',
        'estado',
        'address',
        'number',
        'district',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable =  [
        'contact',
        'contact_type',
        'city_hall_id',
    ];

    protected function CityHall(){
        return $this->hasOne(CityHall::class,'id','city_hall_id');
    }
}

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

    protected $statuses = [
        1 => 'Agendada',
        2 => 'Adiada',
        3 => 'Concluída',
        4 => 'Negada'
    ];

    protected $types = [
        1 => 'Ligação',
        2 => 'Visita'
    ];

    public function getStatusAttribute($status){
        return [
            'original' => $status,
            'formated' => $this->getStatus($status)
        ];  
    }

    protected function getStatus($status){
        return $this->statuses[$status];
    }

    public function getTypeAttribute($type){
        return [
            'original' => $type,
            'formated' => $this->getType($type)
        ];
    }

    public function getType($type){
        return $this->types[$type];
    }

    

    public function cityHall(){
        return $this->hasOne(CityHall::class,'id','city_hall_id');
    }
}

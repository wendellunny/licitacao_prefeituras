<?php

namespace App\Models;
use App\Traits\IBGE;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityHall extends Model
{
    use HasFactory;
    use IBGE;
    
    protected $fillable = [
        'social_reason',
        'id_city',
        'city',
        'estado',
        'address',
        'number',
        'district',
        'population',
        'status',
    ];

    protected static $statuses = [
        1 => 'Em Análise',
        2 => 'Ganha',
        3 => 'Não Ganha',
    ];

    public function getStatusAttribute($status){
        return [
            'original' => $status,
            'formated' =>self::getStatus($status)
        ];
    }
    
    protected static function getStatus($status){
        return self::$statuses[$status];
    }

    protected static function boot(){
        parent::boot();

        static::creating(function($cityHall){
            $dataCity = self::getDataCity($cityHall->id_city);

            $cityHall->city = $dataCity['city'];
            $cityHall->uf = $dataCity['uf']; 
            $cityHall->population = $dataCity['population'];
        });

        static::updating(function($cityHall){
            $dataCity = self::getDataCity($cityHall->id_city);

            $cityHall->city = $dataCity['city'];
            $cityHall->uf = $dataCity['uf']; 
            $cityHall->population = $dataCity['population'];
        });
    }

}

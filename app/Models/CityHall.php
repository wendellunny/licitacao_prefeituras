<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class CityHall extends Model
{
    use HasFactory;
    protected static $idCity = '';
    protected static $cityApiUrl = 'https://servicodados.ibge.gov.br/api/v1/localidades/municipios/';
    protected static $cityPopulationApiUrl = 'https://servicodados.ibge.gov.br/api/v3/agregados/6579/periodos/{$year}/variaveis/9324?localidades=N6[{$id_city}]';
    
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

    protected static function boot(){
        parent::boot();
        static::creating(function($cityHall){
            // dd($cityHall->id_city);
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

    protected static function getDataCity($id_city){
        
        $data = Http::get(self::$cityApiUrl . $id_city);
        $dataCity =  self::cleanDataCityApi($data->object());
        $dataCity['population']  = self::getCityPopulation($id_city);
        return $dataCity;
    }

    protected static function cleanDataCityApi($data){
       
        $dataClean = [
            'city' => $data->nome,
            'uf' => $data->microrregiao->mesorregiao->UF->nome
        ];

        return $dataClean;
    }

    protected static function getCityPopulation($id_city){
        $apiUrl = self::getPopulationApiUrlWithVariables($id_city);
        $population = Http::get($apiUrl);
        return self::cleanDataPopulation($population->object());
    }

    protected static function getPopulationApiUrlWithVariables($id_city){
        $apiUrl = str_replace('{$id_city}' , $id_city , self::$cityPopulationApiUrl);
        $year = Carbon::now()->format('Y');
        $apiUrl = str_replace('{$year}',$year,$apiUrl);
        return $apiUrl;
    }

    protected static function cleanDataPopulation($data){
        $year = Carbon::now()->format('Y');
        $population = $data[0]->resultados[0]->series[0]->serie->{$year};
        return $population;
    }


}

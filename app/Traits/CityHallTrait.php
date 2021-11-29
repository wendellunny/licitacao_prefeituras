<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

trait CityHallTrait{
    
    protected static function getDataCity($id_city){
        $data = Http::get( CITY_API_URL . $id_city );
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
        $apiUrl = str_replace('{$id_city}' , $id_city , CITY_POPULATION_API_URL);
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
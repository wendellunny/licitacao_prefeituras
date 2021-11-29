<?php

namespace App\Http\Controllers;

use App\Models\CityHall;
use Exception;
use Illuminate\Http\Request;

class CityHallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $cityHalls = CityHall::with('contacts')->orderBy('social_reason','asc')->get();
            return response()->json(['data' => $cityHalls]);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $cityHall = CityHall::create($request->all());
            $cityHall->contacts()->create($request->all());
            return response()->json(['success' => 'Prefeitura registrada com sucesso']);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $cityHall = CityHall::find($id);
            $cityHall->update($request->all());
            return response()->json(['success'=>'Prefeitura Atualizada com sucesso']);
        }catch(Exception $e){
            return response()->json(['erro'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cityHall = CityHall::find($id);
            $cityHall->delete();
            return response()->json(['success'=>'Prefeitura deletada com sucesso']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CityHall;
use Exception;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $activities = Activity::with('cityHall')->orderBy('scheduled_date','desc')
            ->orderBy('status','asc')
            ->orderBy('id','desc')
            ->paginate(12);

            return response()->json(['data' => $activities]);
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
            Activity::create($request->all());
            return response()->json(['success' => 'Atividade registrada com Sucesso']);
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
        try{
            $activity = Activity::with('cityHall')->find($id);
            return response()->json(['data'=>$activity]);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
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
            $activity = Activity::find($id);
            $activity->update($request->all());
            return response()->json(['success' => 'Atividade Atualizada com Sucesso']);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
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
            $activity = Activity::find($id);
            $activity->delete();
            return response()->json(['success' => 'Atividade Delet com sucesso']);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function setStatus(Request $request,$id){
        try{
            $status = $request->status;
            $activity = Activity::find($id);
            $activity->status = $status;
            $activity->save();
            return response()->json(['success'=>'Status Atualizado Com Sucesso']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function setSatisfaction(Request $request,$id){
        try{
            $satisfaction = $request->status;
            $cityHall = CityHall::find($id);
            $cityHall->status = $satisfaction;
            $cityHall->save();
            return response()->json(['success'=>'Satisfação Atualizado Com Sucesso']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    public function setType(Request $request,$id){
        try{
            $type = $request->type;
            $activity = Activity::find($id);
            $activity->type = $type;
            $activity->save();
            return response()->json(['success'=>'Type Atualizado Com Sucesso']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}

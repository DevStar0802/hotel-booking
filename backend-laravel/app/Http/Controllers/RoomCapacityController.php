<?php

namespace App\Http\Controllers;

use App\Models\RoomCapacity;
use Illuminate\Http\Request;

class RoomCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoomCapacity::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate(['name' => 'required']);
      return RoomCapacity::create(['name'=> $request->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomCapacity  $roomCapacity
     * @return \Illuminate\Http\Response
     */
    public function show(RoomCapacity $roomCapacity)
    {
        return $roomCapacity;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomCapacity  $roomCapacity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomCapacity $roomCapacity)
    {
        $request->validate(['name' => 'required']);
        $roomCapacity->name = $request->name;
        $roomCapacity->save();
        return ['response' => "room capacity saved succesfully"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomCapacity  $roomCapacity
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomCapacity $roomCapacity)
    {
        $roomCapacity->delete();
        return ['response' => "room capacity deleted succesfully"];
    }
}

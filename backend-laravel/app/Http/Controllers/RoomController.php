<?php

namespace App\Http\Controllers;

use Validator;
use App\Helpers\Img;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Room::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Room::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        $room = new Room();
        $room->fill($request->all());
        $room->image = Img::save($request->image, '/rooms');
        $room->save();
        return $room;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return $room;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), Room::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        $room->fill($request->except('image'));
        if($room->image!=$request->image){
          $image = Img::saveAndDelete($request->image, $room->image, '/rooms');
          if(!empty($image)) $room->image = $image;
        }
        $room->save();

        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return ['response' => "room deleted succesfully"];
    }
}

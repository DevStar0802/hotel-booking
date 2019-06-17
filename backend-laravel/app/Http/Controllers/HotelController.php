<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Helpers\Img;
use Validator;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function show(){
      //right now we have just one hotel, but this could have a parameter for hotel.
      return Hotel::find(1);
    }

//HotelUpdateRequest
    public function update(Request $request){
      $validator = Validator::make($request->all(), ["image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",]);
      if ($validator->fails()) {
          return response()->json($validator->messages(), 200);
      }
      //right now we have just one hotel, but this could have a parameter for hotel.
      $hotel = Hotel::find(1);
      $hotel->image = Img::saveAndDelete($request->image, $hotel->image, '/hotel');
      //fill other fields.
      $hotel->fill($request->except('image'));
      $hotel->save();
      return ['response' => "hotel saved succesfully"];
    }
}

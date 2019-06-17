<?php

namespace App\Http\Controllers;

use App\Hotel;
use Storage;
use App\Http\Requests\HotelUpdateRequest;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function show(){
      //right now we have just one hotel, but this could have a parameter for hotel.
      return Hotel::find(1);
    }

//HotelUpdateRequest
    public function update(Request $request){
      //right now we have just one hotel, but this could have a parameter for hotel.
      $hotel = Hotel::find(1);
      //image handler
      if($request->image){
        //deleting if exist old.
        if($hotel->image){
          $image = str_replace('/storage', '/public', $hotel->image);
          Storage::delete($image);
        }
        //upload image
        $image = Storage::put('/public/images/hotel', $request->image);
        $image = str_replace('/public', '/storage', $image);
        $hotel->image = $image;
      }
      //fill other fields.
      $hotel->fill($request->except('image'));
      $hotel->save();
      return ['response' => "hotel saved succesfully"];
    }
}

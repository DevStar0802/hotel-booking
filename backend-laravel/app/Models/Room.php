<?php

namespace App\Models;

use App\Models\RoomCapacity;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'name', 'room_type_id', 'room_capacity_id', 'image'
    ];
    const VALIDATOR_OPTIONS = [
      'name' => 'required',
      'room_type_id' => 'required|integer|min:1',
      'room_capacity_id' => 'required|integer|min:1',
      "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
    ];

    /*relationships*/
    public function type(){
      return $this->belongsTo(RoomType::class, 'room_type_id');
    }
    public function capacity(){
      return $this->belongsTo(RoomCapacity::class, 'room_capacity_id');
    }
    public function price(){
      return "550";
    }

    /*scopes*/
    public function scopeRoomType($query, $scope){
      if (!empty($scope)) {
        $query->where('room_type_id', $scope);
      }
    }

    public static function filtered($datos){
      return self::roomType(isset($datos['room_type_id'])?$datos['room_type_id']:null);
    }
}

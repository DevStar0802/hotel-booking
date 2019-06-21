<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $appends = ['dynamic'];
    protected $fillable = [
      'name',
      'price',
      'room_type_id',
      'room_capacity_id',
      'day',
      'start_date',
      'end_date'
    ];
    const VALIDATOR_OPTIONS= [
      'name' => 'required',
      'room' => 'integer|min:1',
      'price' => 'required|numeric',
      'room_type_id' => 'required|integer|min:1',
      'room_capacity_id' => 'required|integer|min:1',
      'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday,all',
      'start_date' => 'date',
      'end_date' => 'date'
    ];

    /*atributes*/
    public function getDynamicAttribute(){
      if($this->start_date && $this->end_date)
        return true ;
      else
        return false;
    }

    /*scopes*/
    public function scopeRoomCapacity($query, $scope){
      if (!empty($scope)) {
        $query->where('room_capacity_id', $scope);
      }
    }
    public function scopeRoomType($query, $scope){
      if (!empty($scope)) {
        $query->where('room_type_id', $scope);
      }
    }

    public function scopeDate($query, $scope){
      if (!empty($scope)) {
        // for day of week
        try {
            $day = strtolower(date('l', strtotime($scope)));
        } catch (\Exception $e) {
          $day = '';
        }
        if(!empty($day) && $day!='all'){
          $query->where(function($query) use ($day){
            $query->where('day', $day)->orWhere('day', 'all');
          });
        }


        // !for day of week
        // for range of dates
        $query->where(function ($query) use($scope) {
            $query->where('start_date', '<=', $scope)
                ->where('end_date', '>=', $scope)
                ->orWhereNull('start_date');
        });
        //dd($query->toSql());
        //!for range of dates
      }
    }


    public static function filtered($datos){
      return self::roomCapacity(isset($datos['room_capacity_id'])?$datos['room_capacity_id']:null)
      ->roomType(isset($datos['room_type_id'])?$datos['room_type_id']:null)
      ->date(isset($datos['date'])?$datos['date']:null);
    }
}

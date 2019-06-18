<?php

namespace App\Helpers;
use Storage;

class Img{
  //firs parameter Image to save
  //second parameter folder to save.
  public static function save($image = '', $path = ''){
    $img = '';
    if(!empty($image)){
      //upload image
      $img = Storage::put('/public/images'.$path, $image);
      $img = str_replace('public/', 'storage/', $img);
    }
    return $img;
  }

  //firs parameter image to delete
  public static function delete($image){
    if(!empty($image)){
      $image = str_replace('storage/', 'public/', $image);
      Storage::delete($image);
    }
  }

  //firs parameter Image to save
  //second parameter imagen to delete
  //third parameter folder to save.
  public static function saveAndDelete($image = '', $old = '', $path = ''){
    $img = '';
    if(!empty($image)){
      //deleting if exist old.
      self::delete($old);
      //upload image
      $img = Storage::put('/public/images'.$path, $image);
      $img = str_replace('public/', 'storage/', $img);
    }
    return $img;
  }
}

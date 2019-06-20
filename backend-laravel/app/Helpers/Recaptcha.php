<?php

namespace App\Helpers;
use GuzzleHttp\Client;

class Recapcha {
  public static function validate($token){
    $token = $token;
    $client = new Client();
    $res = $client->post('https://www.google.com/recaptcha/api/siteverify', [
      'multipart' => [
      [
          'name'     => 'secret',
          // public 6LcxyKkUAAAAAH67c2dmQDkHsE35tI-jeWWfcOJG
          'contents' => '6LcxyKkUAAAAAL0bSpNiaP0b0cC70JH0FFSjWAcu'
      ],
      [
          'name'     => 'response',
          'contents' => $token
      ]
    ]]);
    $body = $res->getBody();
    $resultado = json_decode($body->getContents());
    if($resultado->success){
      return true;
    } else {
      return false;
    }
  }
}

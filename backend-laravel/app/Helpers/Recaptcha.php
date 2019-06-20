<?php

namespace App\Helpers;
//use GuzzleHttp\Client;

class Recaptcha {
  public static function validate($token){
    $data = array(
            'secret' => "6LcxyKkUAAAAAL0bSpNiaP0b0cC70JH0FFSjWAcu",
            'response' => $token
        );

    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    try {
        $response = json_decode($response);
    } catch (\Exception $e) {
      $response = json_decode(json_encode(["success" => false]));
    }
    if($response->success){
      return true;
    } else {
      return false;
    }

  }

  /*
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
  */
}

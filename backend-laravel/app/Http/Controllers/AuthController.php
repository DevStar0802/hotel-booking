<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
  /**
   * Create user
   *
   * @param  [string] name
   * @param  [string] email
   * @param  [string] password
   * @param  [string] password_confirmation
   * @return [string] message
   */
  public function signup(Request $request)
  {
      $validator = Validator::make($request->all(), [
        //'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed',
        //'token' => 'required'
      ]);
      if ($validator->fails()) {
          return response()->json(["errors" => $validator->messages()], 200);
      }

      //if(!Recaptcha::validate($request->token)) return response()->json(["errors" => ["recaptcha" => "error con recaptcha"]], 200);

      try {
        $user = new User([
            'name' => "New User",
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
      } catch (\Exception $e) {
          return ['exception' => $e->getMessage()];
      }
      return response()->json([
          'registered' => 'Successfully created user!'
      ], 200);
  }

  /**
   * Login user and create token
   *
   * @param  [string] email
   * @param  [string] password
   * @param  [boolean] remember_me
   * @return [string] access_token
   * @return [string] token_type
   * @return [string] expires_at
   */
  public function login(Request $request)
  {
      $validator = Validator::make($request->all(), [
        //'name' => 'required|string',
        'email' => 'required|string|email',
        'password' => 'required|string',
        //'token' => 'required'
      ]);
      if ($validator->fails()) {
          return response()->json(["errors" => $validator->messages()], 200);
      }
      //validate recaptcha
      //if(!Recaptcha::validate($request->token)) return response()->json(["errors" => ["recaptcha" => "error con recaptcha"]], 200);

      try {
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

      } catch (\Exception $e) {
          return ['exception' => $e->getMessage()];
      }

      return response()->json([
          "logged" => [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]
      ]);
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */
  public function logout(Request $request)
  {
      $request->user()->token()->revoke();

      return response()->json([
          'great' => 'Successfully logged out'
      ]);
  }

  /**
   * Get the authenticated User
   *
   * @return [json] user object
   */
  public function user(Request $request)
  {
      return response()->json($request->user());
  }

}

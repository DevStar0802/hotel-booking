<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use App\Models\Customer;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Booking::filtered($request->all())->get();
    }

    public function addBooking(Request $request){
      $validator = Validator::make($request->all(), Booking::VALIDATOR_OPTIONS_BOOKING);
      if ($validator->fails()) {
          return response()->json(["errors" => $validator->messages()], 200);
      }

      try {

        if($request->customer['id'] == 0){
          $user = User::create([
            'name' => 'new User',
            'email' => $request->customer['email'],
            'password' => bcrypt('password'), // password
          ]);
        } else{
            $user = User::find($request->customer['id']);
        }

        if(!empty($request->customer['customer_id'])){
            $customer = Customer::find($request->customer['customer_id']);
            $customer->fill($request->customer);
            $customer->save();
        } else {
            $customer = new Customer();
            $data = $request->customer;
            unset($data['id']);
            $customer->fill($request->customer);
            //return $customer;
            $customer->user_id = $user->id;
            $customer->save();
            $user->customer_id = $customer->id;
            $user->save();
        }

        $booking = Booking::create([
          'room_id'=> $request->room['id'],
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'customer_id' => $customer->id,
        ]);

        return ['response' => "booking added succesfully"];

      } catch (\Exception $e) {
          return response()->json(["errors" => ["save_error" => $e->getMessage()]], 200);
      }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Booking::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        return Booking::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return $booking;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $validator = Validator::make($request->all(), Booking::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        $booking->fill($request->all());
        $booking->save();
        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        try {
          $booking->delete();
        } catch (\Exception $e) {
          return ['exception' => $e->getMessage()];
        }
        return ['response' => "booking deleted succesfully"];
    }
}

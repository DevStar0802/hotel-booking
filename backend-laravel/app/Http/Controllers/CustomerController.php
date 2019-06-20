<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Customer::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        $customer = Customer::create($request->all());

        if($request->user_id && $request->user_id>0){
          $user = $customer->user;
          $user->customer_id = $customer->id;
          $user->save();
        }

        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), Customer::VALIDATOR_OPTIONS);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->messages()], 200);
        }
        $customer->fill($request->all());
        $customer->save();
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
          $customer->delete();
        } catch (\Exception $e) {
          return ['exception' => $e->getMessage()];
        }
        return ['response' => "customer deleted succesfully"];
    }
}

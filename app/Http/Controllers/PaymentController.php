<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function Payment(Request $request){

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;
       //dd($data);check

       if($request->payment == 'stripe'){

        return view('pages.payment.stripe',compact('data'));




       }elseif($request->payment == 'paypal'){

       }elseif($request->payment == 'ideal'){

       }else{
           echo"Cash OnDelivery";
       }

    }


       public function StripeCharge(Request $request){

        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51IsjHVCP2WwnNwTTU7bVyZTvJHHiWoRZxijJiLkCUcpwyA16R8X62THX4BiDnq55mQc2zZ5u99r1JqohofgRkaAY00FXvISoVs');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'usd',
        'description' => 'Udemy Ecommerce Details',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);
        dd($charge);
       }

        
    
}

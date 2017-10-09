<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\FreeCheckoutRequest;
use App\Jobs\Checkout\CreateSale;
use Illuminate\Http\Request;
use Stripe\Charge;
use App\User;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //User::find(2)->stripe_id;
        //dd(session('stripe_seller_public_key'));



        //return view('account.marketplace.index');

        return view('payment.index');
    }


    public function free(FreeCheckoutRequest $request, File $file)
    {
        if (!$file->isFree()) {
            return back();
        }

        dispatch(new CreateSale($file, $request->email));

        return back()->withSuccess('We\'ve emailed your download link to you.');
    }

    public function payment(Request $request)
    {
      //  return response()->json($request, 201);
        //dd($request->stripeToken);
        try {
            $charge = Charge::create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $request->payment_token,
                'application_fee' => $this->calculateCommission($request->amount) * 100
            ], [
                'stripe_account' => 'acct_1AqwpjGDepf40Qma'
            ]);
        } catch (Exception $e) {
            //return back()->withError('Something went wrong while processing your payment.');
            return response()->json([], 422);
        }

        //dispatch(new CreateSale($file, $request->stripeEmail));

        //return back()->withSuccess('Payment complete. We\'ve emailed your download link to you.');
            return response()->json([], 201);
    }

    public function calculateCommission($amount)
    {
        return ( 35 / 100) * ($amount / 100);
    }
}

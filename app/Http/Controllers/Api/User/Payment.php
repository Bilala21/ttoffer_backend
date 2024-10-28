<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Payment as PT;
use App\Models\Product;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use Stripe\Customer;
use Session;
use JWTAuth;

class Payment extends Controller
{
    public function google_pay(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'        => 'required|exists:product,id',
            'number_of_days'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        };

        $data = $request->except('product_id','number_of_days');
        $data['user_id'] = JWTAuth::user()->id;
        $pay = PT::create($data);
        $product = Product::find($request->product_id);
        $product->booster_start_datetime = date('Y-m-d H:i:s');
        $product->booster_end_datetime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+'.$request->number_of_days.'days'));
        $product->save();
        return $this->sendResponse($pay,'Payment Successfully.');
    }

    public function charge(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'amount'            => 'required',
            'currency'          => 'required',
            'token'             => 'required_without_all:customer_id',
            'customer_id'       => 'required_without_all:token',
            'save'              => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        };

        $data = $request->all();

        Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

        if(!isset($request->customer_id) && $request->save == 1){
            $customer = Customer::create([
                'source' => $data['token'], // The card token from Stripe.js
            ]);
            $data['customer_id'] = $customer->id;
        }

        try {
            // Create a charge
            if(isset($data['customer_id'])){
                $payment =  Charge::create([
                    'amount' => $data['amount']*100, // Amount in cents
                    'currency' => $data['currency'],
                    'customer' => $data['customer_id'],
                    // 'source' => $data['token'],
                    'description' => $request->description,
                ]);
            }else{
                $payment =  Charge::create([
                    'amount' => $data['amount']*100, // Amount in cents
                    'currency' => $data['currency'],
                    // 'customer' => $data['customer_id'],
                    'source' => $data['token'],
                    'description' => $request->description,
                ]);
            }
            if($payment)
            {
                $input['user_id'] = JWTAuth::user()->id;
                if(isset($data['customer_id'])){
                    $input['customer_id'] = $data['customer_id'];
                }else{
                    $input['token'] = $data['token'];
                }
                $input['transaction_id'] = $payment->source->id;
                $input['amount'] = $data['amount'];
                $input['currency'] = $data['currency'];
                // $input['token'] = $data['token'];
                $input['last_four'] = $payment->source->last4;
                $input['description'] = $request->description;
                $input['receipt_url'] = $payment->receipt_url;
                $input['status'] = $payment->status;
                $input['brand'] = $payment->source->brand;
                $pay = PT::create($input);
                return $this->sendResponse($pay,'Payment Successfully.');
            }else{
                return $this->sendError('Something Went wrong',[],401);
            }
            // Payment successful
            // return response()->json(['message' => 'Payment successful']);
        } catch (\Exception $e) {
            // Payment failed
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function sell_faster(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_id'        => 'required|exists:product,id',
            'number_of_days'    => 'required',
            'amount'            => 'required',
            'currency'          => 'required',
            'token'             => 'required_without_all:customer_id',
            'customer_id'       => 'required_without_all:token',
            'save'              => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => $validator->errors(),
            ], 401);
        };

        $data = $request->all();

        Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

        if(!isset($request->customer_id) && $request->save == 1){
            $customer = Customer::create([
                'source' => $data['token'], // The card token from Stripe.js
            ]);
            $data['customer_id'] = $customer->id;
        }

        try {
            // Create a charge
            if(isset($data['customer_id'])){
                $payment =  Charge::create([
                    'amount' => $data['amount']*100, // Amount in cents
                    'currency' => $data['currency'],
                    'customer' => $data['customer_id'],
                    // 'source' => $data['token'],
                    'description' => $request->description,
                ]);
            }else{
                $payment =  Charge::create([
                    'amount' => $data['amount']*100, // Amount in cents
                    'currency' => $data['currency'],
                    // 'customer' => $data['customer_id'],
                    'source' => $data['token'],
                    'description' => $request->description,
                ]);
            }
            if($payment)
            {
                $input['user_id'] = JWTAuth::user()->id;
                if(isset($data['customer_id'])){
                    $input['customer_id'] = $data['customer_id'];
                }else{
                    $input['token'] = $data['token'];
                }
                $input['transaction_id'] = $payment->source->id;
                $input['amount'] = $data['amount'];
                $input['currency'] = $data['currency'];
                // $input['token'] = $data['token'];
                $input['last_four'] = $payment->source->last4;
                $input['description'] = $request->description;
                $input['receipt_url'] = $payment->receipt_url;
                $input['status'] = $payment->status;
                $input['brand'] = $payment->source->brand;
                $pay = PT::create($input);

                $product = Product::find($request->product_id);
                $product->booster_start_datetime = date('Y-m-d H:i:s');
                $product->booster_end_datetime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+'.$request->number_of_days.'days'));
                $product->save();
                return $this->sendResponse($pay,'Payment Successfully.');
            }else{
                return $this->sendError('Something Went wrong',[],401);
            }
            // Payment successful
            // return response()->json(['message' => 'Payment successful']);
        } catch (\Exception $e) {
            // Payment failed
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function get_user_all_trans($id)
    {
        $transactions = PT::where('user_id',$id)->get();
        return $this->sendResponse($transactions,'All user transactions retreived Successfully.');
    }

    public function get_user_all_cards($id)
    {
        $transactions = PT::where('user_id',$id)->where('customer_id','!=',null)->groupby('customer_id')->get();
        return $this->sendResponse($transactions,'All user saved cards retreived Successfully.');
    }

    public function del_user_card($id)
    {
        $transactions = PT::where('customer_id',$id)->update(['customer_id'=>null]);
        return $this->sendResponse($transactions,'User card deleted Successfully.');
    }

    public function get_all_trans()
    {
        $transactions = PT::all();
        return $this->sendResponse($transactions,'All transactions retreived Successfully.');
    }

    public function get_trans($id)
    {
        $transaction = PT::find($id);
        return $this->sendResponse($transaction,'Transaction retreived Successfully.');
    }





    public function charge2(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_TEST_SECRET'));

        // Create a payment intent
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_method' => $request->payment_method,
            'confirm' => true,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
        ]);

        // Handle successful payment
        if ($paymentIntent->status === 'succeeded') {
            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment failed']);
        }
    }

    public function charge1(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'amount'            => 'required',
            'currency'          => 'required',
            'type'              => 'required',
            'card_number'       => 'required',
            'exp_month'         => 'required',
            'exp_year'          => 'required',
            'cvc'               => 'required',
        ]);
        $data = $request->all();
        Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        // $formData = http_build_query([
        //     'card[number]' => $data['card_number'],
        //     'card[exp_month]' => $data['exp_month'],
        //     'card[exp_year]' => $data['exp_year'],
        //     'card[cvc]' => $data['cvc'],
        // ]);
        $formData = [
            'card[number]' => $data['card_number'],
            'card[exp_month]' => $data['exp_month'],
            'card[exp_year]' => $data['exp_year'],
            'card[cvc]' => $data['cvc'],
        ];
        // $response = Http::withBasicAuth(env('STRIPE_SECRET'), '')
        //                     ->post('https://api.stripe.com/v1/tokens', [
        //                         'card' => [
        //                             'number' => $data['card_number'],
        //                             'exp_month' => $data['exp_month'],
        //                             'exp_year' => $data['exp_year'],
        //                             'cvc' => $data['cvc'],
        //                         ],
        //                     ]);
        $response = Http::withBasicAuth(env('STRIPE_SECRET'), '')
                            ->asForm()
                            ->post('https://api.stripe.com/v1/tokens', $formData);
                            dd($response->body());

            // Check if request was successful
            if ($response->successful()) {
                $token = $response['id'];

                // Now you can use the token to charge the customer
                // Example: Charge::create([...]);

                // Payment successful
                return response()->json(['message' => 'Token created successfully', 'token' => $token]);
            } else {
                // Handle unsuccessful request
                return response()->json(['error' => 'Failed to create token'], $response->status());
            }
        if ($validator->fails()) {
            return $this->sendError($validator->errors(),[],401);
        }
        $data = $request->all();
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $stripe->tokens->create([
                'card' => [
                    'number' => $data['card_number'],
                    'exp_month' => $data['exp_month'],
                    'exp_year' => $data['exp_year'],
                    'cvc' => $data['cvc'],
                ],
            ]);
            dd($stripe);

            $token = Token::create([
                'card' => [
                    'number' => $data['card_number'],
                    'exp_month' => $data['exp_month'],
                    'exp_year' => $data['exp_year'],
                    'cvc' => $data['cvc'],
                ],
            ]);
            dd($token);
            // Create a charge
            $payment =  Charge::create([
                            'amount' => 1000, // Amount in cents
                            'currency' => 'usd',
                            'source' => $token->id,
                            'description' => $request->description,
                        ]);

            // Payment successful
            return response()->json(['message' => 'Payment successful']);
        } catch (\Exception $e) {
            // Payment failed
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

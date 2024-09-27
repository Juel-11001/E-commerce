<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CodSetting;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Session::has('shipping_address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }
    /**
     * paypal config
     */
    public function paypalConfig(){
        $paypalSetting=PaypalSetting::first();
        $config = [
            'mode'    => $paypalSetting->account_mode===1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                // 'app_id'            => '',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                // 'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
        return $config;
    }
    /**
     * paypal redirect
     */
    public function payWithPaypal()
    {
         $config=$this->paypalConfig();
        // dd($config);

        $paypalSetting=PaypalSetting::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        // $provider->setApiCredentials($config);

        //calculate payable amount depending on currency rate
        $total=getFinalPayableAmount();
        $paypalAmount = round($total*$paypalSetting->currency_rate, 2);

        $response=$provider->createOrder([
            "intent"=>"CAPTURE",
            "application_context"=>[
                "return_url"=>route('user.paypal-success'),
                "cancel_url"=>route('user.paypal-cancel')
            ],
            "purchase_units"=>[
                [
                    "amount"=>[
                        "currency_code"=> $config['currency'],
                        "value"=>$paypalAmount
                    ]
                ]
            ]
        ]);
        if(isset($response['id']) && $response['id'] != null){
            // redirect to approve href
            foreach($response['links'] as $link){
                if($link['rel'] == 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('user.paypal-cancel');
        }
    }

    /**
     * paypal success page
     */
    public function paypalSuccess(Request $request)
    {
        // dd($request->all());
        $config=$this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response=$provider->capturePaymentOrder($request->token);
        // dd($response);
        if(isset($response['status']) && $response['status']=='COMPLETED'){
            $paypalSetting=PaypalSetting::first();
            //calculate payable amount depending on currency rate
            $total=getFinalPayableAmount();
            $paidAmount = round($total*$paypalSetting->currency_rate, 2);
            $this->storeOrder('Paypal', 1, $response['id'], $paidAmount, $paypalSetting->currency_name);
            //clear session
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }
        return redirect()->route('user.paypal-cancel');
    }

    /**
     * payment Success
     */
    public function paymentSuccess(){
        return view('frontend.pages.payment-success');
    }

    /**
     * paypal cancel
     */
    public function paypalCancel(){
        toastr('Something went Wrong try again later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }
    /**
     * Store Order
     */
    public function storeOrder($paymentMethod, $paymentStatus, $transctionId,$paidAmount, $paidCurrencyName){
        $setting=GeneralSetting::first();
        $order = new Order();
        $order->invoice_id=rand(1,999999);
        $order->user_id=Auth::user()->id;
        $order->sub_total= getCartTotal();
        $order->amount=getFinalPayableAmount();
        $order->currency_name=$setting->currency_name;
        $order->currency_icon=$setting->currency_icon;
        $order->product_qty = \Cart::content()->count();
        // $totalQty = \Cart::content()->sum('qty');
        // $order->product_qty = $totalQty;
        $order->payment_method=$paymentMethod;
        $order->payment_status=$paymentStatus;
        $order->order_address= json_encode(Session::get('shipping_address'));
        $order->shipping_method= json_encode(Session::get('shipping_method'));
        $order->coupon= json_encode(Session::get('coupon'));
        $order->order_status='pending';
        // dd($order->product_qty);
        $order->save();

        //store order products
        foreach( \Cart::content() as $item){
            $product=Product::find($item->id);
            $orderProduct= new OrderProduct();
            $orderProduct->order_id=$order->id;
            $orderProduct->product_id=$product->id;
            $orderProduct->vendor_id=$product->vendor_id;
            $orderProduct->product_name=$product->name;
            $orderProduct->variants=json_encode($item->options->variants);
            $orderProduct->variants_total=$item->options->variants_total;
            $orderProduct->unit_price=$item->price;
            $orderProduct->qty=$item->qty;
            $orderProduct->save();

            //update productt quantity

            $updatedQty=($product->qty - $item->qty);
            $product->qty=$updatedQty;
            $product->save();
        }

        // store transction details:

        $transction= new Transaction();
        $transction->order_id=$order->id;
        $transction->transaction_id=$transctionId;
        $transction->payment_method=$paymentMethod;
        $transction->amount=getFinalPayableAmount();
        $transction->amount_real_currency=$paidAmount;
        $transction->amount_real_currency_name=$paidCurrencyName;
        $transction->save();

    }

    /**
     * clear cart session
     */
    public function clearSession(){
        \Cart::destroy();
        Session::forget('shipping_address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    /**
     * Stripe Payment
     */

     /**
      * stripe redirect
      */
      public function payWithStripe(Request $request)
    {
        $stripeSetting=StripeSetting::first();
        //calculate payable amount depending on currency rate
        $total=getFinalPayableAmount();
        $paypalAmount = round($total * $stripeSetting->currency_rate, 2);


        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create ([
            "amount" => $paypalAmount*100,
            "currency" => $stripeSetting->currency_name,
            "source" => $request->stripe_token,
            "description" => "Product Purchase"
        ]);
        if($response->status ==='succeeded'){
            $this->storeOrder('Stripe', 1, $response['id'], $paypalAmount, $stripeSetting->currency_name);
            //clear session
            $this->clearSession();
            return redirect()->route('user.payment.success');
        }else{
            toastr('Something went Wrong try again later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }

    public function payWithCod(Request $request)
    {
        $codPaySetting=CodSetting::first();

        if($codPaySetting->status==0){
            return redirect()->back();
        }
         //calculate payable amount depending on currency rate
         $total=getFinalPayableAmount();
         $paypalAmount = round($total, 2);
         $setting=GeneralSetting::first();
         $this->storeOrder('COD', 0, \Str::random(10), $paypalAmount,$setting->currency_name);
         //clear session
         $this->clearSession();
         return redirect()->route('user.payment.success');
    }



}

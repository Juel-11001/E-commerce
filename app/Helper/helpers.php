<?php

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;

/**
 *  set sidebar Active
 */
function setActive(array $route) {
        if(is_array($route)){
            foreach($route as $r){
                if(request()->routeIs($r)){
                    return 'active';
                }
            }
        }
    }

/**
 * check if product have discount
 */

function checkDiscount($product){
    $currentDate=date("Y-m-d");
    if($product->offer_price >0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date){
        return true;
    }
    return false;
}
/**
 * calculate discount percent
 */
function calculateDiscountPercent($originalPrice, $discountPrice){
    $discountAmount = ($originalPrice - $discountPrice);
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return round($discountPercent);
}

/**
 * check the type of product
 */
function productType($type){
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best_product':
            return 'Best';
            break;

        default:
        return '';
            break;
    }
}

/**
 * get cart sidebar product total
 */
function getCartTotal(){
    $total=0;
    foreach(\Cart::content() as $product){
        $total +=($product->price+$product->options->variants_total) * $product->qty;
    }
    return $total;
}

/**
 * get payable total amount
 */
function getMainCartTotal(){
    if (session()->has('coupon')) {
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount') {
            $total = $subTotal - $coupon['discount'];
            return $total;
        }elseif($coupon['discount_type'] === 'percentage') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    }else{
        return getCartTotal();
    }
}

/**
 * get cart discount
 */

 function getCartDiscount(){
     if (session()->has('coupon')) {
         $coupon = Session::get('coupon');
         $subTotal = getCartTotal();
         if($coupon['discount_type'] === 'amount') {
             return $coupon['discount'];
         }elseif($coupon['discount_type'] === 'percentage') {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
             return $discount;
         }
     }else{
        return 0;
     }
}
/**
 * get select shipping free from session
*/
function getShippingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else{
        return 0;
    }
}

/**
 * get payable final amount
 */
function getFinalPayableAmount(){
    return getMainCartTotal()+ getShippingFee();
}

/**
 * limit text for product name
 */
function limitText($text, $limit = 20) {
    return \Str::limit($text, $limit);
}

/** get currency icon */
function getCurrencyIcon(){
    $icon=GeneralSetting::first();
    return $icon->currency_icon;
}


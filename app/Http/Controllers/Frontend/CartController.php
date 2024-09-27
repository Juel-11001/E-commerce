<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Add item to cart
     */
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        //check product quantity
        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product out of stock!']);
        } elseif ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Product quantity not available!']);
        }

        $variants = [];
        $variantTotalAmount = 0;
        if ($request->variants_items) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
            // dd($variants);
        }


        //! check if product has discount

        $productPrice = 0;
        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }
        /** Add item to cart data to session */
        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        // dd($cartData);

        /**add item to cart */
        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'Product added to cart successfully!']);
    }

    /**
     * Show cart details
     */
    public function cartDetails()
    {
        $cartItems = Cart::content();
        // dd($cartItems);
        if (count($cartItems) === 0) {
            Session::forget('coupon');
            toastr('Your cart is empty Please add product view to cart', 'warning', 'Cart is empty!');
            return redirect()->route('fronted.home');
        }
        $cart_banner=Advertisement::where('key', 'cartpage_banner_section')->first();
        $cart_banner=json_decode($cart_banner?->value);
        return view('frontend.pages.cart-details', compact('cartItems', 'cart_banner'));
    }

    /**
     * Update product quantity
     */
    public function updateProductQuantity(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
        //check product quantity
        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Product out of stock!']);
        } else if ($product->qty < $request->quantity) {
            return response(['status' => 'error', 'message' => 'Product quantity not available!']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductToal($request->rowId);
        return response(['status' => 'success', 'message' => 'Product quantity updated successfully!', 'product_total' => $productTotal]);
    }

    /**
     * get product total
     */
    public function getProductToal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /**
     * clear cart
     */
    public function clearCart()
    {
        // dd('clear-cart!!!!');
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart cleared successfully!']);
    }
    /**
     * Remove product from cart
     */
    public function removeProductFromCart($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed from cart successfully!', 'success', 'Success');
        return redirect()->back();
    }
    /**
     * get cart count
     */
    public function getCartCount()
    {
        return Cart::content()->count();
    }
    /**
     * get all cart products
     */
    public function getCartProduct()
    {
        return Cart::content();
    }
    /**
     * remove sidebar product form cart
     */
    public function removeSidebarProduct(Request $request)
    {
        // dd($request->all());
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product removed from cart successfully!']);
    }
    /**
     * get cart siderbar product total
     */
    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->getProductToal($product->rowId);
        }
        return $total;
    }

    /**
     * coupon apply
     */
    public function applyCoupon(Request $request)
    {
        // dd($request->all());
        // check coupon code is valid
        if ($request->coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Please enter coupon code!']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Invalid coupon code!']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon expired!']);
        } elseif ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'Coupon limit exceeded!']);
        }

        // add coupon into session :
        if ($coupon->discount_type === 'amount') {
            Session()->put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount,
            ]);
        } elseif ($coupon->discount_type === 'percentage') {
            Session()->put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percentage',
                'discount' => $coupon->discount,
            ]);
        }
        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    /**
     * calculate coupon discount
     */
    public function couponCalculation()
    {
        if (session()->has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if($coupon['discount_type'] === 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }elseif($coupon['discount_type'] === 'percentage') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        }else{
            $total=getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }


}

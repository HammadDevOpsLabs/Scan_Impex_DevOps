<?php

namespace App\Http\Controllers;

use App\Mail\OrderSet;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addToCart(Request $request ,$product_id)
    {
        $cart=Cart::where([
            'user_id' => Auth::user()->id,
            "product_id" => $product_id,
        ])->first();
        if(!empty($cart)){
            $cart->update([
                'quantity'=>$cart->quantity+$request->input('quantity'),
            ]);
        }
        else {
            Cart::create([
                'user_id' => Auth::user()->id,
                "product_id" => $product_id,
                'quantity'=>$request->input('quantity'),

            ]);
        }
        return ['success' => true, 'message' => 'Product added to cart successfully'];

    }
    /**
     * Show the form for creating a new resource.
     */
    public function removeFromCart($product_id){

        $status =Cart::where([
            'user_id' => Auth::user()->id,
            "product_id" => $product_id,
        ])->delete();
        if ($status) {
            return ['success' => true, 'message' => 'Product removed from cart successfully'];
        }
        else{
            return ['success' => false, 'message' => 'Product not removed from cart successfully'];
        }
    }

    public function changeQuantity($item){

        $status =Cart::where([
            'id' => $item,
        ])->update([
            'quantity'=>request()->quantity,
        ]);
        if ($status) {
            session()->flash('success', 'Quantity changed successfully');
            return ['success' => true];

        }
        else{
            return ['success' => false, 'message' => 'Product not removed from cart successfully'];
        }

    }

    public function ShowCart()
    {
        $data['cartItems'] =Cart::where([
            'user_id' => Auth::user()->id,
        ])->get();
        $data['totalPrice']=$data['cartItems']->sum(function ($cart) {
            return $cart->product->price*$cart->quantity;
        });

        return view('cart',$data);
    }



}

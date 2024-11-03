<?php

namespace App\Http\Controllers;

use App\Mail\OrderSet;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderSetNotification;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        $data['cartItems'] =Cart::where([
            'user_id' => Auth::user()->id,
        ])->get();
        $data['totalPrice']=$data['cartItems']->sum(function ($cart) {
            return $cart->product->price*$cart->quantity;
        });
        return view('checkout',$data);
    }

    public function placeOrder(Request $request){

        $cart=Cart::where('user_id', Auth::user()->id)->get();
        $totalPrice=$cart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        $order=Order::create([
            "user_id"=> Auth::user()->id,
            'status'=>'pending',
            'payment'=>$request->input('payment-type'),
            'total_amount'=>$totalPrice,
        ]);
        $orderItem=[];
        foreach ($cart as $cartItem) {
            $orderItem[]=[
                'order_id'=>$order->id,
                'product_id'=> $cartItem->product_id,
                'quantity'=> $cartItem->quantity,
                'created_at'=>now(),
            ];
        }
        OrderItem::insert($orderItem);
        Cart::where('user_id', Auth::user()->id)->delete();

        $users=User::where('is_admin',1)->get();
        Notification::make()
            ->title('New order with id="'.$order->id.'" set successfully')
            ->sendToDatabase($users);
        Mail::to(\auth()->user()->email)->send(new OrderSet($order));
        return view('complete-order');

    }

    public function OrderItems($order_id)
    {

        $order=Order::findOrfail($order_id);
        $data['orderItems']=$order->order_items;
        return view('order-items',$data);
    }
}

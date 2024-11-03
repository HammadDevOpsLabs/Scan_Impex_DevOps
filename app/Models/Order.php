<?php

namespace App\Models;

use App\Mail\OrderSet;
use App\Mail\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {

            $order->order_number = now()->format('YmdHis') . " - " . $order->id;
            $order->save();
        });

        static::updated(function ($order) {
            try {
                if (in_array($order->status,['in-progress','delivered'])){

                    Mail::to($order->User->email)->send(new OrderStatus($order));
                }
            }
            catch (\Exception $exception){

                Log::error($exception->getMessage());
            }
        });


    }

        public function User()
    {
         return $this->BelongsTo(User::class);
    }
    public function order_items()
    {

        return $this->hasMany(OrderItem::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id')->withPivot('quantity');
    }


}

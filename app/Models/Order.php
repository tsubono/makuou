<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'payment_id', 'order_shipping_address_id',
        'message', 'note',
        'sub_total', 'discount', 'shipping_cost', 'fee', 'total', 'payment_total',
        'ordered_at', 'payment_at', 'shipping_at'
    ];

    protected $dates = ['ordered_at', 'payment_at', 'shipping_at', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function order_shipping_address()
    {
        return $this->belongsTo(OrderShippingAddress::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }


}

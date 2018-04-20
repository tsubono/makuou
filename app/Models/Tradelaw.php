<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tradelaw extends Model
{
    use SoftDeletes;

    protected $table = 'tradelaw';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seller', 'operation_manager', 'zip_code', 'pref_id', 'address1', 'address2', 'tel', 'fax',
        'email', 'other_price', 'payment_method', 'payment_limit', 'delivery_time', 'about_returned_exchange'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

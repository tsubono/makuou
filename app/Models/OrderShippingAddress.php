<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderShippingAddress extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_kana', 'company_name',
        'zip_code', 'pref_id', 'address1', 'address2', 'tel', 'fax'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

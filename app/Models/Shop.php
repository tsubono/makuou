<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    protected $table = 'shop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'company_name_kana', 'shop_name', 'shop_name_kana', 'zip_code', 'pref_id', 'address1', 'address2',
        'tel', 'fax', 'business_hours', 'email_from', 'message'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

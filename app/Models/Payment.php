<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'commission', 'minimum_amount', 'maximum_amount'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

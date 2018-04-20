<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAgreement extends Model
{
    use SoftDeletes;

    protected $table = 'customer_agreement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

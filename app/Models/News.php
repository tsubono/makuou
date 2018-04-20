<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'title', 'url', 'blank_flg', 'text'
    ];

    protected $dates = ['date', 'created_at', 'updated_at', 'deleted_at'];

}

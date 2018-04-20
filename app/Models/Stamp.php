<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stamp extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'stamp_category_id', 'image'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function stamp_category()
    {
        return $this->belongsTo(StampCategory::class);
    }

}

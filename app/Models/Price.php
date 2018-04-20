<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size_id', 'clothe_id', 'ratio_id', 'price', 'note'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function clothe()
    {
        return $this->belongsTo(Clothe::class);
    }

    public function ratio()
    {
        return $this->belongsTo(Ratio::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavedDesign extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'filename', 'image', 'uploaded_files', 'json', 'user_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSavedDesign($product_id, $user_id) {
        $savedDesign = SavedDesign::where('product_id', $product_id)->where('user_id', $user_id)->first();


        return $savedDesign;
    }

}

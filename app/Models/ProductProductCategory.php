<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProductCategory extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'product_category_id', 'category_type'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public static function isCategory($product_id, $product_category_id) {
        $res = false;

        $product_product_category = ProductProductCategory::where('product_id', $product_id)->where('product_category_id', $product_category_id)->first();

        if (!empty($product_product_category)) {
            $res = true;
        }

        return $res;
    }

}

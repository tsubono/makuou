<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path', 'description'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public static function getChildren($id) {
        $res = ProductCategory::where('path', $id)->get();

        return $res;
    }

    public static function isParent($id) {
        $res = false;

        $product_category = ProductCategory::findOrFail($id);
        if (empty($product_category->path)) {
            $res = true;
        }

        return $res;

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'ratio_id', 'category_1', 'category_2', 'category_3', 'image',
        'image_600_layout', 'image_600_copy', 'image_900_layout', 'image_900_copy',
        'image_1200_layout', 'image_1200_copy', 'image_1500_layout', 'image_1500_copy',
        'image_1800_layout', 'image_1800_copy', 'status', 'note'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function ratio()
    {
        return $this->belongsTo(Ratio::class);
    }

    public function getCategories($categories)
    {
        $res = [];
        if (!empty($categories)) {
            $categories = explode(",", $categories);
            foreach ($categories as $category) {
                $target = ProductCategory::find($category);
                if (!empty($target)) {
                    $res[] = $target;
                }
            }
        }
        return $res;
    }

    public function getCategoryForDisp($categories)
    {
        $res = "";
        if (!empty($categories)) {
            $categories = explode(",", $categories);
            foreach ($categories as $category) {
                $target = ProductCategory::find($category);
                if (!empty($target)) {
                    if (!empty($res)) {
                        $res.= ",". $target->name;
                    } else {
                        $res = $target->name;
                    }
                }
            }
        }
        return $res;
    }

    public static function isCategory($categories, $category_id) {
        $res = false;

        if (!empty($categories)) {
            $categories = explode(",", $categories);

           $res = in_array($category_id, $categories);
        }
        return $res;
    }

    public function product_categories(){
        return $this->belongsToMany('App\Models\ProductCategory', 'product_product_categories');
    }
}

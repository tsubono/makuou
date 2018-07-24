<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'product_type_id', 'price_id', 'option_ids', 'option_price', 'price', 'quantity', 'tax_rate', 'sub_total',
        'designed_filename', 'designed_image', 'uploaded_files', 'designed_json', 'design_name', 'note',
        'hatome', 'lope_flg', 'lope_1', 'lope_2', 'pole_flg', 'pole', 'nouki_id'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public static function getJsonText($id)
    {
        $json_file = OrderDetail::findOrFail($id)->designed_json;

        $url = public_path() . $json_file;
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        return $json;
    }
}

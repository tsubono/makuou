<?php

namespace App\Services;


use App\Models\Clothe;
use App\Models\Option;
use App\Models\Price;
use App\Models\Ratio;
use App\Models\Size;
use Illuminate\Http\Request;

class PriceService
{
    private $price;
    private $size;
    private $clothe;
    private $ratio;
    private $option;

    function __construct(Price $price, Size $size, Clothe $clothe, Ratio $ratio, Option $option) {
        $this->price = $price;
        $this->size = $size;
        $this->clothe = $clothe;
        $this->ratio = $ratio;
        $this->option = $option;
    }

    /**
     * サイズ一覧を返す
     */
    public function getSizes($ratio_id) {
        if (!empty($ratio_id)) {
            $size_ids = $this->price->where('ratio_id', $ratio_id)->get()->sortBy('size_id')->pluck('size_id');
        } else {
            $size_ids = $this->price->get()->sortBy('size_id')->pluck('size_id');
        }
        $size_ids = $this->price->get()->sortBy('size_id')->pluck('size_id');
        $size_ids = array_unique($size_ids->toArray());
        $size_ids = array_values($size_ids);
        $sizes = [];

        foreach ($size_ids as $size_id) {
            $sizes[] = $this->size->findOrFail($size_id);
        }

        return $sizes;
    }

    /**
     * サイズIDを返す
     */
    public function getSizeId($id) {
        $price = $this->price->findOrFail($id);

        return $price->size_id;
    }

    /**
     * 生地IDを返す
     */
    public function getClotheId($id) {
        $price = $this->price->findOrFail($id);

        return $price->clothe_id;
    }
}

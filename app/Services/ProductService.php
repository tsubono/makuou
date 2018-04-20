<?php

namespace App\Services;


use App\Models\OrderDetail;
use App\Models\OrderShippingAddress;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductService
{
    private $product;

    function __construct(Product $product) {
        $this->product = $product;
    }

    /**
     * DB保存用データを返す
     */
    public function getDataForDB(Request $request)
    {
        $res = $request->input('product');

        // カテゴリたち整形
        if (!empty($res["category_1"])) {
            $res["category_1"] = implode(',', $res["category_1"]);
        }
        if (!empty($res["category_2"])) {
            $res["category_2"] = implode(',', $res["category_2"]);
        }
        if (!empty($res["category_3"])) {
            $res["category_3"] = implode(',', $res["category_3"]);
        }
        // ファイルたち
        if (empty($res["id"]) || $request->hasFile('product.image') || $res["image_edit"] == "1") {
            $res["image"] = $this->uploadFile($request, '', '');
        }
        if (empty($res["id"]) || $request->hasFile('product.image_600_layout') || $res["image_600_layout_edit"] == "1") {
            $res["image_600_layout"] = $this->uploadFile($request, '600', 'layout');
        }
        if (empty($res["id"]) || $request->hasFile('product.image_600_copy') || $res["image_600_copy_edit"] == "1") {
            $res["image_600_copy"] = $this->uploadFile($request, '600', 'copy');
        }
//        if (empty($res["id"]) || $request->hasFile('product.image_900_layout') || $res["image_900_layout_edit"] == "1") {
//            $res["image_900_layout"] = $this->uploadFile($request, '900', 'layout');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_900_copy') || $res["image_900_copy_edit"] == "1") {
//            $res["image_900_copy"] = $this->uploadFile($request, '900', 'copy');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1200_layout') || $res["image_1200_layout_edit"] == "1") {
//            $res["image_1200_layout"] = $this->uploadFile($request, '1200', 'layout');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1200_copy') || $res["image_1200_copy_edit"] == "1") {
//            $res["image_1200_copy"] = $this->uploadFile($request, '1200', 'copy');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1500_layout') || $res["image_1500_layout_edit"] == "1") {
//            $res["image_1500_layout"] = $this->uploadFile($request, '1500', 'layout');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1500_copy') || $res["image_1500_copy_edit"] == "1") {
//            $res["image_1500_copy"] = $this->uploadFile($request, '1500', 'copy');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1800_layout') || $res["image_1800_layout_edit"] == "1") {
//            $res["image_1800_layout"] = $this->uploadFile($request, '1800', 'layout');
//        }
//        if (empty($res["id"]) || $request->hasFile('product.image_1800_copy') || $res["image_1800_copy_edit"] == "1") {
//            $res["image_1800_copy"] = $this->uploadFile($request, '1800', 'copy');
//        }

        return $res;
    }

    /**
     * テンプレートファイルをアップロードする
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $size
     * @param  $type
     * @return $path
     */
    public function uploadFile($request, $size, $type)
    {
        $path = "";

        if (!empty($request->input('product.id'))) {
            // 既存ファイルがあれば削除
            $product = $this->product->findOrFail($request->input('product.id'));
            if (empty($size) && empty($type)) {
                $column = 'image';
            } else {
                $column = 'image_' . $size . '_' . $type;
            }
            if (!empty($product->$column)) {
                unlink(public_path(). $product->$column);
            }
        }
        if (empty($size) && empty($type)) {
            $file = $request->file('product.image');
        } else {
            $file = $request->file('product.image_' . $size . '_' . $type);
        }
        if (!empty($file)) {
            $datetime = Carbon::now()->format('YmdHis');
            $filename = $datetime . mt_rand() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/product_files', $filename);

            $path = "/storage/product_files/" . $filename;
        }

        return $path;
    }

    /**
     * 既存のファイルを削除する
     *
     * @param  Product $product
     */
    public function deleteFiles($product) {

        if (!empty($product->image)) {
            unlink(public_path(). $product->image);
        }
        if (!empty($product->image_600_layout)) {
            unlink(public_path(). $product->image_600_layout);
        }
        if (!empty($product->image_600_copy)) {
            unlink(public_path(). $product->image_600_copy);
        }
//        if (!empty($product->image_900_layout)) {
//            unlink(public_path(). $product->image_900_layout);
//        }
//        if (!empty($product->image_900_copy)) {
//            unlink(public_path(). $product->image_900_copy);
//        }
//        if (!empty($product->image_1200_layout)) {
//            unlink(public_path(). $product->image_1200_layout);
//        }
//        if (!empty($product->image_1200_copy)) {
//            unlink(public_path(). $product->image_1200_copy);
//        }
//        if (!empty($product->image_1500_layout)) {
//            unlink(public_path(). $product->image_1500_layout);
//        }
//        if (!empty($product->image_1500_copy)) {
//            unlink(public_path(). $product->image_1500_copy);
//        }
//        if (!empty($product->image_1800_layout)) {
//            unlink(public_path(). $product->image_1800_layout);
//        }
//        if (!empty($product->image_1800_copy)) {
//            unlink(public_path(). $product->image_1800_copy);
//        }
    }
}

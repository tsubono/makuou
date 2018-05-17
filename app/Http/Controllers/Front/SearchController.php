<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Ratio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    private $product;
    private $productCategory;
    private $ratio;


    public function __construct(Product $product,ProductCategory $productCategory, Ratio $ratio)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->ratio = $ratio;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = $this->getParams();

        return view('front.search', $params);
    }

    public function search(Request $request){

        // 検索フォームの値から検索処理
        // ( 比率とカテゴリー )
        $query = $this->product->query();

        $sql = "";
        $array = [];
        for ($i=1; $i<4; $i++) {
            foreach ($request->get("category_{$i}", []) as $index => $category) {
                if (empty($sql)) {
                    $sql = "FIND_IN_SET(?, category_{$i})";
                } else {
                    $sql .= " or FIND_IN_SET(?, category_{$i})";
                }
                $array[] = $category;
            }
        }
        if (!empty($sql)) {
            $query->whereRaw($sql, $array);
        }

        $products = $query->get();

        $ratio = $request->get('ratio', '');
        if (!empty($ratio)) {
            foreach ($products as $index => $product) {
                if ($product->ratio_id != $ratio) {
                    unset ($products[$index]);
                }

            }
        }

        $params = $this->getParams();
        $params['search'] = $request->all();
        $params['products'] = $products;

        return view('front.result', $params);
    }

    private function getParams() {
        // スポーツカテゴリー
        $category_1 = $this->productCategory->where('path', 1)->orderBy('created_at', 'desc')->get();
        // テイストカテゴリー
        $category_2 = $this->productCategory->where('path', 2)->orderBy('created_at', 'desc')->get();
        // シーンカテゴリー
        $category_3 = $this->productCategory->where('path', 3)->orderBy('created_at', 'desc')->get();
        // 比率
        $ratios = $this->ratio->all();

        return compact('category_1', 'category_2', 'category_3', 'ratios');
    }
}

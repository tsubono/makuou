<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {

        $favoritedProductIds = DB::table('favorites')
            ->where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();

        //お気に入りされているproduct取得
        $products = Product::whereIn('id', $favoritedProductIds)
            ->get();

        return view('front.favorite')->with('products', $products);
    }

    //検索結果からの追加
    public function addFavorite(Request $request)
    {

        //productIdのチェック
        $request->validate([
            'productId' => 'required|exists:products,id',
            'ratio' => 'exists:ratios,id',
        ]);

        $productId = $request->input('productId');
        $favoriteQuery = DB::table('favorites')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId);

        //お気に入りされていないならお気に入りする！:)
        if (!$favoriteQuery->exists()) {
            DB::table('favorites')
                ->insert(['user_id' => Auth::id(), 'product_id' => $productId]);
        }

        $requestQuery = $this->getParams($request);
        //処理後はリザルトにリダイレクト
        return redirect('/result?' . $requestQuery);
    }

    //検索結果からの削除
    public function cancelFavorite(Request $request)
    {
        //productId,ratioのチェック
        $request->validate([
            'productId' => 'required|exists:products,id',
            'ratio' => 'exists:ratios,id',
        ]);

        $productId = $request->input('productId');
        $favoriteQuery = DB::table('favorites')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId);

        //既にお気に入りされていたら、取り消す。
        if ($favoriteQuery->exists()) {
            $favoriteQuery->delete();
        }

        $requestQuery = $this->getParams($request);
        //処理後はリザルトにリダイレクト
        return redirect('/result?' . $requestQuery);
    }

    private function getParams(Request $request){
        //検索パラメータを/resultへのredirect時に引き継ぐための処理
        $_cate1 = $request->input('category_1', null);
        $_cate2 = $request->input('category_2', null);
        $_cate3 = $request->input('category_3', null);

        $ratio = $request->input('ratio');

        if ($_cate1) {
            $cate1 = '';
            foreach (explode(',', $_cate1) as $param) {

                if (!empty($param)) {
                    $cate1 .= '&category_1[]=' . $param;
                }
            }
        }
        if ($_cate2) {
            $cate2 = '';
            foreach (explode(',', $_cate2) as $param) {
                if (!empty($param)) {
                    $cate2 .= '&category_2[]=' . $param;
                }
            }
        }
        if ($_cate3) {
            $cate3 = '';
            foreach (explode(',', $_cate3) as $param) {
                if (!empty($param)) {
                    $cate3 .= '&category_3[]=' . $param;
                }
            }

        }
        $requestQuery = '';
        if (!empty($cate1)) {
            $requestQuery .= $cate1;
        }
        if (!empty($cate2)) {
            $requestQuery .= $cate2;
        }
        if (!empty($cate3)) {
            $requestQuery .= $cate3;
        }
        if (!empty($ratio)) {
            $requestQuery .= '&ratio=' . $ratio;
        }

        return $requestQuery;
    }


    //お気に入り一覧からの削除
    public function delete(Request $request)
    {

        //productIdのチェック
        $request->validate([
            'productId' => 'required|exists:products,id',
        ]);

        $productId = $request->input('productId');
        $favoriteQuery = DB::table('favorites')
            ->where('user_id', Auth::id())
            ->where('product_id', $productId);

        if ($favoriteQuery->exists()) {
            $favoriteQuery->delete();
        }

        return redirect('/favorite');
    }

}

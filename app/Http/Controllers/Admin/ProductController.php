<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProductCategory;
use App\Models\Ratio;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;
use Illuminate\Support\Facades\View;


class ProductController extends Controller
{
    private $product;
    private $productCategory;
    private $productProductCategory;
    private $productService;
    private $ratio;

    public function __construct(Product $product, ProductCategory $productCategory, ProductProductCategory $productProductCategory, ProductService $productService, Ratio $ratio) {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->productProductCategory = $productProductCategory;
        $this->productService = $productService;
        $this->ratio = $ratio;
    }

    /**
     * テンプレート一覧
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->product->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * テンプレート新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // スポーツカテゴリー
        $category_1 = $this->productCategory->where('path', 1)->orderBy('created_at', 'desc')->get();
        // テイストカテゴリー
        $category_2 = $this->productCategory->where('path', 2)->orderBy('created_at', 'desc')->get();
        // シーンカテゴリー
        $category_3 = $this->productCategory->where('path', 3)->orderBy('created_at', 'desc')->get();
        // 比率
        $ratios = $this->ratio->all();

        return view('admin.products.create', compact('category_1', 'category_2', 'category_3', 'ratios'));
    }

    /**
     * テンプレート新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = $this->productService->getDataForDB($request);
        $product = $this->product->create($create);

        // リレーションテーブル
        for ($i=1; $i<4; $i++) {
            foreach ($request->get('product.category_'. $i, []) as $product_category_id) {
                $productProductCategory = [
                    'product_id' => $product->id,
                    'product_category_id' => $product_category_id,
                    'category_type' => $i
                ];
                $this->productProductCategory->create($productProductCategory);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'テンプレートを登録しました。');
    }

    /**
     * テンプレート詳細
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * テンプレート編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $product = $this->product->findOrFail($id);

        // スポーツカテゴリー
        $category_1 = $this->productCategory->where('path', 1)->orderBy('created_at', 'desc')->get();
        // テイストカテゴリー
        $category_2 = $this->productCategory->where('path', 2)->orderBy('created_at', 'desc')->get();
        // シーンカテゴリー
        $category_3 = $this->productCategory->where('path', 3)->orderBy('created_at', 'desc')->get();
        // 比率
        $ratios = $this->ratio->all();

        return view('admin.products.edit', compact('product', 'category_1', 'category_2', 'category_3', 'ratios'));
    }

    /**
     * テンプレート編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $product = $this->product->findOrFail($id);
        $update = $this->productService->getDataForDB($request);
        $product->update($update);

        // 一旦クリア
        $productProductCategorys = $this->productProductCategory->where('product_id', $id)->get();
        foreach ($productProductCategorys as $productProductCategory) {
            $productProductCategory->delete();
        }
        // リレーションテーブル
        for ($i=1; $i<4; $i++) {
            foreach ($request->get('product.category_'. $i, []) as $product_category_id) {
                $productProductCategory = [
                    'product_id' => $product->id,
                    'product_category_id' => $product_category_id,
                    'category_type' => $i
                ];
                $this->productProductCategory->create($productProductCategory);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'テンプレートを更新しました。');
    }

    /**
     * テンプレート削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $product = $this->product->findOrFail($id);

        // ファイルたちを削除
        $this->productService->deleteFiles($product);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'テンプレートを削除しました。');
    }

    /**
     * テンプレート一覧検索(ajax)
     *
     * @param  \Illuminate\Http\Request $request
     * @return $viewStr
     */
    public function ajaxSearchList(Request $request) {

        $search = $request->get('search');
        $category_search = $request->get('category_search');
        $query = $this->product->query();

        // 検索条件: キーワードとカテゴリ
        if (!empty($search) && !empty($category_search)) {

            $query
                ->where('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")

                ->orWhere('category_1', $category_search)
                ->orWhere('category_2', $category_search)
                ->orWhere('category_3', $category_search);

        // 検索条件: キーワード
        } elseif (!empty($search)) {
            $query->where('id', 'LIKE', "%{$search}%");
            $query->orWhere('title', 'LIKE', "%{$search}%");

        // 検索条件: カテゴリ
        } elseif (!empty($category_search)) {

            $isParent = $this->productCategory->isParent($category_search);

            if (!$isParent) {
                $query->whereRaw('FIND_IN_SET(:category_1, category_1) or FIND_IN_SET(:category_2, category_2) or FIND_IN_SET(:category_3, category_3)',
                    ['category_1' => $category_search, 'category_2' => $category_search, 'category_3' => $category_search]);
            } else {
                $children = $this->productCategory->getChildren($category_search);
                $sql = "";
                $array = [];
                foreach ($children as $index => $child) {
                    if ($index == 0) {
                        $sql = "FIND_IN_SET(:category_1_{$index}, category_1) or FIND_IN_SET(:category_2_{$index}, category_2) or FIND_IN_SET(:category_3_{$index}, category_3)";
                    } else {
                        $sql .= " or FIND_IN_SET(:category_1_{$index}, category_1) or FIND_IN_SET(:category_2_{$index}, category_2) or FIND_IN_SET(:category_3_{$index}, category_3)";
                    }
                    $array["category_1_{$index}"] = $child->id;
                    $array["category_2_{$index}"] = $child->id;
                    $array["category_3_{$index}"] = $child->id;
                }
                $query->whereRaw($sql, $array);
            }
        }

        $products = $query->get();

        $viewStr = View::make('admin.orders.searched_products')->with('products', $products)->render();
        echo $viewStr;
    }

    /**
     * テンプレート検索(ajax)
     *
     * @param  \Illuminate\Http\Request $request
     * @return $viewStr
     */
    public function ajaxSearch(Request $request) {

        $id = $request->get('id');
        $index = $request->get('index');
        $user_id = $request->get('user_id');
        $order_id = $request->get('order_id');
        $json = $request->get('json');
        $product = $this->product->findOrFail($id);

        $viewStr = View::make('admin.orders.order_products')
            ->with('product', $product)->with('index', $index)
            ->with('user_id', $user_id)->with('order_id', $order_id)
            ->with('json', $json)
            ->render();

        echo $viewStr;
    }

}

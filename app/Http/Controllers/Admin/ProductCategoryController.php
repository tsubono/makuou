<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Mail\Mailer;

class ProductCategoryController extends Controller
{
    private $productCategory;

    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * 親テンプレートカテゴリー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_id = $request->get('category_id', false);
        $product_categories = $this->productCategory->whereNull('path')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.product_categories.index', compact('product_categories', 'category_id'));
    }

    /**
     * テンプレートカテゴリー新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // モーダルのため未使用
//        $product_categories = $this->productCategory->orderBy('created_at', 'desc')->paginate(15);
//
//        return view('admin.product_categories.create', compact('product_categories'));

        return redirect()->route('admin.product-categories.index');
    }

    /**
     * テンプレートカテゴリー新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_category = $this->productCategory->create($request->input('product_category'));

        // return redirect()->route('admin.product-categories.index')->with('success', 'テンプレートカテゴリーを登録しました。');
        return redirect()->route('admin.product-categories.show', ['id' => $product_category->path])->with('success', 'テンプレートカテゴリーを登録しました。');
    }

    /**
     * 親テンプレートカテゴリー詳細
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $parent_category = $this->productCategory->findOrFail($id);

        $product_categories = $this->productCategory->where('path',$parent_category->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.product_categories.show', compact('parent_category', 'product_categories'));
    }

    /**
     * テンプレートカテゴリー編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
//        $product_category = $this->productCategory->findOrFail($id);
//        $product_categories = $this->productCategory->where('id', '<>', $id)->orderBy('created_at', 'desc')->paginate(15);
//
//        return view('admin.product_categories.edit', compact('product_category','product_categories'));
        // モーダルのため未使用
        return redirect()->route('admin.product-categories.index');
    }

    /**
     * テンプレートカテゴリー編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $product_category = $this->productCategory->findOrFail($id);
        $product_category->update($request->input('product_category'));

        // return redirect()->route('admin.product-categories.index')->with('success', 'テンプレートカテゴリーを更新しました。');
        return redirect()->route('admin.product-categories.show', ['id' => $product_category->path])->with('success', 'テンプレートカテゴリーを更新しました。');
    }

    /**
     * テンプレートカテゴリー削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $product_category = $this->productCategory->findOrFail($id);
        $parent_category_id = $product_category->path;
        $product_category->delete();

        return redirect()->route('admin.product-categories.show', ['id' => $parent_category_id])->with('success', 'テンプレートカテゴリーを削除しました。');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SavedDesign;
use App\Models\Stamp;
use App\Models\StampCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CanvasController extends Controller
{
    protected $product;
    protected $saved_design;
    protected $stamp;
    protected $stamp_category;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, SavedDesign $savedDesign, Stamp $stamp, StampCategory $stamp_category)
    {
        $this->product = $product;
        $this->saved_design = $savedDesign;
        $this->stamp = $stamp;
        $this->stamp_category = $stamp_category;
    }

    /**
     * Canvas表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('canvas.index');
    }

    /**
     * 商品一覧取得
     */
    public function getProducts()
    {
        $products = $this->product->all();

        echo json_encode(['products' => $products]);

    }

    /**
     * 商品取得
     * @param Request $request
     */
    public function getProduct(Request $request)
    {
        $id = $request->get('id');

        $product = $this->product->findorFail($id);

        $result['product'] = $product;

        echo json_encode($result);

    }

    /**
     * 保存済みデザイン一覧取得
     */
    public function getSavedDesigns()
    {
        $saved_designs = $this->saved_design->all();

        echo json_encode(['savedDesigns' => $saved_designs]);
    }

    /**
     * 保存済みデザイン取得
     * @param Request $request
     */
    public function getSavedDesign(Request $request)
    {

        $user_id = $request->get('user_id');
        $id = $request->get('id');

        $savedDesign = $this->saved_design->findOrFail($id);

        $result['savedDesign'] = $savedDesign;

        echo json_encode($result);

    }

    /**
     * スタンプカテゴリー一覧取得
     */
    public function getStampCategories()
    {
        $stamp_categories = $this->stamp_category->all();

        echo json_encode(['stampCategories' => $stamp_categories]);
    }

    /**
     * スタンプ一覧取得
     * @param Request $request
     */
    public function getStamps(Request $request)
    {
        $stamp_category_id = $request->get('stamp_category_id');
        $stamps = $this->stamp->where('stamp_category_id', $stamp_category_id)->get();

        echo json_encode(['stamps' => $stamps]);
    }

    /**
     * 画像を一時フォルダにアップロード
     * @param Request $request
     */
    public function uploadImage(Request $request)
    {

        $file = $request->file('file');
        $datetime = Carbon::now()->format('YmdHis');
        $filename = $datetime . mt_rand() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/upload/tmp', $filename);

        $path = url("/storage/upload/tmp/" . $filename);

        echo $path;
    }

    /**
     * デザインをSVGで保存
     * @param Request $request
     */
    public function saveObjectAsSvg(Request $request)
    {

        $post_data = json_decode($request->get('object'), true);

        foreach ($post_data as $key => $value) {

            if (!empty($value) && $value != null) {

                if (!file_exists(public_path() . '/storage/saved_designs')) {
                    mkdir(public_path() . '/storage/saved_designs');
                }
                if (!file_exists(public_path() . '/storage/saved_designs/svg')) {
                    mkdir(public_path() . '/storage/saved_designs/svg/');
                }

                $destination = public_path() . "/storage/saved_designs/svg/";
                $filename = $request->get('name') . '.svg';
                $content = file_get_contents($value);

                file_put_contents($destination . $filename, $content);
            }
        }

        echo json_encode([]);
    }

    /**
     * デザインを保存
     * @param Request $request
     */
    public function saveDesign(Request $request)
    {
        $filename = "";
        $post_data = json_decode($request->get('object'), true);

        foreach ($post_data as $key => $value) {

            if (!empty($value) && $value != null) {
                if (!file_exists(public_path() . '/storage/saved_designs')) {
                    mkdir(public_path() . '/storage/saved_designs');
                }
                if (!file_exists(public_path() . '/storage/saved_designs/svg')) {
                    mkdir(public_path() . '/storage/saved_designs/svg/');
                }

                $destination = public_path() . "/storage/saved_designs/svg/";
                $filename = $request->get('name') . '.svg';
                $content = file_get_contents($value);

                file_put_contents($destination . $filename, $content);
            }
        }

        echo json_encode(['filename' => $filename]);
    }

    /**
     * デザインをDBに保存
     * @param Request $request
     */
    public function saveDesignDB(Request $request)
    {
        $product_id = $request->get('product_id');
        $filename = $request->get('filename');
        $user_id = $request->get('user_id');
        $saved_design_id = $request->get('saved_design_id');
        $uploaded_files = json_decode($request->get('uploaded_files'), true);
        $json = $request->get('json');

        // 更新
        if (!empty($saved_design_id)) {
            $saved_design = $this->saved_design->findOrFail($saved_design_id);

            // 前回のデザイン画像を削除
            if (file_exists(public_path(). $saved_design->image)) {
                unlink(public_path(). $saved_design->image);
            }
            if (file_exists(public_path(). $saved_design->json)) {
                unlink(public_path(). $saved_design->json);
            }

            $delete_array = array_diff(explode(',', $saved_design->uploaded_files), $uploaded_files);
            foreach ($delete_array as $delete) {
                if (file_exists(public_path(). "/storage/upload/saved/". $delete) && !empty($delete)) {
                    unlink(public_path(). "/storage/upload/saved/". $delete);
                }
            }
            // 新規追加
        } else {
            $saved_design = new SavedDesign();
        }
        $saved_design->product_id = $product_id;
        $saved_design->filename = $filename;
        $saved_design->image = "/storage/saved_designs/svg/". $filename. ".svg";
        $saved_design->user_id = $user_id;
        $saved_design->uploaded_files = implode(',', $uploaded_files);
        $saved_design->json = "/storage/saved_designs/json/". $filename. ".json";
        $saved_design->save();

        $saved_design_id = $saved_design->id;

        // canvasにアップロードされた写真一覧をsavedに移動する
        foreach ($uploaded_files as $uploaded_file) {
            if (file_exists(public_path() . '/storage/upload/tmp/' . $uploaded_file)) {
                if (!file_exists(public_path() . '/storage/upload/saved')) {
                    mkdir(public_path() . '/storage/upload/saved');
                }
                rename(public_path() . '/storage/upload/tmp/' . $uploaded_file,
                    public_path() . '/storage/upload/saved/' . $uploaded_file);
            }
        }
        // jsonファイル書き出し
        if (!file_exists(public_path() . '/storage/saved_designs/json')) {
            mkdir(public_path() . '/storage/saved_designs/json');
        }
        \File::put(public_path(). "/storage/saved_designs/json/". $filename. ".json", $json);

        echo json_encode(['activeSavedDesignId' => $saved_design_id]);
    }

    /**
     * 保存済みデザイン削除
     * @param Request $request
     */
    public function deleteSavedDesign(Request $request)
    {

        $id = $request->get('saved_design_id');

        // 該当デザイン取得
        $saved_design = $this->saved_design->findOrFail($id);

        // 画像を削除
        if (file_exists(public_path(). "/storage/saved_designs/svg/" . $saved_design["filename"] . ".svg")) {
            unlink(public_path(). "/storage/saved_designs/svg/" . $saved_design["filename"] . ".svg");
        }
        if (file_exists(public_path(). "/storage/saved_designs/json/" . $saved_design["filename"] . ".json")) {
            unlink(public_path(). "/storage/saved_designs/json/" . $saved_design["filename"] . ".json");
        }
        // canvasのimageデータの画像を削除
        if (!empty($saved_design->uploaded_files)) {
            $uploaded_files = explode(',', $saved_design->uploaded_files);
            foreach ($uploaded_files as $uploaded_file) {
                if (file_exists(public_path(). "/storage/upload/saved/". $uploaded_file)) {
                    unlink(public_path(). "/storage/upload/saved/". $uploaded_file);
                }
            }
        }

        // DBデータを削除
        $saved_design->delete();

        echo json_encode([]);
    }
}

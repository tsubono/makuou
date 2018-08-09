<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clothe;
use App\Models\Option;
use App\Models\Price;
use App\Models\Ratio;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceController extends Controller
{
    private $price;
    private $size;
    private $clothe;
    private $ratio;
    private $option;

    public function __construct(Price $price, Size $size, Clothe $clothe, Ratio $ratio, Option $option)
    {
        $this->price = $price;
        $this->size = $size;
        $this->clothe = $clothe;
        $this->ratio = $ratio;
        $this->option = $option;
    }

    /**
     * 値段一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prices = $this->price->orderBy('created_at', 'desc')->paginate(15);

        $sizes = $this->size->all();
        $clothes = $this->clothe->all();
        $ratios = $this->ratio->all();
        $options = $this->option->all();

        return view('admin.prices.index', compact('prices', 'sizes', 'clothes', 'ratios', 'options'));
    }

    /**
     * 値段新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 値段新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->price->create($request->input('price'));

        return redirect()->route('admin.prices.index')->with('success', '値段を登録しました。');
    }

    /**
     * 親値段詳細
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * 値段編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * 値段編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $price = $this->price->findOrFail($id);
        $price->update($request->input('price'));

        return redirect()->route('admin.prices.index')->with('success', '値段を更新しました。');
    }

    /**
     * 値段削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $price = $this->price->findOrFail($id);
        $price->delete();

        return redirect()->route('admin.prices.index')->with('success', '値段を削除しました。');
    }

    /**
     * 生地取得
     */
    public function ajaxGetClothes(Request $request) {

        $size_id = $request->get('size_id');
        $ratio_id = $request->get('ratio_id');

        $clothe_ids = $this->price->where('size_id', $size_id)->where('ratio_id', $ratio_id)
                        ->get()->sortBy('clothe_id')->pluck('clothe_id');
        $clothe_ids = array_unique($clothe_ids->toArray());
        $clothe_ids = array_values($clothe_ids);
        $clothes = [];

        foreach ($clothe_ids as $clothe_id) {
            $clothes[] = $this->clothe->findOrFail($clothe_id);
        }

        echo json_encode(['clothes' => $clothes]);

    }

    /**
     * 値段情報取得
     */
    public function ajaxGetPrice(Request $request) {
        $size_id = $request->get('size_id');
        $ratio_id = $request->get('ratio_id');
        $clothe_id = $request->get('clothe_id');

        $price = $this->price->where('size_id', $size_id)->where('ratio_id', $ratio_id)->where('clothe_id', $clothe_id)
            ->first();

        echo json_encode(['price' => $price]);
    }
}

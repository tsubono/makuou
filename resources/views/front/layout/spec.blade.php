@extends('front.layouts.default')

@push('css')

@endpush

@push('script')
    <script>

        $(function(){
            $("#optcheck").change(function(){
                optCheckVal = $("#optcheck:checked").val();

                if (optCheckVal == "1") {
                    $("#optinput1").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
                    $("#optinput2").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
                } else {
                    $("#optinput1").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
                    $("#optinput2").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
                }
            }).trigger("change");
        });

        //チェックボックスとラジオボタン連動
        function checkBox() {
            if (document.option.polecheck.checked == true) {
                document.option.pole[0].checked = true;
            } else {
                document.option.pole[0].checked = false;
                document.option.pole[1].checked = false;
                document.option.pole[2].checked = false;
                document.option.pole[3].checked = false;
            }
        }
        function radioButton() {
            if (document.option.pole[0].checked == true) {
                document.option.polecheck.checked = true;
            }
            if (document.option.pole[1].checked == true) {
                document.option.polecheck.checked = true;
            }
            if (document.option.pole[2].checked == true) {
                document.option.polecheck.checked = true;
            }
            if (document.option.pole[3].checked == true) {
                document.option.polecheck.checked = true;
            }
        }
    </script>

@endpush

@section('title', '仕様を決める')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout confirm">
                <h1 class="main__title">
                    <img src="{{asset("assets/img/layout/title_spec.png")}}" alt="仕様を決める">
                </h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{ url('/layout/'. $order_detail['product_id']) }}">レイアウトを作る</a></li>
                        <li><a>デザイン確認</a></li>
                        <li>仕様を決める</li>
                    </ul>
                    <form method="post" action="{{ url('layout/confirm2') }}" class="form_template" id="form1">
                        @csrf
                        <input type="hidden" name="order_detail[designed_filename]" value="{{ $order_detail['designed_filename'] }}">
                        <input type="hidden" name="order_detail[designed_image]" value="{{ $order_detail['designed_image'] }}">
                        <input type="hidden" name="order_detail[uploaded_files]" value="{{ $order_detail['uploaded_files'] }}">
                        <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">
                        <input type="hidden" name="order_detail[design_name]" value="{{ $order_detail['design_name'] }}">
                        <input type="hidden" name="order_detail[note]" value="{{ $order_detail['note'] }}">
                        <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">

                        <h2 class="ttl01">サイズを決める</h2>
                        <div class="form__bd">
                            <dl>
                                <dt>サイズ</dt>
                                <dd>
                                    <label><input type="radio" name="order_detail[size]" value="60" checked="checked">縦60cm</label>
                                    <label><input type="radio" name="order_detail[size]" value="90">縦90cm</label>
                                    <label><input type="radio" name="order_detail[size]" value="120">縦120cmm</label>
                                    <label><input type="radio" name="order_detail[size]" value="150">縦150cm</label>
                                    <label><input type="radio" name="order_detail[size]" value="180">縦180cm</label>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_two cf">
                            <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                            <div class="btn_return"><a href="/size/" target="_blank"><p>おすすめサイズ</p></a></div>
                        </div>
                        <h2 class="ttl01">素材を決める</h2>
                        <div class="form__bd">
                            <dl class="material">
                                <dt>素材</dt>
                                <dd>
                                    <ul>
                                        <li>
                                            <label><input type="radio" name="order_detail[material]" value="通常生地" checked="checked">通常生地</label>
                                            <label><input type="radio" name="order_detail[material]" value="メッシュ生地">メッシュ生地</label>
                                            <label><input type="radio" name="order_detail[material]" value="サテン生地">サテン生地</label>
                                            <label><input type="radio" name="order_detail[material]" value="強化ビニール生地">強化ビニール生地</label>
                                        </li>

                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_two">
                            <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                            <div class="btn_return"><a href="/material/" target="_blank"><p>素材紹介</p></a></div>
                        </div>
                        <h2 class="ttl01">オプションを選ぶ</h2>
                        <div class="form__bd">
                            <dl>
                                <dt>ハトメの位置</dt>
                                <dd>
                                    <label><input type="radio" name="order_detail[hatome]" value="通常" checked="checked">通常</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="上辺のみ">上辺のみ</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="左辺のみ">左辺のみ</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="ハトメなし">ハトメなし</label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>付属品</dt>
                                <dd>
                                    <ul class="option">
                                        <li class="rope">
                                            <p><label><input type="checkbox" name="" id="optcheck" value="1">ロープ</label></p>
                                            <ul class="cf">
                                                <li><input type="text" name="order_detail[lope_1]" id="optinput1"></li>
                                                <li><input type="text" name="order_detail[lope_2]" id="optinput2"></li>
                                            </ul>
                                        </li>
                                        <li class="pole">
                                            <p><label><input type="checkbox" name="polecheck" id="" value="旗用ポール" onclick="checkBox()">旗用ポール</label></p>
                                            <div>
                                                <label><input type="radio" name="order_detail[pole]" value="2m・3段伸縮" onclick="radioButton()">2m・3段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="3m・3段伸縮" onclick="radioButton()">3m・3段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="4m・4段伸縮" onclick="radioButton()">4m・4段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="5m・4段伸縮" onclick="radioButton()">5m・4段伸縮</label>
                                            </div>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt>納期</dt>
                                <dd class="delivery">
                                    <label><input type="radio" name="order_detail[nouki]" value="通常発送（2営業日後）" checked="checked">通常発送（2営業日後）</label>
                                    <label><input type="radio" name="order_detail[nouki]" value="特急発送※価格が20%アップします（翌営業日後）">特急発送※価格が20%アップします（翌営業日後）</label>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_one">
                            <div class="btn_return"><a href="/option/" target="_blank"><p>オプションについて</p></a></div>
                        </div>
                        <div class="btn"><input type="submit" name="submit" value="確認画面へ" /></div>
                    </form>
                </div>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
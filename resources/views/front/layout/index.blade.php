@extends('front.layouts.default_layout')

@push('css')
    <!-- bootstrap -->
    <link href="{{asset("bower_components/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}"
          rel="stylesheet" type="text/css"/>
    {{--type="text/css"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/font-awesome.min.css")}}">
    <!-- ionicons -->
    {{--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>--}}
    <link href="{{asset("bower_components/bootstrap-fileinput/css/fileinput.min.css")}}" media="all" rel="stylesheet"
          type="text/css"/>

    {{--<link href='https://fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka'--}}
          {{--rel='stylesheet' type='text/css'>--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset("css/normalize.css")}}">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset("css/ng-scrollbar.min.css")}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">
    {{--<link rel="stylesheet" type="text/css" href="{{asset("css/canvas_custom.css")}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/fonts.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap-colorpicker.min.css")}}">
    {{--<link rel="stylesheet" type="text/css" href="{{asset("css/angular-material.css")}}">--}}


    {{--<link href="{{asset("css/custom.css")}}" rel="stylesheet" type="text/css"/>--}}
    {{--<link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">--}}
    {{--<link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">--}}

    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/edit.css")}}">
@endpush

@push('script')
    <script>
        $(function() {
            $('.text__tab li').click(function() {
                var index = $('.text__tab li').index(this);
                $('.text__content > div:not(".other")').css('display','none');
                $('.text__content > div:not(".other")').eq(index).css('display','block');
                $('.text__tab li').removeClass('select');
                $(this).addClass('select');
            });
        });
        $(function() {
            $('.edit__tab li').click(function() {
                var index = $('.edit__tab li').index(this);
                if ($(this).hasClass('select')) {
                    if ($('.edit__wrap.other').css('display')=='none') {
                        $('.edit__hidden > div:not(".other")').css('display','none');
                        $('.edit__tab li').removeClass('select');
                        $('#productApp').scope().deactivateAll();
                        $('.edit__wrap.other').addClass('ng-hide');
                    }
                } else {
                    $('.edit__hidden > div:not(".other")').css('display','none');
                    $('.edit__hidden > div:not(".other")').eq(index).css('display','block');
                    $('.edit__tab li').removeClass('select');
                    $(this).addClass('select');
                    $('#productApp').scope().deactivateAll();
                    if ($('.edit__wrap.other').css('display')!='none') {
                        $('.edit__wrap.other').addClass('ng-hide');
                    }
                }
            });
        });
        $(function() {
            $('.edit__close').click(function() {
                $('.edit__hidden > div:not(".other")').css('display','none');
                $('.edit__tab li').removeClass('select');
            });

            $('.btn__back').click (function() {
                $('.edit__wrap.other').addClass('ng-hide');
            });
        });
    </script>
    {{--<script src="{{asset("assets/js/search.js")}}"></script>--}}
    <script>
        $(function () {

            var id = "{{ $product->id }}";

            // $('#productApp').scope().initFabric("{{ $product->ratio->width * 170.079 }}", 170.079);
            $('#productApp').scope().initFabric("{{ $product->ratio->width }}");
            $('#productApp').scope().loadProduct("{{ $product->title }}", "{{ $product->image }}", id, 0);

            setTimeout(function () {
                $('#productApp').scope().deactivateAll();

                @if (!empty($designed_json))
                    var json = "{{ $designed_json }}";
                    json = json.replace(/&quot;/g,'"')
                    .replace(/&#039;/g,"'")
                    .replace(/&lt;/g,"<")
                    .replace(/&gt;/g,">")
                    .replace(/&amp;/g,"&");

                @else
                    var json = $('#productApp').scope().getDesignJson();
                @endif

                $('#productApp').scope().loadByJson(json);

                // 編集中の商品ID更新
                $('#productApp').scope().defaultProductId = id;
                $('#productApp').scope().index = 0;

            }, 300);

            $('#save_design').click(function () {
                $('#productApp').scope().getPreSaveDatas();
            });

        });
    </script>

@endpush

@section('title', 'レイアウトを作る')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout">
                <!-- #productApp -->
                <div class="main__content" ng-controller="ProductCtrl" ng-app="productApp" id="productApp">

                    <div ng-show='fabric.selectedObject.type' class="edit_space">
                        <div class="text" ng-show="fabric.selectedObject.type == 'text'">
                            <input type="text" id="textarea-text" ng-model="fabric.selectedObject.text"
                                   placeholder="テキストを入力してください">
                        </div>
                        <div class="btn__custom">
                            <div class="" ng-show="fabric.selectedObject.type == 'text'">
                                <input type="button" name="" value="@{{ currentFontName }}" class="dropdown-toggle"
                                       data-toggle="dropdown">
                                <ul class="dropdown-menu font">
                                    <li ng-repeat='font in FabricConstants.fonts'
                                        ng-click='toggleFont(font.family, font.name);'
                                        style='font-family: "@{{ font.family }}";'>
                                        <a>@{{ font.name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div ng-show="fabric.selectedObject.type != 'image'">
                                <input type="button" name="" value="色を選ぶ" colorpicker
                                       ng-model="fabric.selectedObject.fill"
                                       ng-change="fillColor(fabric.selectedObject.fill);">
                            </div>
                        </div>
                        <div class="opacity">
                            <label>透明度 :</label>
                            <input type='range' min="0" max="1" step=".01" ng-model="fabric.selectedObject.opacity"
                                   ng-change="opacity(fabric.selectedObject.opacity);"/>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- 編集エリア -->
                    <div class="edit__area canvas_image image-builder ng-isolate-scope">
                        <div class='fabric-container'>
                            <div class="canvas-container-outer">
                                <canvas fabric='fabric' class="canvas"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /編集エリア -->
                    <!-- 操作エリア -->
                    <div class="edit__tools">
                        <h2>操作ツール</h2>
                        <ul>
                            <li>
                                <a ng-click="layers()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon01.png') }}" alt="">レイヤー一覧
                                </a>
                            </li>
                            <li>
                                <a ng-click="copyItem()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon02.png') }}" alt="">コピー
                                </a>
                            </li>
                            <li>
                                <a ng-click="pasteItem()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon03.png') }}" alt="">貼り付け
                                </a>
                            </li>
                            <li>
                                <a ng-click="forwardSwap()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon04.png') }}" alt="">前面に移動
                                </a>
                            </li>
                            <li>
                                <a ng-click="backwordSwap()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon05.png') }}" alt="">背面に移動
                                </a>
                            </li>
                            <li>
                                <a ng-click="horizontalAlign()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon06.png') }}" alt="">水平に備える
                                </a>
                            </li>
                            <li>
                                <a ng-click="verticalAlign()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon07.png') }}" alt="">垂直に揃える
                                </a>
                            </li>
                            <li>
                                <a ng-click="{ active: flipObject() }" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon08.png') }}" alt="">左右反転
                                </a>
                            </li>
                            <li>
                                <a ng-click="lockObject()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon11.png') }}" alt="">レイヤーロック
                                </a>
                            </li>
                            <li>
                                <a ng-click="undo()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon09.png') }}" alt="">戻る
                                </a>
                            </li>
                            <li>
                                <a ng-click="redo()" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/layout/icon10.png') }}" alt="">進む
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /操作エリア -->
                    <!-- レイヤー一覧 -->
                    <div class="edit__layer">
                        <h2>レイヤー一覧</h2>
                        <div class="layer__list">
                            <div ng-repeat="layer in objectLayers" ng-click="selectObject(layer.object);">
                                <img ng-src="@{{layer.src}}" alt=""/>
                            </div>
                        </div>
                    </div>
                    <!-- /レイヤー一覧 -->
                    <!-- 下部コントロールメニュー -->
                    <nav class="edit__tools__foot">
                        <div class="tools__inner">
                            <div class="btn"><a href="{{ url('/result?') }}">デザイン一覧へ戻る</a></div>
                            <ul class="edit__tab">
                                <li><img src="{{ asset('assets/img/layout/icon_txt.png') }}" alt="">テキスト追加・編集</li>
                                <li><img src="{{ asset('assets/img/layout/icon_img.png') }}" alt="">写真のアップロード</li>
                                <li><img src="{{ asset('assets/img/layout/icon_stamp.png') }}" alt="">スタンプ追加・編集</li>
                            </ul>

                            <!-- 確認画面へのform -->
                            <div class="btn">
                                <form method="post" action="{{ url('/layout/confirm') }}" name="confirmForm">
                                    @csrf
                                    <input type="hidden" name="order_detail[designed_filename]" value="">
                                    <input type="hidden" name="order_detail[designed_image]" value="">
                                    <input type="hidden" name="order_detail[uploaded_files]" value="">
                                    <input type="hidden" name="order_detail[json]" value="">
                                    <input type="hidden" name="order[user_id]"
                                           value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                                    <input type="hidden" name="order_detail[product_id]" value="{{ $product->id }}">
                                    <input type="hidden" name="order_detail[ratio_id]" value="{{ $product->ratio_id }}">
                                    <input type="hidden" name="path" value="{{ url('/') }}">
                                    <input type="hidden" name="asset" value="{!! asset(env('PUBLIC', '')) !!}">
                                    <input type="hidden" class="order_details_json" name="order_details_json" value=""
                                           data-index="0">
                                    <div class="svgElements" style="display: none;"></div>
                                    <a href="#" id="save_design">確認ページへ進む</a>
                                </form>
                            </div>
                            <!-- /確認画面へのform -->

                        </div>
                    </nav>
                    <!-- /下部コントロールメニュー -->
                    <!-- 下部コントロール内容 -->
                    <div class="edit__hidden">
                        <div class="edit__wrap" id="text_design">
                            <div class="edit__text">
                                <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                                    <div class="text__content">
                                        <div>
                                            <input type="text" name="" id="textarea-text" ng-model="fabric.selectedObject.text" placeholder="テキストを入力してください">
                                            <div class="clearfix">
                                                <div class="btn__add"><input type="button" class="edit__close" value="テキストを追加" ng-click="addText()"></div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="edit__wrap">
                            <div class="edit__image">
                                <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                                <form name="myForm">
                                    <div class="drop__area">
                                        <div ngf-select="onFileSelect(picFile);" ngf-drop="onFileSelect(picFile);"
                                                 ng-model="picFile"
                                                 accept="image/*" ngf-drag-over-class="dragOverClassObj"
                                                 ngf-max-size="2MB" class="upload drop-box"
                                                 ngf-drop-available="dropAvailable">
                                                ファイルを選択もしくはドラッグ&ドロップしてください
                                        </div>
                                        <input id="uploadFile" placeholdFile NameName disabled="disabled"/>
                                        <span class="has-error" ng-show="myForm.file.$error.maxSize">File too large @{{picFile.size / 1000000|number:1}}MB: max 2M</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="myForm.file.$error.maxWidth">File width too large : Max Width 300px</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="myForm.file.$error.maxHeight">File height too large : Max Height 300px</span>
                                        <div class="clearfix"></div>
                                        <span class="has-error" ng-show="uploadErrorMsg">@{{uploadErrorMsg}}</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="edit__wrap">
                            <div class="edit__stamp">
                                <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                                <div ng-show="!graphic_icons" class="graphic_types clearfix">
                                    <div ng-repeat="stampCategory in stampCategories" value="@{{stampCategory}}" class=""
                                             ng-click="loadByStampCategory(stampCategory.id)" ng-model="stampCategory">
                                            <div style="background-image: url({!! asset(env('PUBLIC', '')) !!}@{{stampCategory.image}})"></div>
                                            <span>@{{stampCategory.name}}</span>
                                    </div>
                                </div>
                                <span ng-show="graphic_icons" class="back_to_graphic" ng-click="ShowGraphicIcons()">
                                    <i class="fa fa-angle-left"></i> スタンプカテゴリ一覧に戻る
                                </span>
                                <div class="graphic_icons" ng-show="graphic_icons">
                                    <div class="thumb_listing scrollme" rebuild-on="rebuild:me" ng-scrollbar
                                         is-bar-shown="barShown"
                                         ng-class="fabric.selectedObject ? 'activeControls' : ''">
                                        <ul>
                                            <li ng-repeat="stamp in stamps">
                                                <a href="javascript:void(0);" ng-click='addShape(stamp.image)'>
                                                    <img data-ng-src="{!! asset(env('PUBLIC', '')) !!}@{{stamp.image}}"
                                                         alt="" width="120px;">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /下部コントロール内容 -->
                </div>
                <!-- /#productApp -->
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
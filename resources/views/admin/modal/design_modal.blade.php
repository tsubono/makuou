<div class="modal fade" id="design-modal" tabindex="-1" role="dialog"
     aria-labelledby="design-modal-label">
    <div class="modal-dialog" role="document" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="path" value="{{ url('/') }}">
                <input type="hidden" name="asset" value="{!! asset(env('PUBLIC', '')) !!}">

                <div class="row justify-content-center">
                    <div class="container ng-scope" ng-controller="ProductCtrl" ng-app="productApp" id="productApp">
                        <!-- ローディング時に表示 -->
                        <div ng-show="!isloaded" class="loading">
                            <h1 class="lodingMessage">Initializing Design Tool<img src="{!! asset(env('PUBLIC', ''). '/images/ajax-loader.gif') !!}"></h1>
                        </div>
                        <!--// ローディング時に表示 -->

                        <!-- canvas -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 canvas_section pt20">
                            <div class="row">
                                <!-- 上部左側コントローラー -->
                                <div class="icon-horizontal">
                                    <ul>
                                        <li>
                                            <a ng-click="layers()" href="javascript:void(0)" data-toggle="tab"
                                               class="fa fa-object-ungroup layer_list_btn"></a>
                                            <md-tooltip md-visible="layer.showTooltip" md-direction="top">レイヤー一覧</md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="copyItem()" href="javascript:void(0)" class="fa fa-copy"></a>
                                            <md-tooltip md-visible="copy.showTooltip" md-direction="top">コピー</md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="pasteItem()" href="javascript:void(0)" class="fa fa-paste"></a>
                                            <md-tooltip md-visible="paste.showTooltip" md-direction="top">ペースト</md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="forwardSwap()" href="javascript:void(0)"
                                               class="fa fa-mail-forward"></a>
                                            <md-tooltip md-visible="forward.showTooltip" md-direction="top">前方に移動</md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="backwordSwap()" href="javascript:void(0)" class="fa fa-mail-reply"></a>
                                            <md-tooltip md-visible="backward.showTooltip" md-direction="top">後方に移動
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="horizontalAlign()" href="javascript:void(0)"
                                               class="fa fa-arrows-h"></a>
                                            <md-tooltip md-visible="horizontal.showTooltip" md-direction="top">水平に揃える
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="verticalAlign()" href="javascript:void(0)" class="fa fa-arrows-v"></a>
                                            <md-tooltip md-visible="vertical.showTooltip" md-direction="top">垂直に揃える
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="{ active: flipObject() }" href="javascript:void(0)"
                                               class="fa fa-exchange fa-2"></a>
                                            <md-tooltip md-visible="flip.showTooltip" md-direction="top">反転</md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="lockObject()" ng-class="isLocked() ? 'fa fa-lock' : 'fa fa-unlock'"
                                               href="#"></a>
                                            <md-tooltip md-visible="lock.showTooltip" md-direction="top">Lock Layer
                                            </md-tooltip>
                                        </li>
                                        <li>
                                            <a ng-click="removeSelectedObject()" href="javascript:void(0)"
                                               class="fa fa-eraser"></a>
                                            <md-tooltip md-visible="remove.showTooltip" md-direction="top">Remove Layer
                                            </md-tooltip>
                                        </li>
                                    </ul>
                                </div>
                                <!--// 上部左側コントローラー -->

                                <!-- 上部右側コントローラー -->
                                <div class="icon-horizontal m-b-sm right right90">
                                    <ul>
                                        <li class="pull-left">
                                            <a class="fa fa-undo ng-scope ng-isolate-scope" translate="" ng-click="undo()"
                                               href="javascript:void(0)"><span class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="undo.showTooltip" md-direction="top">戻る
                                            </md-tooltip>
                                        </li>
                                        <li class="pull-left">
                                            <a class="fa fa-repeat ng-scope ng-isolate-scope" translate="" ng-click="redo()"
                                               href="javascript:void(0)"><span class="ng-binding ng-scope"></span></a>
                                            <md-tooltip md-visible="redo.showTooltip" md-direction="top">進む
                                            </md-tooltip>
                                        </li>
                                    </ul>
                                </div>
                                {{--<a class="btn btn-primary right" href="javascript:void(0)" ng-click="saveDesignImage()"--}}
                                   {{--ng-class="(activeSavedDesignId!=0) ? 'right90' : 'right0'">--}}
                                    {{--保存する--}}
                                {{--</a>--}}
                                {{--<a class="btn btn-danger right right0" href="javascript:void(0)" ng-click="deleteDesign()"--}}
                                   {{--ng-show="activeSavedDesignId!=0">--}}
                                    {{--削除する--}}
                                {{--</a>--}}
                                <!--// 上部右側コントローラー -->

                                <!-- canvas本体 -->
                                <div class="canvas_image image-builder ng-isolate-scope">
                                    <div class='fabric-container'>
                                        <div class="canvas-container-outer">
                                            <canvas fabric='fabric' class="canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!--// canvas本体 -->
                            </div>
                        </div>
                        <!--// canvas -->
                        <div class="canvas_layers">
                            <ul>
                                <li ng-repeat="layer in objectLayers" class="ng-scope" ng-click="selectObject(layer.object);">
                                    <img ng-src="@{{layer.src}}" alt=""/>
                                </li>
                            </ul>
                        </div>

                        <div class="row clearfix clear" ng-cloak>
                            <!-- 編集コントロール諸々 -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 editor_section" style="height: 400px;overflow: auto;">
                                <div id="content" class="tabing">
                                    <!-- 最上部タブ -->
                                    <ul id="tabs" class="nav nav-tabs design_modal" data-tabs="tabs">
                                        {{--<li class="active productsTab">--}}
                                            {{--<a ng-click="deactivateAll()" href="#Products" class="products" data-toggle="tab"><i--}}
                                                        {{--class="glyphicon glyphicon-shopping-cart"></i>--}}
                                                {{--アイテム--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        <li>
                                            <a ng-click="addTextByAction()" href="#Text" class="text" data-toggle="tab"><i
                                                        class="glyphicon glyphicon-text-size"></i>
                                                テキスト
                                            </a>
                                        </li>
                                        <li>
                                            <a ng-click="deactivateAll()" href="#upload_own" class="graphics" aria-controls="upload_own"
                                               role="tab" data-toggle="tab">
                                                <i class="fa fa-cloud-upload"></i>
                                                <span>写真</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a ng-click="deactivateAll()" href="#clip_arts" class="graphics" aria-controls="clip_arts"
                                               role="tab" data-toggle="tab">
                                                <i class="fa fa-certificate"></i>
                                                <span>スタンプ</span>
                                            </a>
                                        </li>
                                        {{--<li>--}}
                                            {{--<a ng-click="deactivateAll()" href="#saved" class="saved" aria-controls="saved"--}}
                                               {{--role="tab" data-toggle="tab">--}}
                                                {{--<i class="glyphicon glyphicon-ok"></i>--}}
                                                {{--保存済み--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                    <!--// 最上部タブ -->
                                    <!-- タブ内容 -->
                                    <div id="my-tab-content" class="tab-content action_tabs">
                                        <!-- アイテム -->
                                        {{--<div class="tab-pane active clearfix" id="Products">--}}
                                            {{--<!--<h1>アイテム</h1>-->--}}
                                            {{--<div class="col-lg-12 thumb_listing">--}}
                                                {{--<ul>--}}
                                                    {{--<li ng-repeat="prod in products | orderBy:predicate:reverse"--}}
                                                        {{--ng-class="(defaultProductId == prod.id) ? 'selected' : ''"--}}
                                                        {{--ng-if="hasCategory(prod)">--}}
                                                        {{--<a href="javascript:void(0);"--}}
                                                           {{--ng-click="loadProduct(prod.title, prod.image_600_layout, prod.id);">--}}
                                                            {{--<img data-ng-src="@{{prod.image_600_layout}}" alt=""></a>--}}
                                                        {{--<span class="product_title">@{{prod.title}}</span>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <!--// アイテム -->
                                        <!-- テキスト -->
                                        <div class="tab-pane clearfix" id="Text">
                                            <div class="graphic_options clearfix">
                                                <ul>
                                                    <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6 active">
                                                        <div>
                                                            <a href="#text_design" aria-controls="text_design" role="tab" data-toggle="tab">
                                                                <i class="fa fa-font"></i>
                                                                <span>Text Design</span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="text_design">
                                                    <div class="col-lg-12 thumb_listing">
                                                        <div class="well">
                                                            <div class="row form-group">
                                                                <md-input-container flex>
                                                                    <label>テキストを入力してください</label>
                                                                    <textarea columns="1" id="textarea-text"
                                                                              ng-model="fabric.selectedObject.text"></textarea>
                                                                </md-input-container>

                                                                <div class="clearfix">
                                                                    <md-button class="md-raised md-cornered" ng-click="addText()"
                                                                               aria-label="テキストを追加"><i class="fa fa-plus"></i>&nbsp;&nbsp;テキストを追加
                                                                    </md-button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// テキスト -->
                                        <!-- 写真 -->
                                        <div role="tabpanel" class="tab-pane clearfix fade" id="upload_own">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well sideview">
                                                    <form name="myForm">
                                                        <div ngf-select="onFileSelect(picFile);" ngf-drop="onFileSelect(picFile);"
                                                             ng-model="picFile"
                                                             accept="image/*" ngf-drag-over-class="dragOverClassObj"
                                                             ngf-max-size="2MB" class="upload drop-box" ngf-drop-available="dropAvailable">
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// 写真 -->
                                        <!-- スタンプ -->
                                        <div role="tabpanel" class="tab-pane clearfix fade" id="clip_arts">
                                            <div class="graphic_types clearfix" ng-show="!graphic_icons">
                                                <div ng-repeat="stampCategory in stampCategories" value="@{{stampCategory}}"
                                                     ng-click="loadByStampCategory(stampCategory.id)" ng-model="stampCategory">
                                                    <div style="background-image: url({!! asset(env('PUBLIC', '')) !!}@{{stampCategory.image}})"></div>
                                                    <span>@{{stampCategory.name}}</span>
                                                </div>
                                            </div>
                                            <span ng-show="graphic_icons" class="back_to_graphic" ng-click="ShowGraphicIcons()">
                                    <i class="fa fa-angle-left"></i> スタンプカテゴリ一覧に戻る
                                </span>
                                            <div class="graphic_icons" ng-show="graphic_icons">
                                                <div class="col-lg-12 thumb_listing scrollme" rebuild-on="rebuild:me" ng-scrollbar
                                                     is-bar-shown="barShown" ng-class="fabric.selectedObject ? 'activeControls' : ''">
                                                    <ul>
                                                        <li ng-repeat="stamp in stamps">
                                                            <a href="javascript:void(0);" ng-click='addShape(stamp.image)'>
                                                                <img data-ng-src="{!! asset(env('PUBLIC', '')) !!}@{{stamp.image}}" alt="" width="120px;">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// スタンプ -->
                                        <!-- レイヤー -->
                                        <div class="tab-pane clearfix" id="Layers">
                                            <h1>Layers</h1>
                                            <div class="col-lg-12 layer_listing scrollme" rebuild-on="rebuild:layer" ng-scrollbar
                                                 is-bar-shown="barShown">

                                                <ul class="ul_layer_canvas row">

                                                    <li ng-repeat="layer in objectLayers" class="ng-scope">
                                                        <span>@{{layer.id}}</span>
                                                        <img ng-src="@{{layer.src}}" alt=""/>

                                                        <div class="f-right inner">
                                                            <ul class="ulInner actions">
                                                                <li class="liActions"><a href="javascript:void(0)"
                                                                                         ng-click="deleteObject(layer.object);"><i
                                                                                class="fa fa-trash"></i></a></li>
                                                                <li class="liActions"><a href="javascript:void(0)"
                                                                                         ng-click="objectForwardSwap(layer.object);"><i
                                                                                class="fa fa-chevron-up"></i></a></li>
                                                                <li class="liActions"><a href="javascript:void(0)"
                                                                                         ng-click="objectBackwordSwap(layer.object);"><i
                                                                                class="fa fa-chevron-down"></i></a></li>
                                                                <li class="liActions"><a href="javascript:void(0)"
                                                                                         ng-click="lockLayerObject(layer.object);"><i
                                                                                class="fa"
                                                                                ng-class="isObjectLocked(layer.object) ? 'fa-lock' : 'fa-unlock'"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--// レイヤー -->
                                        <!-- 保存済み -->
                                        {{--<div class="tab-pane clearfix" id="saved">--}}
                                            {{--<div class="col-lg-12 thumb_listing">--}}
                                                {{--<ul>--}}
                                                    {{--<li ng-repeat="savedDesign in savedDesigns">--}}
                                                        {{--<a href="javascript:void(0);" ng-click='loadBySavedData(savedDesign)'>--}}
                                                            {{--<img data-ng-src="@{{savedDesign.image}}" alt=""--}}
                                                                 {{--style="max-width: 150px;">--}}
                                                        {{--</a>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        <!--// 保存済み -->
                                    </div>
                                    <!--// タブ内容 -->
                                </div>
                                <div class="col-lg-12 setting" ng-class="fabric.selectedObject ? 'activeControlsElem' : ''"
                                     ng-if='fabric.selectedObject.type' ng-switch='fabric.selectedObject.type'>
                                    <div class="close-circle">
                                        <i class="fa fa-angle-left" ng-click="deactivateAll();">
                                            <span>追加画面に戻る</span>
                                        </i>
                                    </div>
                                    <div class="well">
                                        <div class="row form-group" ng-show="fabric.selectedObject.type == 'text'">
                                            <!-- テキスト入力 -->
                                            <md-input-container flex>
                                                <label>テキストを入力してください</label>
                                                <textarea columns="1" id="textarea-text"
                                                          ng-model="fabric.selectedObject.text"></textarea>
                                            </md-input-container>
                                            <!--// テキスト入力 -->
                                        </div>
                                        <div class="row form-group" ng-show="fabric.selectedObject.type == 'text'"
                                             style="position: relative;">
                                            <!-- フォント形式選択 -->
                                            <label>フォントを選択してください</label>
                                            <md-button class="md-raised md-cornered dropdown-toggle" data-toggle="dropdown"
                                                       aria-label="Font Family">
                            <span class='object-font-family-preview'
                                  style='font-family: "@{{ fabric.selectedObject.fontFamily }}";'> @{{ fabric.selectedObject.fontFamily }} </span>
                                                <span class="caret"></span>
                                            </md-button>
                                            <ul class="dropdown-menu">
                                                <li ng-repeat='font in FabricConstants.fonts' ng-click='toggleFont(font.name);'
                                                    style='font-family: "@{{ font.name }}";'>
                                                    <a>@{{ font.name }}</a>
                                                </li>
                                            </ul>
                                            <!--// フォント形式選択 -->
                                        </div>
                                        <div class="row row-margin">
                                            <div class="row col-lg-6" title="Font size" ng-show="fabric.selectedObject.type == 'text'">
                                                <!-- フォントサイズ入力 -->
                                                <md-input-container flex>
                                                    <label><i class="fa fa-text-height"></i> ( フォントの大きさ )</label>
                                                    <input type='number' class="" ng-model="fabric.selectedObject.fontSize"/>
                                                </md-input-container>
                                                <!--// フォントサイズ入力 -->
                                            </div>
                                            <div class="row col-lg-6" title="Line height" ng-show="fabric.selectedObject.type == 'text'">
                                                <!-- 行間入力 -->
                                                <md-input-container flex>
                                                    <label><i class="fa fa-align-left"></i> ( 行間 )</label>
                                                    <input type='number' class="" ng-model="fabric.selectedObject.lineHeight" step=".1"/>
                                                </md-input-container>
                                                <!--// 行間入力 -->
                                            </div>
                                        </div>
                                        <!-- テキスト操作諸々 -->
                                        <div class='row form-group' ng-show="fabric.selectedObject.type == 'text'">
                                            <md-button class="md-raised md-cornered"
                                                       ng-class="{ active: fabric.selectedObject.textAlign == 'left' }"
                                                       ng-click="fabric.selectedObject.textAlign = 'left'" aria-label="Align Left"><i
                                                        class='fa fa-align-left'></i></md-button>
                                            <md-button class="md-raised md-cornered"
                                                       ng-class="{ active: fabric.selectedObject.textAlign == 'center' }"
                                                       ng-click="fabric.selectedObject.textAlign = 'center'" aria-label="Align Center"><i
                                                        class='fa fa-align-center'></i></md-button>
                                            <md-button class="md-raised md-cornered"
                                                       ng-class="{ active: fabric.selectedObject.textAlign == 'right' }"
                                                       ng-click="fabric.selectedObject.textAlign = 'right'" aria-label="Align Right"><i
                                                        class='fa fa-align-right'></i></md-button>
                                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isBold() }"
                                                       ng-click="toggleBold()" aria-label="Bold"><i class='fa fa-bold'></i></md-button>
                                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isItalic() }"
                                                       ng-click="toggleItalic()" aria-label="Italic"><i class='fa fa-italic'></i>
                                            </md-button>
                                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isUnderline() }"
                                                       ng-click="toggleUnderline()" aria-label="Underline"><i class='fa fa-underline'></i>
                                            </md-button>
                                            <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isLinethrough() }"
                                                       ng-click="toggleLinethrough()" aria-label="Strike through"><i
                                                        class='fa fa-strikethrough'></i></md-button>
                                        </div>
                                        <!--// テキスト操作諸々 -->
                                        <!-- 色選択 -->
                                        <div class="row form-group input-group colorPicker2 pt20"
                                             ng-show="fabric.selectedObject.type != 'image' && fabric.selectedObject.type != 'path'">
                                            <md-input-container flex>
                                                <label for="Color">色:</label>
                                                <input type="text" value="" class="" colorpicker ng-model="fabric.selectedObject.fill"
                                                       ng-change="fillColor(fabric.selectedObject.fill);"/>
                                            </md-input-container>
                                            <span class="input-group-addon"
                                                  style="border: medium none #000000; background-color: '@{{fabric.selectedObject.fill}}'"><i></i></span>
                                        </div>
                                        <!--// 色選択 -->
                                        <!-- 透明度選択 -->
                                        <div class="row form-group transparency">
                                            <md-input-container flex>
                                                <label for="Transparency">透明度:</label>
                                                <input class='col-sm-12' title="透明度" type='range' min="0" max="1" step=".01"
                                                       ng-model="fabric.selectedObject.opacity"
                                                       ng-change="opacity(fabric.selectedObject.opacity);"/>
                                            </md-input-container>
                                        </div>
                                        <!--// 透明度選択 -->
                                    </div>
                                </div>
                            </div>
                            <!--// 編集コントロール諸々 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="save_design">
                    確定
                </button>
                <button type="button" class="btn btn-sm btn-default" id="cancel_design">
                    キャンセル
                </button>
            </div>
        </div>
    </div>
</div>



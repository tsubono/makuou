'use strict';
angular.module('productApp', [
    'common.fabric',
    'common.fabric.utilities',
    'common.fabric.constants',
    'colorpicker.module',
    'ngSanitize',
    'ngMaterial',
    'ngScrollbar',
    'ngFileUpload'
]).controller('ProductCtrl', [
    '$scope',
    'Fabric',
    'FabricConstants',
    'Keypress',
    '$http',
    '$timeout',
    '$mdDialog',
    '$mdToast',
    'Upload',
    '$q',
    function ($scope, Fabric, FabricConstants, Keypress, $http, $timeout, $mdDialog, $mdToast, Upload, $q) {


        /*
         * 初期化
         */
        $scope.fabric = null;
        $scope.status = '  ';
        var _this = this;
        var last = {
            bottom: true,
            top: false,
            left: false,
            right: true
        };

        $scope.products = [];
        $scope.stamps = [];
        $scope.savedDesigns = [];
        $scope.objectLayers = [];
        $scope.isloaded = false;
        $scope.alertMessage = '';
        $scope.activeDesignObject = 0;
        $scope.isMenuClicked = true;
        $scope.FabricConstants = FabricConstants;
        $scope.activeSavedId = 0;
        $scope.validatedFlg = false;
        $scope.currentFontName = '';

        $scope.path = "";


        /*
         * スタンプ追加
         */
        $scope.addShape = function (path) {
            $scope.fabric.addShape(jQuery('[name=asset]').val() + path, false);

            $timeout(function () {
                $scope.deactivateAll();
            }, 100);
        };

        /*
         * 画像追加
         */
        $scope.addImage = function (image) {
            $scope.fabric.addImage(image);
        };

        /*
         * 画像が選択された場合に実行
         */
        $scope.onFileSelect = function (file) {

            var user_id = 1;
            if (file !== null) {
                var filename = user_id + Math.random().toString(36).slice(-8) + ".png";

                Upload.upload({
                    type: 'save_tmp_image',
                    url: $scope.path + '/canvas/uploadImage',
                    file: file,
                    data: {
                        file: Upload.rename(file, filename)
                    }
                }).then(function (data) {
                    var path = angular.fromJson(angular.toJson(data.data));

                    $scope.fabric.addImage(path);

                    $timeout(function () {
                        $scope.deactivateAll();
                    }, 100);

                }, function (data) {
                    // console.log('Error');
                }, function (evt) {
                });
            }
        };

        /*
         * デザインを削除する
         */
        $scope.clearCanvas = function () {

            $scope.fabric.clearCanvas();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();

        };

        /*
         * レイヤーを削除する
         */
        $scope.removeSelectedObject = function () {

            // var confirm = $mdDialog.confirm()
            //     .title('')
            //     .content('選択中のレイヤーが削除されます。本当に削除してもよろしいでしょうか。')
            //     .ariaLabel('Confirm')
            //     .ok('Ok')
            //     .cancel('Cancel');
            // $mdDialog.show(confirm).then(function () {
            //     $scope.fabric.deleteActiveObject();
            //     $scope.fabric.setDirty(true);
            //     $scope.objectLayers = [];
            //     $scope.objectLayers = $scope.fabric.canvasLayers();
            // });

            $scope.fabric.deleteActiveObject();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * アクティブな選択を解除する
         */
        $scope.deactivateAll = function () {
            $scope.fabric.deactivateAll();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            $scope.$broadcast('rebuild:me');
        };

        /*
         * 垂直方向を揃える
         */
        $scope.verticalAlign = function () {
            $scope.fabric.centerV();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 水平方向を揃える
         */
        $scope.horizontalAlign = function () {
            $scope.fabric.centerH();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 後方に移動
         */
        $scope.backwordSwap = function () {
            $scope.fabric.sendBackwards();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 後方に移動 (レイヤー一覧から)
         */
        $scope.objectBackwordSwap = function (object) {
            $scope.fabric.objectSendBackwards(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 前方に移動
         */
        $scope.forwardSwap = function () {
            $scope.fabric.bringForward();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 前方に移動 (レイヤー一覧から)
         */
        $scope.objectForwardSwap = function (object) {
            $scope.fabric.objectBringForward(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * レイヤー一覧
         */
        $scope.layers = function () {

            $scope.deactivateAll();

            var activeTab;
            activeTab = $('#tabs').find('li.active');
            $("#my-tab-content > div.active").removeClass('active');
            $(activeTab).removeClass('active');
            $('#Layers').addClass('active');
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            $scope.$broadcast('rebuild:layer');
        };

        /*
         * コピーする
         */
        $scope.copyItem = function () {
            if ($scope.fabric.copyItem() == 'DONE') {
                _this.showNotification('コピーしました。', false);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
            }
        };

        /*
         * ペーストする
         */
        $scope.pasteItem = function () {
            if ($scope.fabric.pasteItem() == 'DONE') {
                _this.showNotification('ペーストしました。', false);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
            }
        };

        /*
         * テキストを追加する
         */
        $scope.addText = function () {
            var text = window.btoa(unescape(encodeURIComponent($scope.fabric.selectedObject.text)));
            $scope.fabric.addText(decodeURIComponent(escape(window.atob(text))));
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * テキスト追加アクション
         */
        $scope.addTextByAction = function () {

            $scope.deactivateAll();

            if ($scope.fabric.checkBackgroundImage() && $scope.isMenuClicked) {
                $scope.fabric.addText();
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
                $scope.isMenuClicked = false;
            }
        };

        /*
         * ロックする
         */
        $scope.lockObject = function () {
            $scope.fabric.toggleLockActiveObject();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * ロックする (レイヤー一覧から)
         */
        $scope.lockLayerObject = function (object) {
            $scope.fabric.toggleLockObject(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 反転する
         */
        $scope.flipObject = function () {
            $scope.fabric.toggleFlipX();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        // /*
        //  * デザインを印刷する
        //  */
        // $scope.printObject = function () {
        //     $scope.fabric.printCanvasObject();
        //     $scope.objectLayers = [];
        //     $scope.objectLayers = $scope.fabric.canvasLayers();
        // };

        /*
         * 編集を戻す
         */
        $scope.undo = function () {
            $scope.fabric.undo();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 編集を進める
         */
        $scope.redo = function () {
            $scope.fabric.redo();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * ズームイン,ズームアウトする
         */
        $scope.zoomObject = function (action) {

            if (action == 'zoomin') {
                $scope.fabric.zoomInObject();
            } else if (action == 'zoomout') {
                $scope.fabric.zoomOutObject();
            } else {
                $scope.fabric.resetZoom();
            }
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 太字にする
         */
        $scope.toggleBold = function () {
            $scope.fabric.toggleBold();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * イタリック体にする
         */
        $scope.toggleItalic = function () {
            $scope.fabric.toggleItalic();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 下線を引く
         */
        $scope.toggleUnderline = function () {
            $scope.fabric.toggleUnderline();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * 打ち消し線を引く
         */
        $scope.toggleLinethrough = function () {
            $scope.fabric.toggleLinethrough();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * フォント形式を変更する
         */
        $scope.toggleFont = function (font, name) {
            $scope.fabric.selectedObject.fontFamily = font;
            $scope.currentFontName = name;
            jQuery('.object-font-family-preview').text(name);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
        };

        /*
         * レイヤーにロックがかかっているか
         */
        $scope.isLocked = function () {
            if ($scope.fabric != null) {
                return $scope.fabric.isLocked();
            } else {
                return false;
            }
        };

        /*
         * レイヤーにロックがかかっているか（レイヤー一覧から）
         */
        $scope.isObjectLocked = function (object) {
            return $scope.fabric.isObjectLocked(object);
        };

        /*
         * Ajax用ハンドラー
         */
        $scope.$on('AjaxCallHappened', function (event, data) {
            _this.showNotification(data.message, false);
        });

        /*
         * 色変更
         */
        $scope.fillColor = function (value) {
            $scope.fabric.selectedObject.fill = value;
        };

        /*
         * 透明度変更
         */
        $scope.opacity = function (value) {
            $scope.fabric.selectedObject.opacity = value;
        };

        /*
         * レイヤーを削除する（レイヤー一覧から）
         */
        $scope.deleteObject = function (object) {
            // var confirm = $mdDialog.confirm()
            //     .title('')
            //     .content('本当に削除してもよろしいでしょうか。')
            //     .ariaLabel('Confirm')
            //     .ok('Ok')
            //     .cancel('Cancel');
            // $mdDialog.show(confirm).then(function () {
            //     $scope.fabric.deleteObject(object);
            //     $scope.fabric.setDirty(true);
            //     $scope.objectLayers = [];
            //     $scope.objectLayers = $scope.fabric.canvasLayers();
            //     $scope.$broadcast('rebuild:layer');
            // });
            $scope.fabric.deleteObject(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            $scope.$broadcast('rebuild:layer');
        };

        /*
         * レイヤーを選択状態にする
         */
        $scope.selectObject = function (object) {
            $scope.fabric.selectActiveObject(object);
        };

        /*
         * 保存前に実行
         */
        $scope.beforeSave = function () {
            $scope.fabric.designedSVGObjects[$scope.activeDesignObject] = $scope.fabric.saveCanvasObjectAsSvg();
            $scope.fabric.designedPNGObjects[$scope.activeDesignObject] = $scope.fabric.saveCanvasObjectAsPng();
            $scope.fabric.designedJPGObjects[$scope.activeDesignObject] = $scope.fabric.saveCanvasObjectAsJpg();
        };

        /*
         * URLクエリ変換
         */
        this.transformRequest = function (obj) {
            var str = [];
            for (var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        };

        /*
         * カテゴリからスタンプ一覧読み込み
         */
        $scope.loadByStampCategory = function (val) {
            $scope.stampCategoryId = val;
            _this.initStamps();
            $scope.graphic_icons = true;
        };

        /*
         * スタンプ一覧に戻る
         */
        $scope.ShowGraphicIcons = function () {
            $scope.graphic_icons = false;
        };

        /*
         * スタンプカテゴリ一覧セット
         */
        this.initStampCategories = function () {
            $http({
                method: 'post',
                url: $scope.path + "/canvas/getStampCategories",
                data: {},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {
                $scope.stampCategories = data.stampCategories;
            }).error(function (data, status, headers, config) {
            });
        };

        /*
         * スタンプ一覧セット
         */
        this.initStamps = function () {

            var stampCategoryId = $scope.stampCategoryId;

            $http({
                method: 'post',
                url: $scope.path + "/canvas/getStamps",
                data: {
                    stamp_category_id: stampCategoryId
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {
                $scope.stamps = data.stamps;
            }).error(function (data, status, headers, config) {
            });
        };

        /*
         * 初期設定
         */
        $scope.init = function () {

            $scope.stampCategoryId = 1;
            $scope.predicate = "id";
            $scope.reverse = false;
            $scope.loadMore = true;
            $scope.defaultProductId = 1;
            $scope.index = 0;
            $scope.path = jQuery('[name=path]').val();
            $scope.currentFontName = 'ゴシック体';


            // 各一覧読み込み
            _this.initStampCategories();
            _this.initStamps();

            jQuery(document).on("change", ".upload", function () {
                jQuery("#uploadFile").val($(this).val());
            });

            jQuery(window).load(function () {
                // jQuery(".editor_section").height(jQuery(".canvas_section").height());
                jQuery("#Products .thumb_listing ul > li:first-child a").trigger("click");
            });

            // $scope.fabric = new Fabric({
            //     JSONExportProperties: FabricConstants.JSONExportProperties,
            //     textDefaults: FabricConstants.textDefaults,
            //     shapeDefaults: FabricConstants.shapeDefaults,
            //     curvedTextDefaults: FabricConstants.curvedTextDefaults,
            //     imageDefaults: FabricConstants.imageDefaults,
            //     imageFilters: FabricConstants.imageFilters,
            //     json: {"width": 1000, "height": 500}
            // });

            $scope.isloaded = true;

        };
        $scope.$on('canvas:created', $scope.init);

        /*
         * 商品を読み込む
         */
        $scope.loadProduct = function (title, image, id) {

            $scope.isloaded = false;

            $scope.clearCanvas();

            $scope.fabric.addShape(jQuery('[name=asset]').val() + image, true);

            $timeout(function () {
                $scope.deactivateAll();

                var objects = {};
                objects["objects"] = [];
                var array = [];
                angular.forEach($scope.objectLayers, function (value, key) {
                    // JSON用デザインデータ
                    array[key] = value.object;
                });
                objects["objects"] = array.reverse();

                $scope.fabric.loadJSON(JSON.stringify(objects));

                $scope.deactivateAll();

                $scope.defaultProductTitle = title;
                $scope.defaultProductId = id;

                $scope.activeSavedDesignId = 0;

                $scope.isloaded = true;

            }, 100);
        };

        /*
         * デザイン初期化
         */
        $scope.initFabric = function (width, height) {

            if (isNaN(width)) {
                width = 687.118;
            }
            $scope.fabric = new Fabric({
                JSONExportProperties: FabricConstants.JSONExportProperties,
                textDefaults: FabricConstants.textDefaults,
                shapeDefaults: FabricConstants.shapeDefaults,
                curvedTextDefaults: FabricConstants.curvedTextDefaults,
                imageDefaults: FabricConstants.imageDefaults,
                imageFilters: FabricConstants.imageFilters,
                json: {"width": width, "height": height}
                // json: {"width": 687.118, "height": 176.882}
            });

            jQuery('.canvas-container-outer').css('width', width);
            jQuery('.canvas-container-outer').css('height', height);

        };

        /*
         * デザインをJsonから読み込む
         */
        $scope.loadByJson = function (json) {
            $scope.fabric.loadJSON(json);
            $scope.deactivateAll();

        };

        /*
         * 現状デザインのJSONを返す
         */
        $scope.getDesignJson = function () {

            var array_index = 0;
            var objects = {};
            var array = [];
            var res = "";

            objects["objects"] = [];
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();

            angular.forEach($scope.objectLayers, function (value, key) {
                // JSON用デザインデータ
                array[array_index] = value.object;
                array_index++;
            });

            if (array.length > 0) {
                objects["objects"] = array.reverse();

                res = JSON.stringify(objects);
            }

            return res;
        };


        /****************************************
         * デザインデータ保存部分
         ****************************************/
        /*
         * フロント用プレセーブ
         */
        $scope.getPreSaveDatas = function () {

            $scope.deactivateAll();
            $scope.beforeSave();

            var objects_svg = $scope.fabric.designedSVGObjects;
            var user_id = jQuery('[name="order[user_id]"]').val();
            var filename = Math.random().toString(36).slice(-8);

            $http({
                method: 'post',
                url: $scope.path + "/layout/getPreSaveDatas",
                data: {
                    objects_svg: JSON.stringify(objects_svg),
                    name: filename,
                    user_id: user_id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {

                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();

                var uploaded_files = [];
                var array = [];
                var json_text = {};
                json_text["objects"] = [];
                var count = 0;
                var array_count = 0;

                // 全レイヤーを一つずつループ
                angular.forEach($scope.objectLayers, function (value, key) {
                    // typeが画像の場合はtmpからsavedに変更
                    if (value.object.type == "image") {
                        var src = value.object._originalElement.src;
                        var saved_src = src.replace('tmp', 'saved');
                        value.object._originalElement.src = saved_src;
                        uploaded_files[count] = saved_src.match(".+/(.+?)([\?#;].*)?$")[1];
                        count++;
                    }
                    // JSON用デザインデータ
                    array[array_count] = value.object;
                    array_count++;
                });
                json_text["objects"] = array.reverse();

                jQuery('[name="order_detail[designed_filename]"]').val(filename);
                jQuery('[name="order_detail[designed_image]"]').val(data.designed_image);
                jQuery('[name="order_detail[uploaded_files]"]').val(uploaded_files.join(','));
                jQuery('[name="order_detail[json]"]').val(JSON.stringify(json_text));

                jQuery('[name=confirmForm]').submit();


                // jQuery('#form1').submit();

            }).error(function (data, status, headers, config) {
                $scope.$broadcast("AjaxCallHappened", false);
            });
        };

        /*
         * デザインデータをJsonから保存する
         */
        $scope.saveByJson = function (item_box) {

            if ($scope.fabric == null) {
                $scope.initFabric(item_box.find('.width-hidden').val(), item_box.find('.height-hidden').val());
            }
            $scope.clearCanvas();

            var order_details_json = item_box.find('.order_details_json');
            var json = order_details_json.val();
            $scope.fabric.loadJSON(json);

            $timeout(function () {
                $scope.saveDesign(item_box);
            }, 300);
        };

        /*
         * ajaxで保存
         */
        $scope.saveDesign = function (item_box) {

            var order_details_json = item_box.find('.order_details_json');
            var index = order_details_json.attr('data-index');

            $scope.deactivateAll();
            $scope.beforeSave();

            var objects_svg = $scope.fabric.designedSVGObjects;
            // var objects_jpg = $scope.fabric.designedJPGObjects;
            var user_id = jQuery('[name="user[id]"]').val();
            var filename = user_id + "-" + Math.random().toString(36).slice(-8);

            $http({
                method: 'post',
                url: $scope.path + "/saveDesign",
                data: {
                    objects_svg: JSON.stringify(objects_svg),
                    // objects_jpg: JSON.stringify(objects_jpg),
                    name: filename
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {

                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();

                var uploaded_files = [];
                var array = [];
                var json_text = {};
                json_text["objects"] = [];
                var count = 0;
                var array_count = 0;

                // 全レイヤーを一つずつループ
                angular.forEach($scope.objectLayers, function (value, key) {
                    // typeが画像の場合はtmpからsavedに変更
                    if (value.object.type == "image") {
                        var src = value.object._originalElement.src;
                        var saved_src = src.replace('tmp', 'saved');
                        value.object._originalElement.src = saved_src;
                        uploaded_files[count] = saved_src.match(".+/(.+?)([\?#;].*)?$")[1];
                        count++;
                    }
                    // JSON用デザインデータ
                    array[array_count] = value.object;
                    array_count++;
                });
                json_text["objects"] = array.reverse();

                jQuery('[name="order_details[' + index + '][designed_filename]"').val(filename);
                jQuery('[name="order_details[' + index + '][designed_image]"').val(data.designed_image);
                jQuery('[name="order_details[' + index + '][uploaded_files]"').val(uploaded_files.join(','));
                // jQuery('[name="order_details[' + index + '][json_text]"').val(JSON.stringify(json_text));

                if (item_box.nextAll('.item_box').length != 0) {
                    $scope.$emit("loopSave", {item_box: item_box.nextAll('.item_box')});
                } else {
                    $scope.validatedFlg = true;
                    jQuery('#form1').submit();
                }

            }).error(function (data, status, headers, config) {
                $scope.$broadcast("AjaxCallHappened", false);
            });
        };

        $scope.$on("loopSave", function (event, args) {
            var item_box = args.item_box;
            $scope.saveByJson(item_box);
        });

    }
]);
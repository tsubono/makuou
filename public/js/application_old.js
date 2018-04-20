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
        $scope.fabric = {};
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

        $scope.path = "";


        /*
         * スタンプ追加
         */
        $scope.addShape = function (path) {
            $scope.fabric.addShape(path, false);

            $timeout(function () {
                $scope.deactivateAll();
            }, 100);
        };

        /*
         * 画像追加
         */
        $scope.addImage = function (image) {

            // if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.addImage(image);
            //}
        };

        /*
         * 画像が選択された場合に実行
         */
        $scope.onFileSelect = function (file) {

            var user_id = 1;
            if (file !== null) {
                //if ($scope.fabric.checkBackgroundImage()) {

                var filename = user_id + Math.random().toString(36).slice(-8) + ".png";

                Upload.upload({
                    type: 'save_tmp_image',
                    url: '/canvas/uploadImage',
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
                //}
            }
        };

        /*
         * デザインを削除する（確認）
         */
        $scope.clearAll = function () {

            var confirm = $mdDialog.confirm()
                .title('')
                .textContent('デザインが全て削除されます。本当に削除してもよろしいでしょうか。')
                .ariaLabel('Confirm')
                .ok('Ok')
                .cancel('Cancel');
            $mdDialog.show(confirm).then(function () {
                $scope.fabric.clearCanvas();
                $scope.fabric.setDirty(true);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();

            });
        };

        /*
         * デザインを削除する（実行）
         */
        $scope.clearCanvas = function () {

            $scope.fabric.clearCanvas();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();

        };

        /*
         * レイヤーを削除する（実行）
         */
        $scope.removeSelectedObject = function () {

            var confirm = $mdDialog.confirm()
                .title('')
                .content('選択中のレイヤーが削除されます。本当に削除してもよろしいでしょうか。')
                .ariaLabel('Confirm')
                .ok('Ok')
                .cancel('Cancel');
            $mdDialog.show(confirm).then(function () {
                $scope.fabric.deleteActiveObject();
                $scope.fabric.setDirty(true);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
            });
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
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.centerV();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}

        };

        /*
         * 水平方向を揃える
         */
        $scope.horizontalAlign = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.centerH();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}

        };

        /*
         * 後方に移動
         */
        $scope.backwordSwap = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.sendBackwards();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 後方に移動 (レイヤー一覧から)
         */
        $scope.objectBackwordSwap = function (object) {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.objectSendBackwards(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}

        };

        /*
         * 前方に移動
         */
        $scope.forwardSwap = function () {

            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.bringForward();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 前方に移動 (レイヤー一覧から)
         */
        $scope.objectForwardSwap = function (object) {

            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.objectBringForward(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
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
            //if ($scope.fabric.checkBackgroundImage()) {
            if ($scope.fabric.copyItem() == 'DONE') {
                _this.showNotification('コピーしました。', false);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
            }
            //}
        };

        /*
         * ペーストする
         */
        $scope.pasteItem = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            if ($scope.fabric.pasteItem() == 'DONE') {
                _this.showNotification('ペーストしました。', false);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
            }
            //}
        };

        /*
         * テキストを追加する
         */
        $scope.addText = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            //$scope.fabric.addText($scope.fabric.selectedObject.text);
            var text = window.btoa(unescape(encodeURIComponent($scope.fabric.selectedObject.text)));
            $scope.fabric.addText(decodeURIComponent(escape(window.atob(text))));
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
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
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleLockActiveObject();
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * ロックする (レイヤー一覧から)
         */
        $scope.lockLayerObject = function (object) {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleLockObject(object);
            $scope.fabric.setDirty(true);
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 反転する
         */
        $scope.flipObject = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleFlipX();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            // }
        };

        /*
         * デザインをSVG形式で保存する
         */
        $scope.saveObjectAsSvg = function (name) {

            //if ($scope.fabric.checkBackgroundImage()) {

            $scope.beforeSave();
            var objects = $scope.fabric.designedSVGObjects;

            $http({
                method: 'post',
                url: $scope.path + "/canvas/saveObjectAsSvg",
                data: {
                    object: JSON.stringify(objects),
                    name: name
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {
                if (data.status) {
                    // $mdDialog.show(
                    //     $mdDialog.alert()
                    //         .parent(angular.element(document.querySelector('#popupContainer')))
                    //         .clickOutsideToClose(true)
                    //         .title('Design Saved')
                    //         .textContent('Design has been saved. You can find them into "saved_design" directory.')
                    //         .ariaLabel('Success')
                    //         .ok('Got it!')
                    // );
                }
            }).error(function (data, status, headers, config) {
                $scope.$broadcast("AjaxCallHappened", false);
            });

            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * デザインをダウンロードする
         */
        $scope.downloadObject = function () {

            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.downloadCanvasObject();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}

        };

        /*
         * デザインをPDFでダウンロードする
         */
        $scope.downloadObjectAsPdf = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.downloadCanvasObjectAsPDF();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * デザインを印刷する
         */
        $scope.printObject = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.printCanvasObject();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 編集を戻す
         */
        $scope.undo = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.undo();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 編集を進める
         */
        $scope.redo = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.redo();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * ズームイン,ズームアウトする
         */
        $scope.zoomObject = function (action) {

            //if ($scope.fabric.checkBackgroundImage()) {
            if (action == 'zoomin') {
                $scope.fabric.zoomInObject();
            } else if (action == 'zoomout') {
                $scope.fabric.zoomOutObject();
            } else {
                $scope.fabric.resetZoom();
            }
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 太字にする
         */
        $scope.toggleBold = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleBold();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            // }
        };

        /*
         * イタリック体にする
         */
        $scope.toggleItalic = function () {
            // if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleItalic();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 下線を引く
         */
        $scope.toggleUnderline = function () {
            // if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleUnderline();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * 打ち消し線を引く
         */
        $scope.toggleLinethrough = function () {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.toggleLinethrough();
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * フォント形式を変更する
         */
        $scope.toggleFont = function (font) {
            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.fabric.selectedObject.fontFamily = font;
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();
            //}
        };

        /*
         * レイヤーにロックがかかっているか
         */
        $scope.isLocked = function () {
            // if ($scope.fabric.checkBackgroundImage()) {
            return $scope.fabric.isLocked();
            // } else {
            //   return false;
            //}
        };

        /*
         * レイヤーにロックがかかっているか（レイヤー一覧から）
         */
        $scope.isObjectLocked = function (object) {
            //if ($scope.fabric.checkBackgroundImage()) {
            return $scope.fabric.isObjectLocked(object);
            //} else {
            //  return false;
            //}
        };

        /*
         * Ajax用ハンドラー
         */
        $scope.$on('AjaxCallHappened', function (event, data) {
            //if (data.status == true) {
            _this.showNotification(data.message, false);
            //} else {
            //}
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

            var confirm = $mdDialog.confirm()
                .title('')
                .content('本当に削除してもよろしいでしょうか。')
                .ariaLabel('Confirm')
                .ok('Ok')
                .cancel('Cancel');
            $mdDialog.show(confirm).then(function () {
                $scope.fabric.deleteObject(object);
                $scope.fabric.setDirty(true);
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();
                $scope.$broadcast('rebuild:layer');
            });
        };

        /*
         * レイヤーを選択状態にする
         */
        $scope.selectObject = function (object) {
            $scope.fabric.selectActiveObject(object);
        };

        /*
         * toast用（未使用）
         */
        $scope.toastPosition = angular.extend({}, last);
        $scope.getToastPosition = function () {
            _this.sanitizePosition();
            return Object.keys($scope.toastPosition)
                .filter(function (pos) {
                    return $scope.toastPosition[pos];
                })
                .join(' ');
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
         * 商品カテゴリをセット
         */
        $scope.prodctByCat = function (val) {
            $scope.productCategory = val;
        };

        /*
         * 商品カテゴリがあるかどうか
         */
        $scope.hasCategory = function (product) {
            var category = angular.lowercase($scope.productCategory);
            var pCat = angular.lowercase(product.category);
            return (category == "all" || category == pCat);
        };

        /*
         * 商品を読み込む
         */
        $scope.loadProduct = function (title, image, id) {

            $scope.isloaded = false;

            $scope.clearCanvas();
            // $scope.fabric.addCanvasBackground(image);

            $scope.fabric.addShape(jQuery('[name=asset]').val()+image, true);

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
         * URLクエリ変換
         */
        this.transformRequest = function (obj) {
            var str = [];
            for (var p in obj)
                str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
        };

        /*
         * toast用（未使用）
         */
        this.sanitizePosition = function () {
            var current = $scope.toastPosition;
            if (current.bottom && last.top) current.top = false;
            if (current.top && last.bottom) current.bottom = false;
            if (current.right && last.left) current.left = false;
            if (current.left && last.right) current.right = false;
            last = angular.extend({}, current);
        };

        /*
         * toast用（未使用）
         */
        this.showNotification = function (message, scroll) {

            // Toastでメッセージを表示する部分
            // 本番では不要なのでコメントアウト
            // $mdToast.show(
            //     $mdToast.simple()
            //         .content(message)
            //         .position($scope.getToastPosition())
            //         .hideDelay(3000)
            // );
            // if(scroll) {
            //     $('html, body').animate({scrollTop: $(document).height()}, 1500);
            // }
        };

        /*
         * 商品一覧セット
         */
        this.initProducts = function () {
            $scope.productCategory = "all";
            $http({
                method: 'post',
                url: $scope.path + '/canvas/getProducts',
                data: {}
            }).success(function (data, status, headers, config) {
                $scope.products = data.products;
            }).error(function (data, status, headers, config) {
            });
        };

        /*
         * 保存済みデザインセット
         */
        this.initSavedDesign = function () {
            // $http({
            //     method: 'post',
            //     url: $scope.path + "/canvas/getSavedDesigns",
            //     data: {},
            //     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            //     transformRequest: _this.transformRequest
            // }).success(function (data, status, headers, config) {
            //     $scope.savedDesigns = data.savedDesigns;
            // }).error(function (data, status, headers, config) {
            // });
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
         * 設定諸々
         */
        this.initSettings = function () {

            $scope.stampCategoryId = 1;
            $scope.predicate = "id";
            $scope.reverse = false;
            $scope.loadMore = true;
            $scope.defaultProductId = 1;
            $scope.path = jQuery('[name=path]').val();


            // 各一覧読み込み
            _this.initProducts();
            _this.initStampCategories();
            _this.initStamps();
            _this.initSavedDesign();

            // $http({
            //     method: 'post',
            //     url: $scope.path + "/canvas/getProduct",
            //     data: {
            //         id: 1
            //     },
            //     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            //     transformRequest: _this.transformRequest
            // }).success(function (data, status, headers, config) {
            //     var product = data.product;
            //     $scope.loadProduct(product.name, product.image, product.id);
            //
            // }).error(function (data, status, headers, config) {
            //     $scope.$broadcast("AjaxCallHappened", false);
            // });

            $scope.isloaded = true;
        };

        /*
         * 初期設定
         */
        $scope.init = function () {

            _this.initSettings();

            jQuery(document).on("change", ".upload", function () {
                jQuery("#uploadFile").val($(this).val());
            });

            jQuery(window).load(function () {
                // jQuery(".editor_section").height(jQuery(".canvas_section").height());
                jQuery("#Products .thumb_listing ul > li:first-child a").trigger("click");
            });

            $scope.fabric = new Fabric({
                JSONExportProperties: FabricConstants.JSONExportProperties,
                textDefaults: FabricConstants.textDefaults,
                shapeDefaults: FabricConstants.shapeDefaults,
                curvedTextDefaults: FabricConstants.curvedTextDefaults,
                imageDefaults: FabricConstants.imageDefaults,
                imageFilters: FabricConstants.imageFilters,
                json: {"width": 1000, "height": 500}
            });

        };
        $scope.$on('canvas:created', $scope.init);

        /*
         * デザインデータの画像を作成する
         */
        $scope.saveDesignImage = function () {

            // TODO: ログイン情報から取得
            var user_id = 1;

            //if ($scope.fabric.checkBackgroundImage()) {
            $scope.beforeSave();
            // var objects = $scope.fabric.designedPNGObjects;
            var objects = $scope.fabric.designedSVGObjects;

            var filename = user_id + "-" + Math.random().toString(36).slice(-8);

            $http({
                method: 'post',
                url: $scope.path + "/canvas/saveDesign",
                data: {
                    object: JSON.stringify(objects),
                    name: filename
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {
                $scope.objectLayers = [];
                $scope.objectLayers = $scope.fabric.canvasLayers();

                // 画像保存完了後、DBを更新する
                $scope.$emit("saveDesignDB", {filename: filename, user_id: user_id});

            }).error(function (data, status, headers, config) {
                $scope.$broadcast("AjaxCallHappened", false);
            });
        };

        /*
         * デザインデータをDBに保存
         */
        $scope.$on("saveDesignDB", function (event, args) {

            var uploaded_files = [];
            var index = 0;
            var array_index = 0;
            var objects = {};
            var array = [];
            objects["objects"] = [];
            $scope.objectLayers = [];
            $scope.objectLayers = $scope.fabric.canvasLayers();

            // 全レイヤーを一つずつループ
            angular.forEach($scope.objectLayers, function (value, key) {
                // typeが画像の場合はtmpからsavedに変更
                if (value.object.type == "image") {
                    var src = value.object._originalElement.src;
                    var saved_src = src.replace('tmp', 'saved');

                    value.object._originalElement.src = saved_src;
                    uploaded_files[index] = saved_src.match(".+/(.+?)([\?#;].*)?$")[1];
                    index++;
                }
                // JSON用デザインデータ
                array[array_index] = value.object;
                array_index++;
            });
            objects["objects"] = array.reverse();

            // DBに新規保存
            $http({
                method: 'post',
                url: $scope.path + "/admin/orders/saveDesign",
                data: {
                    product_id: $scope.defaultProductId,
                    filename: args.filename,
                    image: args.image,
                    uploaded_files: JSON.stringify(uploaded_files),
                    json: JSON.stringify(objects),
                    user_id: args.user_id,
                    saved_design_id: $scope.activeSavedDesignId
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: _this.transformRequest
            }).success(function (data, status, headers, config) {
                // 保存済みデザイン一覧を更新
                _this.initSavedDesign();

                $scope.activeSavedDesignId = data.activeSavedDesignId;

                $mdDialog.show(
                    $mdDialog.alert()
                        .parent(angular.element(document.querySelector('#popupContainer')))
                        .clickOutsideToClose(true)
                        .title('')
                        .textContent($scope.activeSavedDesignId ? 'デザインを更新しました' : 'デザインを保存しました')
                        .ariaLabel('Success')
                        .ok('Got it!')
                );

            }).error(function (data, status, headers, config) {
                $scope.$broadcast("AjaxCallHappened", false);
            });
        });

        /*
         * デザインデータをJsonから保存する
         */
        $scope.saveByJson = function (item_box) {

                $scope.clearCanvas();

                var order_details_json = item_box.find('.order_details_json');
                var json = order_details_json.val();
                $scope.fabric.loadJSON(json);

                $timeout(function () {
                    $scope.saveDesign(item_box);
                }, 100);
        };

        /*
         * デザインデータを保存する
         */
        $scope.saveDesign = function (item_box) {

            var order_details_json = item_box.find('.order_details_json');
            var index = order_details_json.attr('data-index');

            $scope.deactivateAll();
            $scope.beforeSave();

            var objects = $scope.fabric.designedSVGObjects;
            var user_id = jQuery('[name="user[id]"]').val();
            var filename = user_id + "-" + Math.random().toString(36).slice(-8);

            $http({
                method: 'post',
                url: $scope.path + "/admin/orders/saveDesign",
                data: {
                    object: JSON.stringify(objects),
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
                jQuery('[name="order_details[' + index + '][json_text]"').val(JSON.stringify(json_text));

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

        /*
         * 保存済みデザインデータを削除する
         */
        $scope.deleteDesign = function () {

            var confirm = $mdDialog.confirm()
                .title('')
                .textContent('本当に削除してもよろしいでしょうか。')
                .ariaLabel('Confirm')
                .ok('Ok')
                .cancel('Cancel');
            $mdDialog.show(confirm).then(function () {
                // TODO: ログイン情報から取得
                var user_id = 1;

                // DBから削除
                $http({
                    method: 'post',
                    //  url: "../inc/db.php",
                    url: $scope.path + "/canvas/deleteSavedDesign",
                    data: {
                        type: "DeleteDesign",
                        user_id: user_id,
                        saved_design_id: $scope.activeSavedDesignId
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    transformRequest: _this.transformRequest
                }).success(function (data, status, headers, config) {

                    $scope.init();

                    var activeTab;
                    activeTab = $('#tabs').find('li.active');
                    $("#my-tab-content > div.active").removeClass('active');
                    $(activeTab).removeClass('active');
                    $('li.productsTab').addClass('active');
                    $('#Products').addClass('active');
                    $scope.objectLayers = [];
                    $scope.objectLayers = $scope.fabric.canvasLayers();
                    $scope.$broadcast('rebuild:product');
                    $scope.activeSavedDesignId = 0;


                    $mdDialog.show(
                        $mdDialog.alert()
                            .parent(angular.element(document.querySelector('#popupContainer')))
                            .clickOutsideToClose(true)
                            .title('')
                            .textContent('デザインを削除しました')
                            .ariaLabel('Success')
                            .ok('Got it!')
                    );

                }).error(function (data, status, headers, config) {
                    $scope.$broadcast("AjaxCallHappened", false);
                });
            });
        };

        /*
         * 保存済みデザインを読み込み
         */
        $scope.loadBySavedData = function (savedDesign) {

            $http({
                method: 'get',
                url: savedDesign.json,
                dataType: 'json',
                headers: {'Content-Type': 'application/json'}
            }).success(function (data, status, headers, config) {
                $scope.fabric.loadJSON(data);
                $scope.activeSavedDesignId = savedDesign.id;

                $timeout(function () {
                    $scope.deactivateAll();
                }, 100);

            }).error(function (data, status, headers, config) {
                $scope.isloaded = false;
            });

            // // デザインに紐づく商品情報取得
            // $http({
            //     method: 'post',
            //     url: $scope.path + '/canvas/getProduct',
            //     data: {
            //         id: savedDesign.product_id
            //     },
            //     headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            //     transformRequest: _this.transformRequest
            // }).success(function (data, status, headers, config) {
            //     var product = data.product;
            //
            //     // $scope.loadProduct(product.name, savedDesign.image, product.id);
            //
            // }).error(function (data, status, headers, config) {
            //     $scope.$broadcast("AjaxCallHappened", false);
            // });
        };

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
        }

    }
]);
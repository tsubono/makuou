'use strict';
angular.module('common.fabric', [
    'common.fabric.window',
    'common.fabric.directive',
    'common.fabric.canvas',
    'common.fabric.dirtyStatus'
])

    .factory('Fabric', [
        'FabricWindow', '$timeout', '$window', 'FabricCanvas', 'FabricDirtyStatus',
        function (FabricWindow, $timeout, $window, FabricCanvas, FabricDirtyStatus) {

            return function (options) {

                var canvas;
                var JSONObject;
                var self = angular.extend({
                    canvasBackgroundColor: '#ffffff',
                    canvasWidth: 564,
                    canvasHeight: 400,
                    canvasOriginalHeight: 400,
                    canvasOriginalWidth: 564,
                    maxContinuousRenderLoops: 25,
                    continuousRenderTimeDelay: 500,
                    editable: true,
                    JSONExportProperties: [],
                    loading: false,
                    dirty: false,
                    initialized: false,
                    userHasClickedCanvas: false,
                    downloadMultipler: 2,
                    imageDefaults: {},
                    textDefaults: {},
                    curvedTextDefaults: {},
                    shapeDefaults: {},
                    windowDefaults: {
                        rotatingPointOffset: 20,
                        padding: 10,
                        borderColor: 'EEF6FC',
                        cornerColor: '#FFC23F',
                        cornerSize: 10,
                        transparentCorners: false,
                        hasRotatingPoint: true,
                        centerTransform: true
                    },
                    canvasDefaults: {
                        selection: false
                    }
                }, options);


                function capitalize(string) {
                    if (typeof string !== 'string') {
                        return '';
                    }

                    return string.charAt(0).toUpperCase() + string.slice(1);
                }

                function getActiveStyle(styleName, object) {
                    object = object || canvas.getActiveObject();

                    if (typeof object !== 'object' || object === null) {
                        return '';
                    }

                    return (object.getSelectionStyles && object.isEditing) ? (object.getSelectionStyles()[styleName] || '') : (object[styleName] || '');
                }

                function setActiveStyle(styleName, value, object) {
                    object = object || canvas.getActiveObject();
                    if (object != null) {
                        if (object.setSelectionStyles && object.isEditing) {
                            var style = {};
                            style[styleName] = value;
                            object.setSelectionStyles(style);
                        } else {
                            object[styleName] = value;
                        }

                        self.render();
                    }
                }

                function getActiveProp(name) {
                    var object = canvas.getActiveObject();

                    return typeof object === 'object' && object !== null ? object[name] : '';
                }

                function setActiveProp(name, value) {
                    var object = canvas.getActiveObject();
                    if (object != null) {
                        object.set(name, value);
                        self.render();
                    }
                }

                function b64toBlob(b64Data, contentType, sliceSize) {
                    contentType = contentType || '';
                    sliceSize = sliceSize || 512;

                    var byteCharacters = atob(b64Data);
                    var byteArrays = [];

                    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                        var slice = byteCharacters.slice(offset, offset + sliceSize);

                        var byteNumbers = new Array(slice.length);
                        for (var i = 0; i < slice.length; i++) {
                            byteNumbers[i] = slice.charCodeAt(i);
                        }

                        var byteArray = new Uint8Array(byteNumbers);

                        byteArrays.push(byteArray);
                    }

                    var blob = new Blob(byteArrays, {type: contentType});
                    return blob;
                }

                function isHex(str) {
                    return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/gi.test(str);
                }

                //
                // Canvas
                // ==============================================================
                self.renderCount = 0;
                var isRedoing = false;
                var h = [];
                var copiedObject;
                var copiedObjects = new Array();
                self.designedObjects = {};
                self.designedSVGObjects = {};
                self.designedPNGObjects = {};
                self.designedJPGObjects = {};

                /***************** for corner icons  ****************/

                fabric.Object.prototype.setControlsVisibility({
                    ml: false,
                    mr: false,
                    mb: false,
                    mt: false
                });

                fabric.Canvas.prototype.customiseControls({
                    tl: {
                        action: 'rotate',
                        cursor: 'crosshair'
                    },
                    tr: {
                        action: 'scale'
                    },
                    bl: {
                        action: 'remove',
                        cursor: 'pointer'
                    },
                    br: {
                        action: 'moveUp',
                        cursor: 'move'
                    },
                    mb: {
                        action: 'moveDown',
                        cursor: 'pointer'
                    },
                    mt: {
                        action: {
                            'rotateByDegrees': 30
                        },
                        cursor: 'pointer'
                    },
                    ml: {
                        action: 'moveDown',
                        cursor: 'pointer'
                    },
                    mr: {
                        action: 'moveDown',
                        cursor: 'pointer'
                    }
                });

                // basic settings
                fabric.Object.prototype.customiseCornerIcons({
                    settings: {
                        borderColor: 'red',
                        cornerSize: 24,
                        cornerBackgroundColor: 'white',
                        cornerShape: 'circle',
                        cornerPadding: 8
                    },
                    tl: {
                        icon: jQuery('[name=path]').val() + '/images/icons/rotate.jpg'
                    },
                    tr: {
                        icon: jQuery('[name=path]').val() + '/images/icons/resize.jpg'
                    },
                    bl: {
                        icon: jQuery('[name=path]').val() + '/images/icons/delete.png'
                    },
                    br: {
                        icon: jQuery('[name=path]').val() + '/images/icons/move.jpg'
                    },
                    mb: {
                        icon: jQuery('[name=path]').val() + '/images/icons/move.jpg'
                    },
                    mt: {
                        icon: jQuery('[name=path]').val() + '/images/icons/move.jpg'
                    },
                    ml: {
                        icon: jQuery('[name=path]').val() + '/images/icons/move.jpg'
                    },
                    mr: {
                        icon: jQuery('[name=path]').val() + '/images/icons/move.jpg'
                    }
                });

                /***************** for corner icons  ****************/

                var filters = [
                    new fabric.Image.filters.Grayscale(),       // grayscale    0
                    new fabric.Image.filters.Sepia2(),          // sepia        1
                    new fabric.Image.filters.Invert(),          // invert       2
                    new fabric.Image.filters.Convolute({        // emboss       3
                        matrix: [1, 1, 1,
                            1, 0.7, -1,
                            -1, -1, -1]
                    }),
                    new fabric.Image.filters.Convolute({        // sharpen      4
                        matrix: [0, -1, 0,
                            -1, 5, -1,
                            0, -1, 0]
                    })
                ];

                self.addQRCode = function (text) {

                };

                self.applyImageFilter = function (isChecked, filter) {
                    var obj = canvas.getActiveObject();
                    obj.filters[filter] = isChecked ? filters[filter] : null;
                    obj.applyFilters(function () {
                        canvas.renderAll();
                    });
                };

                self.render = function () {
                    var objects = canvas.getObjects();
                    for (var i in objects) {
                        objects[i].setCoords();
                    }

                    canvas.calcOffset();
                    canvas.renderAll();
                    self.renderCount++;
                };

                self.setCanvas = function (newCanvas) {
                    canvas = newCanvas;
                    canvas.selection = self.canvasDefaults.selection;
                };

                self.setTextDefaults = function (textDefaults) {
                    self.textDefaults = textDefaults;
                };

                self.setJSONExportProperties = function (JSONExportProperties) {
                    self.JSONExportProperties = JSONExportProperties;
                };

                self.setCanvasBackgroundColor = function (color) {
                    self.canvasBackgroundColor = color;
                    canvas.setBackgroundColor(color);
                    self.render();
                };

                self.setCanvasWidth = function (width) {
                    self.canvasWidth = width;
                    canvas.setWidth(width);
                    self.render();
                };

                self.setCanvasHeight = function (height) {
                    self.canvasHeight = height;
                    canvas.setHeight(height);
                    self.render();
                };

                self.setCanvasSize = function (width, height) {
                    self.stopContinuousRendering();
                    var initialCanvasScale = self.canvasScale;
                    self.resetZoom();

                    self.canvasWidth = width;
                    self.canvasOriginalWidth = width;
                    canvas.originalWidth = width;
                    canvas.setWidth(width);

                    self.canvasHeight = height;
                    self.canvasOriginalHeight = height;
                    canvas.originalHeight = height;
                    canvas.setHeight(height);

                    self.canvasScale = initialCanvasScale;
                    self.render();
                    self.setZoom();
                    self.render();
                    self.setZoom();
                };

                self.isLoading = function () {
                    return self.isLoading;
                };

                self.deactivateAll = function () {
                    canvas.deactivateAll();
                    self.deselectActiveObject();
                    self.render();
                };

                self.clearCanvas = function () {
                    canvas.clear();
                    self.render();
                };

                //
                // Creating Objects
                // ==============================================================
                self.addObjectToCanvas = function (object) {

                    object.originalScaleX = object.scaleX;
                    object.originalScaleY = object.scaleY;
                    object.originalLeft = object.left;
                    object.originalTop = object.top;

                    canvas.add(object);
                    self.setObjectZoom(object);
                    canvas.setActiveObject(object);
                    object.bringToFront();
                    self.center();
                    self.render();

                };

                //
                // Image
                // ==============================================================
                self.addImage = function (imageURL) {
                    fabric.Image.fromURL(imageURL, function (object) {
                        object.id = self.createId();

                        for (var p in self.imageOptions) {
                            object[p] = self.imageOptions[p];
                        }

                        // Add a filter that can be used to turn the image
                        // into a solid colored shape.
                        var filter = new fabric.Image.filters.Tint({
                            color: '#ffffff',
                            opacity: 0
                        });
                        object.filters.push(filter);
                        object.applyFilters(canvas.renderAll.bind(canvas));

                        self.addObjectToCanvas(object);
                    }, self.imageDefaults);
                };

                //
                // Canvas Image
                // ==============================================================
                self.addCanvasBackground = function (src) {

                    var image = self.imageResize(src);
                    var ctx = canvas.getContext("2d");
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    var center = canvas.getCenter();

                    canvas.setBackgroundImage(src, canvas.renderAll.bind(canvas), {
                        scaleX: 1,
                        scaleY: 1,
                        top: center.top,
                        left: center.left,
                        originX: 'center',
                        originY: 'center',
                        width: image.width,
                        height: image.height,
                        backgroundImageStretch: false
                    });
                };

                //
                // Resize Canvas
                // ==============================================================
                self.resizeCanvas = function () {

                };

                //
                // Resize Image
                // ==============================================================

                self.imageResize = function (src) {

                    var MAX_HEIGHT = canvas.height;
                    var w;
                    var h;

                    var image = new Image();

                    image.src = src;
                    if (image.height > MAX_HEIGHT) {
                        image.width *= MAX_HEIGHT / image.height;
                        image.height = MAX_HEIGHT;
                        w = image.width;
                        h = image.height;
                    } else {
                        w = image.width;
                        h = image.height;
                    }
                    return {width: w, height: h}
                };

                //
                //Get Image Meta
                //===============================================================
                self.getImageMeta = function (url) {
                    var w;
                    var h;
                    var img = new Image();

                    img.src = url;
                    h = img.height;
                    w = img.width;

                    return {width: w, height: h}
                };

                //
                // checkBackgroundImage
                // ==============================================================

                self.checkBackgroundImage = function () {
                    return canvas.backgroundImage;
                };

                //
                // canvas Layers
                // ==============================================================
                self.canvasLayers = function () {
                    var layers = [];
                    $.each(canvas.getObjects(), function (index, value) {
                        layers.push({"id": "Layer " + (index + 1), "src": self.convertToSVG(value), "object": value});
                    });
                    return layers.reverse();
                };

                self.convertToSVG = function (value) {
                    return value.toDataURL();
                };

                //
                // isTainted
                // ==============================================================
                self.isTainted = function () {
                    var ctx = canvas.getContext("2d");
                    try {
                        var pixel = ctx.getImageData(0, 0, 1, 1);
                        return false;
                    } catch (err) {
                        return (err.code === 18);
                    }
                };

                //
                // Shape
                // ==============================================================
                self.addShape = function (svgURL, itemLoadFlg) {

                    if (!itemLoadFlg) {
                        fabric.loadSVGFromURL(svgURL, function (objects, options) {
                            var newOptions = self.merge_options(options, self.shapeDefaults);
                            var object = fabric.util.groupSVGElements(objects, newOptions);
                            object.id = self.createId();

                            for (var p in self.shapeDefaults) {
                                object[p] = self.shapeDefaults[p];
                            }

                            if (object.isSameColor && object.isSameColor() || !object.paths) {
                                object.setFill('#000000');
                            } else if (object.paths) {
                                for (var i = 0; i < object.paths.length; i++) {
                                    object.paths[i].setFill(object.paths[i].fill);
                                }
                            }
                            self.addObjectToCanvas(object);
                        });
                    } else {
                        // var elem = document.getElementById("svg3"),
                        //     svgStr = elem.innerHTML;
                        fabric.loadSVGFromURL(svgURL, function (objects, options) {
                            for (var i = 0; i < objects.length; i++) {
                                var matrix = objects[i].getTransformMatrix();
                                if (matrix != null && matrix.length > 0) {
                                    var angle = Math.acos(matrix[0]) * 180 / Math.PI;
                                    objects[i]._removeTransformMatrix(matrix);
                                    objects[i].setAngle(-angle);
                                }
                                canvas.add(objects[i]);
                            }
                            canvas.renderAll();
                        });
                    }
                };

                fabric.Object.prototype._removeTransformMatrix = function (addTranslate) {

                    var left = this.left;
                    var top = this.top;

                    if (this.type !== 'text' && this.type !== 'i-text') {
                        left += this.width / 2;
                        top += this.height / 2;
                    }

                    var matrix = fabric.util.multiplyTransformMatrices(this.transformMatrix || [1, 0, 0, 1, 0, 0], [1, 0, 0, 1, left, top]);
                    var options = this.qrDecompose(matrix);
                    this.scaleX = options.scaleX;
                    this.scaleY = options.scaleY;
                    this.angle = options.angle;
                    this.skewX = options.skewX;
                    this.skewY = 0;
                    this.flipX = false;
                    this.flipY = false;
                    var point = new fabric.Point(options.translateX, options.translateY);
                    this.setPositionByOrigin(point, 'center', 'center');
                    this.transformMatrix = null;
                };

                fabric.Object.prototype.qrDecompose = function (a) {
                    var angle = Math.atan2(a[1], a[0]),
                        denom = Math.pow(a[0], 2) + Math.pow(a[1], 2),
                        scaleX = Math.sqrt(denom),
                        scaleY = (a[0] * a[3] - a[2] * a [1]) / scaleX,
                        skewX = Math.atan2(a[0] * a[2] + a[1] * a [3], denom);
                    return {
                        angle: angle / (Math.PI / 180),
                        scaleX: scaleX,
                        scaleY: scaleY,
                        skewX: skewX / (Math.PI / 180),
                        skewY: 0,
                        // 文字のずれをここで調整
                        translateX: a[4],
                        translateY: a[5]
                    };
                };


                //
                // Shape String
                // ==============================================================
                self.addShapeString = function (svg) {

                    fabric.loadSVGFromString(svg, function (objects, options) {
                        var newOptions = self.merge_options(options, self.shapeDefaults);
                        var object = fabric.util.groupSVGElements(objects, newOptions);
                        object.id = self.createId();

                        for (var p in self.shapeDefaults) {
                            object[p] = self.shapeDefaults[p];
                        }
                        if (object.isSameColor && object.isSameColor() || !object.paths) {
                            object.setFill('#000000');
                        } else if (object.paths) {
                            for (var i = 0; i < object.paths.length; i++) {
                                object.paths[i].setFill(object.paths[i].fill);
                            }
                        }
                        self.addObjectToCanvas(object);

                    });
                };

                //
                //Copy
                // ==============================================================
                self.copyItem = function () {
                    if (canvas.getActiveGroup()) {
                        for (var i in canvas.getActiveGroup().objects) {
                            var object = fabric.util.object.clone(canvas.getActiveGroup().objects[i]);
                            object.set("top", object.top + 5);
                            object.set("left", object.left + 5);
                            copiedObjects[i] = object;
                        }
                        return 'DONE';
                    }
                    else if (canvas.getActiveObject()) {
                        var object = fabric.util.object.clone(canvas.getActiveObject());
                        object.set("top", object.top + 5);
                        object.set("left", object.left + 5);
                        copiedObject = object;
                        return 'DONE';
                    } else {
                        return 'ERROR';
                    }
                };

                //
                //Paste
                // ==============================================================
                self.pasteItem = function () {
                    if (copiedObjects.length > 0) {
                        for (var i in copiedObjects) {
                            canvas.add(copiedObjects[i]);
                        }
                        canvas.renderAll();
                        copiedObject = null;
                        return 'DONE';
                    }
                    else if (copiedObject) {
                        canvas.add(copiedObject);
                        canvas.renderAll();
                        copiedObject = null;
                        return 'DONE';
                    } else {
                        return 'ERROR';
                    }

                };

                //
                //Undo
                // ==============================================================
                self.undo = function () {
                    if (canvas._objects.length > 0) {
                        h.push(canvas._objects.pop());
                        canvas.renderAll();
                    }
                };

                //
                //Redo
                // ==============================================================
                self.redo = function () {
                    if (h.length > 0) {
                        isRedoing = true;
                        canvas.add(h.pop());
                    }
                };

                //
                // Text
                // ==============================================================
                self.addText = function (str) {
                    str = str || 'New Text';

                    var object = new FabricWindow.Text(str, self.textDefaults);
                    object.id = self.createId();

                    self.addObjectToCanvas(object);
                };

                //
                // Curved Text
                // ==============================================================
                self.addCurvedText = function (str) {
                    str = str || 'Curved Text';

                    var CurvedText = new FabricWindow.CurvedText(str, self.textDefaults);
                    CurvedText.id = self.createId();
                    self.addObjectToCanvas(CurvedText);
                };

                self.getText = function () {
                    return getActiveProp('text');
                };

                self.setText = function (value) {
                    var obj = canvas.getActiveObject();
                    if (obj != null) {
                        if (/text/.test(obj.type)) {
                            setActiveProp('text', value);
                        } else {
                            obj.setText(value);
                            canvas.renderAll();
                        }
                    }
                };

                self.merge_options = function (obj1, obj2) {
                    for (var p in obj2) {
                        try {
                            // Property in destination object set; update its value.
                            if (obj2[p].constructor == Object) {
                                obj1[p] = MergeRecursive(obj1[p], obj2[p]);

                            } else {
                                obj1[p] = obj2[p];

                            }

                        } catch (e) {
                            // Property in destination object not set; create it and set its value.
                            obj1[p] = obj2[p];

                        }
                    }

                    return obj1;
                };

                self.toggleText = function () {
                    var props = {};
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            var default_text = obj.getText();
                            props = obj.toObject();
                            delete props['type'];
                            var newProp = self.merge_options(props, self.textDefaults);
                            var textSample = new fabric.Text(default_text, newProp);
                        } else if (/text/.test(obj.type)) {
                            var default_text = obj.getText();
                            props = obj.toObject();
                            delete props['type'];
                            var newProp = self.merge_options(props, self.curvedTextDefaults);
                            var textSample = new fabric.CurvedText(default_text, newProp);
                        }
                        canvas.remove(obj);
                        canvas.add(textSample).renderAll();
                        canvas.setActiveObject(canvas.item(canvas.getObjects().length - 1));
                    }
                };

                self.toggleReverse = function (value) {

                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (typeof value !== "undefined") {
                            if (value == true) {
                                obj.set('reverse', false);
                                canvas.renderAll();
                            } else {
                                obj.set('reverse', true);
                                canvas.renderAll();
                            }
                        } else {
                            obj.set('reverse', true);
                            canvas.renderAll();
                        }
                    }
                };

                self.renderBridgeText = function () {

                    var curve = parseInt(iCurve.value, 10);
                    var offsetY = parseInt(iOffset.value, 10);
                    var textHeight = parseInt(iHeight.value, 10);
                    var bottom = parseInt(iBottom.value, 10);
                    var isTri = iTriangle.checked;

                    vCurve.innerHTML = curve;
                    vOffset.innerHTML = offsetY;
                    vHeight.innerHTML = textHeight;
                    vBottom.innerHTML = bottom;

                    octx.clearRect(0, 0, w, h);
                    ctx.clearRect(0, 0, w, h);

                    octx.fillText(iText.value.toUpperCase(), w * 0.5, 0);

                    /// slide and dice
                    var i = w;
                    var dltY = curve / textHeight;
                    var y = 0;
                    while (i--) {
                        if (isTri) {
                            y += dltY;
                            if (i === (w * 0.5) | 0) dltY = -dltY;
                        } else {
                            y = bottom - curve * Math.sin(i * angleSteps * Math.PI / 180);
                        }
                        ctx.drawImage(os, i, 0, 1, textHeight,
                            i, h * 0.5 - offsetY / textHeight * y, 1, y);
                    }
                };

                self.radius = function (value) {
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        obj.set('radius', value);
                    }
                    canvas.renderAll();
                };

                self.spacing = function (value) {
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        obj.set('spacing', value);
                    }
                    canvas.renderAll();
                };


                //
                // Font Size
                // ==============================================================
                self.getFontSize = function () {
                    return getActiveStyle('fontSize');
                };

                self.setFontSize = function (value) {
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            obj.set('fontSize', parseInt(value, 10));
                            canvas.renderAll();
                        } else if (/text/.test(obj.type)) {
                            setActiveStyle('fontSize', parseInt(value, 10));
                            self.render();
                        }
                    }
                };

                //
                // Text Align
                // ==============================================================
                self.getTextAlign = function () {
                    return capitalize(getActiveProp('textAlign'));
                };

                self.setTextAlign = function (value) {
                    setActiveProp('textAlign', value.toLowerCase());
                };

                //
                // Font Family
                // ==============================================================
                self.getFontFamily = function () {
                    var fontFamily = getActiveProp('fontFamily');
                    return fontFamily ? fontFamily.toLowerCase() : '';
                };

                self.setFontFamily = function (value) {
                    setActiveProp('fontFamily', value.toLowerCase());
                };

                //
                // Lineheight
                // ==============================================================
                self.getLineHeight = function () {
                    return getActiveStyle('lineHeight');
                };

                self.setLineHeight = function (value) {
                    setActiveStyle('lineHeight', parseFloat(value, 10));
                    self.render();
                };

                //
                // Bold
                // ==============================================================
                self.isBold = function () {
                    return getActiveStyle('fontWeight') === 'bold';
                };

                self.toggleBold = function () {

                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            obj.set('fontWeight', getActiveStyle('fontWeight') === 'bold' ? '' : 'bold');
                            canvas.renderAll();
                        } else if (/text/.test(obj.type)) {
                            setActiveStyle('fontWeight', getActiveStyle('fontWeight') === 'bold' ? '' : 'bold');
                            self.render();
                        }
                    }
                };

                //
                // Italic
                // ==============================================================
                self.isItalic = function () {
                    return getActiveStyle('fontStyle') === 'italic';
                };

                self.toggleItalic = function () {

                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            obj.set('fontStyle', getActiveStyle('fontStyle') === 'italic' ? '' : 'italic');
                            canvas.renderAll();
                        } else if (/text/.test(obj.type)) {
                            setActiveStyle('fontStyle', getActiveStyle('fontStyle') === 'italic' ? '' : 'italic');
                            self.render();
                        }

                    }
                };

                //
                // Underline
                // ==============================================================
                self.isUnderline = function () {
                    return getActiveStyle('textDecoration').indexOf('underline') > -1;
                };

                self.toggleUnderline = function () {

                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            var value = self.isUnderline() ? getActiveStyle('textDecoration').replace('underline', '') : (getActiveStyle('textDecoration') + ' underline');
                            obj.set('textDecoration', value);
                            canvas.renderAll();
                        } else if (/text/.test(obj.type)) {
                            var value = self.isUnderline() ? getActiveStyle('textDecoration').replace('underline', '') : (getActiveStyle('textDecoration') + ' underline');
                            setActiveStyle('textDecoration', value);
                            self.render();
                        }
                    }
                };

                //
                // Linethrough
                // ==============================================================
                self.isLinethrough = function () {
                    return getActiveStyle('textDecoration').indexOf('line-through') > -1;
                };

                self.toggleLinethrough = function () {

                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            var value = self.isLinethrough() ? getActiveStyle('textDecoration').replace('line-through', '') : (getActiveStyle('textDecoration') + ' line-through');
                            obj.set('textDecoration', value);
                            canvas.renderAll();
                        } else if (/text/.test(obj.type)) {
                            var value = self.isLinethrough() ? getActiveStyle('textDecoration').replace('line-through', '') : (getActiveStyle('textDecoration') + ' line-through');

                            setActiveStyle('textDecoration', value);
                            self.render();
                        }
                    }
                };

                //
                // Text Align
                // ==============================================================
                self.getTextAlign = function () {
                    return getActiveProp('textAlign');
                };

                self.setTextAlign = function (value) {
                    setActiveProp('textAlign', value);
                };

                //
                // Opacity
                // ==============================================================
                self.getOpacity = function () {
                    return getActiveStyle('opacity');
                };

                self.setOpacity = function (value) {
                    setActiveStyle('opacity', value);
                };

                //
                // FlipX
                // ==============================================================
                self.getFlipX = function () {
                    return getActiveProp('flipX');
                };

                self.setFlipX = function (value) {
                    setActiveProp('flipX', value);
                };

                self.toggleFlipX = function () {
                    var value = self.getFlipX() ? false : true;
                    self.setFlipX(value);
                    self.render();
                };

                //
                // Align Active Object
                // ==============================================================
                self.center = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.center();
                        self.updateActiveObjectOriginals();
                        self.render();
                    }
                };

                self.centerH = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.centerH();
                        self.updateActiveObjectOriginals();
                        self.render();
                    }
                };

                self.centerV = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.centerV();
                        self.updateActiveObjectOriginals();
                        self.render();
                    }
                };

                //
                // Active Object Layer Position
                // ==============================================================
                self.sendBackwards = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        canvas.sendBackwards(activeObject);
                        self.render();
                    }
                };


                //
                // Object Layer Position
                // ==============================================================
                self.objectSendBackwards = function (activeObj) {
                    if (activeObj) {
                        canvas.sendBackwards(activeObj);
                        self.render();
                    }
                };


                self.sendToBack = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        canvas.sendToBack(activeObject);
                        self.render();
                    }
                };

                self.bringForward = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        canvas.bringForward(activeObject);
                        self.render();
                    }
                };

                self.objectBringForward = function (activeObj) {
                    if (activeObj) {
                        canvas.bringForward(activeObj);
                        self.render();
                    }
                };

                self.bringToFront = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        canvas.bringToFront(activeObject);
                        self.render();
                    }
                };

                //
                // Active Object Tint Color
                // ==============================================================
                self.isTinted = function () {
                    return getActiveProp('isTinted');
                };

                self.toggleTint = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject !== undefined && activeObject !== null) {
                        if (activeObject.filters[0] !== undefined && activeObject.filters[0] !== null) {
                            activeObject.isTinted = !activeObject.isTinted;
                            activeObject.filters[0].opacity = activeObject.isTinted ? 1 : 0;
                            activeObject.applyFilters(canvas.renderAll.bind(canvas));
                        }
                    }
                };

                self.applyTint = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject !== undefined && activeObject !== null) {
                        if (activeObject.filters[0] !== undefined && activeObject.filters[0] !== null) {
                            activeObject.filters[0].opacity = 1;
                            activeObject.applyFilters(canvas.renderAll.bind(canvas));
                        }
                    }
                };

                self.resetTint = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject !== undefined && activeObject !== null) {
                        if (activeObject.filters[0] !== undefined && activeObject.filters[0] !== null) {
                            activeObject.filters[0].opacity = 0;
                            activeObject.applyFilters(canvas.renderAll.bind(canvas));
                        }
                    }
                };


                self.getTint = function () {
                    var object = canvas.getActiveObject();

                    if (typeof object !== 'object' || object === null) {
                        return '';
                    }

                    if (object.filters !== undefined && object.filters !== null) {
                        if (object.filters[0] !== undefined && object.filters[0] !== null) {
                            return object.filters[0].color;
                        }
                    }
                };

                self.setTint = function (tint) {
                    if (!isHex(tint)) {
                        return;
                    }

                    var activeObject = canvas.getActiveObject();
                    if (activeObject.filters !== undefined && activeObject.filters !== null) {
                        if (activeObject.filters[0] !== undefined && activeObject.filters[0] !== null) {
                            activeObject.filters[0].color = tint;
                            activeObject.applyFilters(canvas.renderAll.bind(canvas));
                        }
                    }
                };

                //
                // Active Object Fill Color
                // ==============================================================
                self.getFill = function () {
                    return getActiveStyle('fill');
                };

                self.setFill = function (value) {
                    value = $.trim(value);
                    if (typeof value != "undefined" && value.length > 0) {
                        var object = canvas.getActiveObject();
                        if (object) {
                            if (object.type === 'text') {
                                setActiveStyle('fill', value);
                            } else {
                                self.setFillPath(object, value);
                            }
                        }
                    }
                };

                self.setFillPath = function (object, value) {
                    if (object.isSameColor && object.isSameColor() || !object.paths) {
                        object.setFill(value);
                    } else if (object.paths) {
                        for (var i = 0; i < object.paths.length; i++) {
                            object.paths[i].setFill(value);
                        }
                    }
                };
                //
                // Zoom In
                // ===============================================================
                self.zoomInObject = function () {
                    var SCALE_FACTOR = 1.05;


                    var activeObject = canvas.getActiveObject();

                    if (activeObject) {

                        var scaleX = activeObject.scaleX;
                        var scaleY = activeObject.scaleY;
                        var left = activeObject.left;
                        var top = activeObject.top;

                        var tempScaleX = scaleX * SCALE_FACTOR;
                        var tempScaleY = scaleY * SCALE_FACTOR;
                        //var tempLeft = left * SCALE_FACTOR;
                        //var tempTop = top * SCALE_FACTOR;

                        activeObject.scaleX = tempScaleX;
                        activeObject.scaleY = tempScaleY;
                        //activeObject.left = tempLeft;
                        //activeObject.top = tempTop;

                        activeObject.setCoords();

                        canvas.renderAll();

                    }
                };
                //
                // Zoom Out
                // ==============================================================
                self.zoomOutObject = function () {
                    var SCALE_FACTOR = 1.05;

                    var activeObject = canvas.getActiveObject();

                    if (activeObject) {

                        var scaleX = activeObject.scaleX;
                        var scaleY = activeObject.scaleY;
                        var left = activeObject.left;
                        var top = activeObject.top;

                        var tempScaleX = scaleX * (1 / SCALE_FACTOR);
                        var tempScaleY = scaleY * (1 / SCALE_FACTOR);
                        // var tempLeft = left * (1 / SCALE_FACTOR);
                        //var tempTop = top * (1 / SCALE_FACTOR);

                        activeObject.scaleX = tempScaleX;
                        activeObject.scaleY = tempScaleY;
                        // activeObject.left = tempLeft;
                        // activeObject.top = tempTop;

                        activeObject.setCoords();

                        canvas.renderAll();
                    }
                };

                //
                // Canvas Zoom
                // ==============================================================
                self.resetZoom = function () {
                    self.canvasScale = 1;
                    self.setZoom();
                };

                self.setZoom = function () {
                    var objects = canvas.getObjects();
                    for (var i in objects) {
                        objects[i].originalScaleX = objects[i].originalScaleX ? objects[i].originalScaleX : objects[i].scaleX;
                        objects[i].originalScaleY = objects[i].originalScaleY ? objects[i].originalScaleY : objects[i].scaleY;
                        objects[i].originalLeft = objects[i].originalLeft ? objects[i].originalLeft : objects[i].left;
                        objects[i].originalTop = objects[i].originalTop ? objects[i].originalTop : objects[i].top;
                        self.setObjectZoom(objects[i]);
                    }

                    self.setCanvasZoom();
                    self.render();
                };

                self.setObjectZoom = function (object) {
                    var scaleX = object.originalScaleX;
                    var scaleY = object.originalScaleY;
                    var left = object.originalLeft;
                    var top = object.originalTop;

                    var tempScaleX = scaleX * self.canvasScale;
                    var tempScaleY = scaleY * self.canvasScale;
                    var tempLeft = left * self.canvasScale;
                    var tempTop = top * self.canvasScale;

                    object.scaleX = tempScaleX;
                    object.scaleY = tempScaleY;
                    object.left = tempLeft;
                    object.top = tempTop;

                    object.setCoords();
                };

                self.setCanvasZoom = function () {
                    var width = self.canvasOriginalWidth;
                    var height = self.canvasOriginalHeight;

                    var tempWidth = width * self.canvasScale;
                    var tempHeight = height * self.canvasScale;

                    canvas.setWidth(tempWidth);
                    canvas.setHeight(tempHeight);
                };

                self.updateActiveObjectOriginals = function () {
                    var object = canvas.getActiveObject();
                    if (object) {
                        object.originalScaleX = object.scaleX / self.canvasScale;
                        object.originalScaleY = object.scaleY / self.canvasScale;
                        object.originalLeft = object.left / self.canvasScale;
                        object.originalTop = object.top / self.canvasScale;
                    }
                };

                //
                // Active Object Lock
                // ==============================================================
                self.toggleLockActiveObject = function () {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        activeObject.lockMovementX = !activeObject.lockMovementX;
                        activeObject.lockMovementY = !activeObject.lockMovementY;
                        activeObject.lockScalingX = !activeObject.lockScalingX;
                        activeObject.lockScalingY = !activeObject.lockScalingY;
                        activeObject.lockUniScaling = !activeObject.lockUniScaling;
                        activeObject.lockRotation = !activeObject.lockRotation;
                        activeObject.lockObject = !activeObject.lockObject;
                        self.render();
                    }
                };

                //
                // Object Lock
                // ==============================================================
                self.toggleLockObject = function (activeObj) {

                    if (activeObj) {
                        activeObj.lockMovementX = !activeObj.lockMovementX;
                        activeObj.lockMovementY = !activeObj.lockMovementY;
                        activeObj.lockScalingX = !activeObj.lockScalingX;
                        activeObj.lockScalingY = !activeObj.lockScalingY;
                        activeObj.lockUniScaling = !activeObj.lockUniScaling;
                        activeObj.lockRotation = !activeObj.lockRotation;
                        activeObj.lockObject = !activeObj.lockObject;
                        self.render();
                    }
                };

                //
                // Lock Status
                // ==============================================================

                self.isLocked = function () {
                    var activeObject = canvas.getActiveObject();
                    if (null != activeObject) {
                        if (activeObject.lockObject) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                };

                //
                // Object Lock Status
                // ==============================================================

                self.isObjectLocked = function (activeObj) {
                    if (null != activeObj) {
                        if (activeObj.lockObject) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                };

                //
                // Active Object
                // ==============================================================
                self.selectActiveObject = function (object) {
                    if (object == null) {
                        var activeObject = canvas.getActiveObject();
                    } else {
                        var activeObject = object;
                        canvas.setActiveObject(object);
                    }
                    if (!activeObject) {
                        return;
                    }

                    self.selectedObject = activeObject;
                    self.selectedObject.text = self.getText();
                    self.selectedObject.textWordCloud = "";
                    self.selectedObject.isCurved = self.getIsCurved();
                    self.selectedObject.isReversed = self.getIsReversed();
                    self.selectedObject.fontSize = self.getFontSize();
                    self.selectedObject.lineHeight = self.getLineHeight();
                    self.selectedObject.textAlign = self.getTextAlign();
                    self.selectedObject.opacity = self.getOpacity();
                    self.selectedObject.fontFamily = self.getFontFamily();
                    self.selectedObject.fill = self.getFill();
                    self.selectedObject.tint = self.getTint();

                };

                self.addWordCloud = function (wordsStr) {
                    var words = self.generateWordCloudText(wordsStr);
                    d3.layout.cloud().size([400, 300])
                        .padding(3)
                        .words(words)
                        .rotate(function () {
                            return ~~(Math.random() * 2) * 90;
                        })
                        .fontSize(function (d) {
                            return d.size;
                        })
                        .on("end", self.drawWordCloud)
                        .start();
                };

                self.drawWordCloud = function (wordsInit) {

                    var color = d3.scale.linear()
                        .domain([0, 1, 2, 3, 4, 5, 6, 10, 15, 20, 40, 60, 80, 100])
                        .range(["#5254A3", "#8CA252", "#DE9ED6", "#6B6ECF", "#A55194", "#D6616B", "#E7BA52", "#9C9EDE", "#393B79", "#B51E1E", "#045725", "#1759BB", "#78243d", "#008080"]);
                    $('#wordcloud').html('');

                    d3.select("#wordcloud").append("svg")
                        .attr("width", '400px')
                        .attr("height", '400px')
                        .append("g")
                        .attr("transform", "translate(195,200)")
                        .selectAll("text")
                        .data(wordsInit)
                        .enter().append("text")
                        .style("font-size", function (d) {
                            return d.size + "px";
                        })
                        .style("font-family", "Impact")
                        .style("fill", function (d, i) {
                            return color(i);
                        })
                        .attr("text-anchor", "middle")
                        .attr("transform", function (d) {
                            return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
                        })
                        .text(function (d) {
                            return d.text;
                        });


                    var html = d3.select("svg")
                        .attr("version", 1.1)
                        .attr("xmlns", "http://www.w3.org/2000/svg")
                        .node().parentNode.innerHTML;

                    //self.addShapeString(html);

                    var imgsrc = 'data:image/svg+xml;base64,' + btoa(html);
                    self.addImage(imgsrc);
                    $('#wordcloud').html('');


                };


                self.generateWordCloudText = function (str) {

                    var generatedObj = [];
                    var res = str.split(" ");
                    var textLen = res.length;
                    var wordsNew = [""];
                    if (textLen < 200) {
                        for (i = 0; i <= 199; i++) {
                            var res2 = wordsNew[0].split(" ");
                            var textLenNew = res2.length;
                            if (textLenNew < 200) {
                                wordsNew[0] += " " + str;
                            }
                        }

                        var wordsNew2 = wordsNew[0].split(" ");

                        for (var i = 0, l = wordsNew2.length; i < l; i++) {
                            generatedObj.push({"text": wordsNew2[i], "size": self.getRandomArbitrary()});
                        }

                    } else {
                        for (var i = 0, l = res.length; i < l; i++) {
                            generatedObj.push({"text": res[i], "size": self.getRandomArbitrary()});
                        }
                    }

                    return generatedObj;
                };

                self.getRandomArbitrary = function () {
                    var min = 13;
                    var max = 40;
                    var result = Math.floor(Math.random() * (max - min));
                    return result;
                };


                self.getIsCurved = function () {
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            return true;
                        } else if (/text/.test(obj.type)) {
                            return false;
                        }
                    }
                };

                self.getIsReversed = function () {
                    var obj = canvas.getActiveObject();
                    if (obj) {
                        if (/curvedText/.test(obj.type)) {
                            return getActiveStyle('reverse');
                        }
                    }
                };

                //
                // deselect Active object
                // ============================================================

                self.deselectActiveObject = function () {
                    self.selectedObject = false;
                };

                //
                // delete Active object
                // ============================================================

                self.deleteActiveObject = function () {
                    var activeObject = canvas.getActiveObject();
                    canvas.remove(activeObject);
                    self.render();
                };

                //
                // delete object
                // ============================================================

                self.deleteObject = function (activeObj) {
                    canvas.remove(activeObj);
                    self.render();
                };

                //
                // State Managers
                // ==============================================================
                self.isLoading = function () {
                    return self.loading;
                };

                self.setLoading = function (value) {
                    self.loading = value;
                };

                self.setDirty = function (value) {
                    FabricDirtyStatus.setDirty(value);
                };

                self.isDirty = function () {
                    return FabricDirtyStatus.isDirty();
                };

                self.setInitalized = function (value) {
                    self.initialized = value;
                };

                self.isInitalized = function () {
                    return self.initialized;
                };

                //
                // JSON
                // ==============================================================
                self.getJSON = function () {
                    var initialCanvasScale = self.canvasScale;
                    self.canvasScale = 1;
                    self.resetZoom();

                    var json = JSON.stringify(canvas.toJSON(self.JSONExportProperties));

                    self.canvasScale = initialCanvasScale;
                    self.setZoom();

                    return json;
                };

                self.loadJSON = function (json) {
                    self.setLoading(true);
                    canvas.loadFromJSON(json, function () {
                        $timeout(function () {
                            self.setLoading(false);

                            if (!self.editable) {
                                self.disableEditing();
                            }

                            self.render();
                        });
                    });
                };

                //
                // Save Canvas
                // ==============================================================
                self.exportCanvasObjectAsJson = function () {

                    canvas.deactivateAll().renderAll();
                    return canvas.toJSON();
                };


                //
                // Save Canvas
                // ==============================================================
                self.saveCanvasObject = function () {

                    canvas.deactivateAll().renderAll();

                    // My SVG file as s string.
                    var mySVG = canvas.toSVG();
                    var currentFontUrl = "./css/fonts.css";
                    $(document).find('.svgElements').html(mySVG);
                    var fonts = '<defs><style type="text/css">@import url("http://fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka");@import url(' + currentFontUrl + ');</style></defs>';
                    $(fonts).insertAfter($(document).find(".svgElements > svg > desc"));
                    var svgResult = $(document).find('.svgElements').html();

                    // Create a Data URI.
                    // var svg = 'data:image/svg+xml;base64,'+window.btoa(svgResult);
                    var svg = 'data:image/svg+xml;base64,' + window.btoa(unescape(encodeURIComponent(svgResult)));
                    window.open(svg);
                };

                //
                // Save Canvas
                // ==============================================================
                self.saveCanvasObjectAsSvg = function () {

                    canvas.deactivateAll().renderAll();

                    // My SVG file as s string.
                    var mySVG = canvas.toSVG();
                    var currentFontUrl = "./css/fonts.css";
                    $(document).find('.svgElements').html(mySVG);
                    var fonts = '<defs><style type="text/css">@import url("http://fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka");@import url(' + currentFontUrl + ');</style></defs>';
                    $(fonts).insertAfter($(document).find(".svgElements > svg > desc"));
                    var svgResult = $(document).find('.svgElements').html();


                    // Create a Data URI.
                    // var svg = 'data:image/svg+xml;base64,'+window.btoa(svgResult);
                    var svg = 'data:image/svg+xml;base64,' + window.btoa(unescape(encodeURIComponent(svgResult)));

                    return svg;
                };

                //
                // Save Canvas
                // ==============================================================
                self.saveCanvasObjectAsPng = function () {

                    canvas.deactivateAll().renderAll();

                    var png = canvas.toDataURL({
                        format: 'png',
                        multiplier: 1
                    });

                    return png;
                };

                //
                // Save Canvas
                // ==============================================================
                self.saveCanvasObjectAsJpg = function () {

                    canvas.deactivateAll().renderAll();

                    var jpeg = canvas.toDataURL({
                        format: 'jpeg',
                        multiplier: 1
                    });

                    return jpeg;
                };

                //
                // Export Canvas
                // ==============================================================
                self.downloadCanvasObject = function () {
                    canvas.deactivateAll().renderAll();

                    var data = canvas.toDataURL({
                        format: 'png',
                        multiplier: 1
                    });

                    var img = document.createElement('img');
                    img.src = data;

                    var a = document.createElement('a');
                    a.setAttribute("download", "export.png");
                    a.setAttribute("href", data);
                    a.appendChild(img);

                    var w = open();
                    w.document.title = 'Export Image';
                    w.document.body.appendChild(a);

                };

                //
                // download Canvas As PDF
                // =============================================================
                self.downloadCanvasObjectAsPDF = function () {
                    canvas.deactivateAll().renderAll();

                    try {
                        canvas.getContext('2d');
                        var imgData = canvas.toDataURL("image/jpeg", 1.0);
                        var pdf = new jsPDF('p', 'mm', [297, 210]);
                        pdf.addImage(imgData, 'JPEG', 5, 5);
                        var namefile = 'export';
                        if (namefile != null) {
                            pdf.save(namefile + ".pdf");
                            return true;
                        } else {
                            return false;
                        }
                    } catch (e) {
                        alert("Error description: " + e.message);
                    }
                };

                //
                // Print Canvas
                // =============================================================
                self.printCanvasObject = function () {
                    canvas.deactivateAll().renderAll();

                    var dataUrl = canvas.toDataURL(); //attempt to save base64 string to server using this var
                    var windowContent = '<!DOCTYPE html>';
                    windowContent += '<html>'
                    windowContent += '<head><title>Print canvas</title></head>';
                    windowContent += '<body>'
                    windowContent += '<img src="' + dataUrl + '">';
                    windowContent += '</body>';
                    windowContent += '</html>';
                    var printWin = window.open('', '', 'width=440,height=360');
                    printWin.document.open();
                    printWin.document.write(windowContent);
                    printWin.document.close();
                    printWin.focus();
                    printWin.print();
                    printWin.close();

                };

                //
                // Download Canvas
                // ==============================================================
                self.getCanvasData = function () {
                    var data = canvas.toDataURL({
                        width: canvas.getWidth(),
                        height: canvas.getHeight(),
                        multiplier: self.downloadMultipler
                    });

                    return data;
                };

                self.getCanvasBlob = function () {
                    var base64Data = self.getCanvasData();
                    var data = base64Data.replace('data:image/png;base64,', '');
                    var blob = b64toBlob(data, 'image/png');
                    var blobUrl = URL.createObjectURL(blob);

                    return blobUrl;
                };

                self.download = function (name) {
                    // Stops active object outline from showing in image
                    self.deactivateAll();

                    var initialCanvasScale = self.canvasScale;
                    self.resetZoom();

                    // Click an artifical anchor to 'force' download.
                    var link = document.createElement('a');
                    var filename = name + '.png';
                    link.download = filename;
                    link.href = self.getCanvasBlob();
                    link.click();

                    self.canvasScale = initialCanvasScale;
                    self.setZoom();
                };

                //
                // Continuous Rendering
                // ==============================================================
                // Upon initialization re render the canvas
                // to account for fonts loaded from CDN's
                // or other lazy loaded items.

                // Prevent infinite rendering loop
                self.continuousRenderCounter = 0;
                self.continuousRenderHandle;

                self.stopContinuousRendering = function () {
                    $timeout.cancel(self.continuousRenderHandle);
                    self.continuousRenderCounter = self.maxContinuousRenderLoops;
                };

                self.startContinuousRendering = function () {
                    self.continuousRenderCounter = 0;
                    self.continuousRender();
                };

                // Prevents the "not fully rendered up upon init for a few seconds" bug.
                self.continuousRender = function () {
                    if (self.userHasClickedCanvas || self.continuousRenderCounter > self.maxContinuousRenderLoops) {
                        return;
                    }

                    self.continuousRenderHandle = $timeout(function () {
                        self.setZoom();
                        self.render();
                        self.continuousRenderCounter++;
                        self.continuousRender();
                    }, self.continuousRenderTimeDelay);
                };

                //
                // Utility
                // ==============================================================
                self.setUserHasClickedCanvas = function (value) {
                    self.userHasClickedCanvas = value;
                };

                self.createId = function () {
                    return Math.floor(Math.random() * 10000);
                };

                //
                // Toggle Object Selectability
                // ==============================================================
                self.disableEditing = function () {
                    canvas.selection = false;
                    canvas.forEachObject(function (object) {
                        object.selectable = false;
                    });
                };

                self.enableEditing = function () {
                    canvas.selection = true;
                    canvas.forEachObject(function (object) {
                        object.selectable = true;
                    });
                };


                //
                // Set Global Defaults
                // ==============================================================
                self.setCanvasDefaults = function () {
                    canvas.selection = self.canvasDefaults.selection;
                };

                self.setWindowDefaults = function () {
                    FabricWindow.Object.prototype.transparentCorners = self.windowDefaults.transparentCorners;
                    FabricWindow.Object.prototype.rotatingPointOffset = self.windowDefaults.rotatingPointOffset;
                    FabricWindow.Object.prototype.padding = self.windowDefaults.padding;
                };

                //
                // Canvas Listeners
                // ============================================================
                self.startCanvasListeners = function () {
                    canvas.on('object:selected', function () {
                        self.stopContinuousRendering();
                        $timeout(function () {
                            self.selectActiveObject();
                            self.setDirty(true);
                        });
                    });

                    canvas.on('selection:created', function () {
                        self.stopContinuousRendering();
                    });

                    canvas.on('selection:cleared', function () {
                        $timeout(function () {
                            self.deselectActiveObject();
                        });
                    });

                    canvas.on('after:render', function () {
                        canvas.calcOffset();
                    });

                    canvas.on('object:modified', function () {
                        self.stopContinuousRendering();
                        $timeout(function () {
                            self.updateActiveObjectOriginals();
                            self.setDirty(true);
                        });
                    });

                    canvas.on('object:moving', function(e) {
                        e.target.opacity = 0.5;

                        var activeObject = e.target;

                        if (activeObject.get('left') < 0) {
                            activeObject.set('left', 0);
                        }

                        if (activeObject.get('top') < 0) {
                            activeObject.set('top', 0);
                        }

                        if (activeObject.get('left') + activeObject.get('width') > canvas.getWidth())
                        {
                            activeObject.set('left', canvas.getWidth() - activeObject.get('width'));
                        }

                        if (activeObject.get('top') + activeObject.get('height') > canvas.getHeight())
                        {
                            activeObject.set('top', canvas.getHeight() - activeObject.get('height'));
                        }
                    });

                    canvas.on('object:modified', function(e) {
                        e.target.opacity = 1;

                    });
                };

                self.toggleDrawing = function () {
                    canvas.isDrawingMode = !canvas.isDrawingMode;
                    if (canvas.isDrawingMode) {
                        return 'Cancel';
                    }
                    else {
                        return 'Enter';
                    }

                };

                self.enterDrawing = function () {
                    canvas.isDrawingMode = true;

                };

                self.exitDrawing = function () {
                    canvas.isDrawingMode = false;

                };

                self.changeDrawingMode = function (mode, color, width, shadow) {

                    if (fabric.PatternBrush) {

                        var vLinePatternBrush = new fabric.PatternBrush(canvas);
                        vLinePatternBrush.getPatternSrc = function () {
                            var patternCanvas = fabric.document.createElement('canvas');
                            patternCanvas.width = patternCanvas.height = 10;
                            var ctx = patternCanvas.getContext('2d');

                            ctx.strokeStyle = this.color;
                            ctx.lineWidth = 5;
                            ctx.beginPath();
                            ctx.moveTo(0, 5);
                            ctx.lineTo(10, 5);
                            ctx.closePath();
                            ctx.stroke();

                            return patternCanvas;
                        };

                        var hLinePatternBrush = new fabric.PatternBrush(canvas);
                        hLinePatternBrush.getPatternSrc = function () {

                            var patternCanvas = fabric.document.createElement('canvas');
                            patternCanvas.width = patternCanvas.height = 10;
                            var ctx = patternCanvas.getContext('2d');

                            ctx.strokeStyle = this.color;
                            ctx.lineWidth = 5;
                            ctx.beginPath();
                            ctx.moveTo(5, 0);
                            ctx.lineTo(5, 10);
                            ctx.closePath();
                            ctx.stroke();

                            return patternCanvas;
                        };

                        var squarePatternBrush = new fabric.PatternBrush(canvas);
                        squarePatternBrush.getPatternSrc = function () {

                            var squareWidth = 10, squareDistance = 2;

                            var patternCanvas = fabric.document.createElement('canvas');
                            patternCanvas.width = patternCanvas.height = squareWidth + squareDistance;
                            var ctx = patternCanvas.getContext('2d');

                            ctx.fillStyle = this.color;
                            ctx.fillRect(0, 0, squareWidth, squareWidth);

                            return patternCanvas;
                        };

                        var diamondPatternBrush = new fabric.PatternBrush(canvas);
                        diamondPatternBrush.getPatternSrc = function () {

                            var squareWidth = 10, squareDistance = 6;
                            var patternCanvas = fabric.document.createElement('canvas');
                            var rect = new fabric.Rect({
                                width: squareWidth,
                                height: squareWidth,
                                angle: 45,
                                fill: this.color
                            });

                            var canvasWidth = rect.getBoundingRectWidth();
                            var canvasWidth = canvasWidth - 28;
                            patternCanvas.width = patternCanvas.height = canvasWidth + squareDistance;
                            rect.set({left: canvasWidth / 2, top: canvasWidth / 2});

                            var ctx = patternCanvas.getContext('2d');
                            rect.render(ctx);

                            return patternCanvas;
                        };


                    }

                    if (mode === 'hline') {
                        canvas.freeDrawingBrush = vLinePatternBrush;
                    }
                    else if (mode === 'vline') {
                        canvas.freeDrawingBrush = hLinePatternBrush;
                    }
                    else if (mode === 'square') {
                        canvas.freeDrawingBrush = squarePatternBrush;
                    }
                    else if (mode === 'diamond') {
                        canvas.freeDrawingBrush = diamondPatternBrush;
                    }
                    else if (mode === 'texture') {
                        canvas.freeDrawingBrush = texturePatternBrush;
                    }
                    else {

                        canvas.freeDrawingBrush = new fabric[mode + 'Brush'](canvas);
                    }

                    canvas.freeDrawingBrush.color = color;
                    canvas.freeDrawingBrush.width = parseInt(width, 10) || 1;
                    canvas.freeDrawingBrush.shadowBlur = parseInt(shadow, 10) || 0;


                };

                self.resetBrush = function (mode, color, width, shadow) {

                    canvas.freeDrawingBrush = new fabric[mode + 'Brush'](canvas);
                    canvas.freeDrawingBrush.color = color;
                    canvas.freeDrawingBrush.width = parseInt(width, 10) || 1;
                    canvas.freeDrawingBrush.shadowBlur = parseInt(shadow, 10) || 0;
                };

                self.fillDrawing = function (color) {
                    canvas.freeDrawingBrush.color = color;
                };

                self.changeDrawingWidth = function (width) {
                    canvas.freeDrawingBrush.width = parseInt(width, 10) || 1;
                };

                self.changeDrawingShadow = function (shadow) {
                    canvas.freeDrawingBrush.shadowBlur = parseInt(shadow, 10) || 0;
                };

                self.readyHandTool = function (dBrush, dColor, dWidth, dShadow) {

                    if (canvas.freeDrawingBrush) {
                        canvas.freeDrawingBrush = new fabric[dBrush + 'Brush'](canvas);
                        canvas.freeDrawingBrush.color = dColor;
                        canvas.freeDrawingBrush.width = parseInt(dWidth, 10) || 1;
                        canvas.freeDrawingBrush.shadowBlur = parseInt(dShadow, 10) || 0;
                    }

                };

                //
                // Constructor
                // ==============================================================
                self.init = function () {
                    var winWidth = $(window).width();
                    canvas = FabricCanvas.getCanvas();
                    var canvasSize = 500;
                    self.canvasId = FabricCanvas.getCanvasId();
                    canvas.clear();

                    if (winWidth < 400) {
                        canvasSize = 220;
                    } else if (winWidth < 600) {
                        canvasSize = 350;
                    }

                    // For easily accessing the json
                    JSONObject = angular.fromJson(self.json);
                    self.loadJSON(self.json);

                    JSONObject = JSONObject || {};

                    self.canvasScale = 1;

                    JSONObject.background = JSONObject.background || '';
                    // self.setCanvasBackgroundColor(JSONObject.background);

                    // Set the size of the canvas
                    JSONObject.width = JSONObject.width || canvasSize;
                    self.canvasOriginalWidth = JSONObject.width;

                    JSONObject.height = JSONObject.height || canvasSize;
                    self.canvasOriginalHeight = JSONObject.height;

                    self.setCanvasSize(self.canvasOriginalWidth, self.canvasOriginalHeight);

                    self.render();
                    self.setDirty(false);
                    self.setInitalized(true);

                    self.setCanvasDefaults();
                    self.setWindowDefaults();
                    self.startCanvasListeners();
                    self.startContinuousRendering();
                    FabricDirtyStatus.startListening();
                };
                self.init();
                return self;
            };
        }]);

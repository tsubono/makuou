'use strict';
angular.module('common.fabric.constants', []).service('FabricConstants', [function() {

	var objectDefaults = {
		rotatingPointOffset: 10,
		padding: 10,
		borderColor: 'EEF6FC',
		cornerColor: '#FFC23F',
		cornerSize: 24,
		transparentCorners: false,
		hasRotatingPoint: false,
		centerTransform: true
	};

	return {

		fonts: [
			{ name: '龍神' },
			{ name: '雷神' },
			{ name: '風神' },
			{ name: '清龍' },
			{ name: '昇龍' },
			{ name: '花神' },
			{ name: '太楷書' },
			{ name: '太行書' },
			{ name: '昭和楷書' },
			{ name: '昭和隷書' },
			{ name: '昭和行書' },
			{ name: '青柳隷書しも' },
			{ name: '衡山毛筆フォント' },
			{ name: 'さむらい' },
			{ name: '康印体' },
			{ name: 'ゴシック体' },
			{ name: 'やさしさゴシック' },
			{ name: 'フォーク' },
			{ name: 'スターゴシック体' },
			{ name: 'ひびゴシック体' },
			{ name: '太丸ゴシック体' },
			{ name: '細丸ゴシック体' },
			{ name: '猫まる体' },
			{ name: '丸シャドー' },
			{ name: 'ポップ体' },
			{ name: 'たぬき油性マジック' },
			{ name: 'てがき筆' },
			{ name: '明朝体' },
			{ name: '華康明朝体' },
			{ name: '優雅宋' },
			{ name: 'Arial' },
			{ name: 'Times New Roman' },
			{ name: 'Beau' },
			{ name: 'Impact' },
			{ name: 'Banty' },
			{ name: 'Vogel' },
			{ name: 'Cupid' },
			{ name: 'Arenski' },
			{ name: 'Magneto' },
			{ name: 'Gregory' },
			{ name: 'Time' },
			{ name: 'Ninepin' },
			{ name: 'stencil' },
			{ name: 'DEATH' },
			{ name: 'Saltpeter' },
			{ name: 'Tangiers' },
			{ name: 'Rosewood' },
			{ name: 'Collegiate' },
			{ name: 'Phoenix' },
			{ name: 'Native' }
		],

		JSONExportProperties: [
			'height',
			'width',
			'background',
			'objects',

			'originalHeight',
			'originalWidth',
			'originalScaleX',
			'originalScaleY',
			'originalLeft',
			'originalTop',

			'lineHeight',
			'lockMovementX',
			'lockMovementY',
			'lockScalingX',
			'lockScalingY',
			'lockUniScaling',
			'lockRotation',
			'lockObject',
			'id',
			'isTinted',
			'filters'
		],

        imageFilters: [
            'grayscale',
            'invert',
            'remove-white',
            'sepia',
            'sepia2',
            'brightness',
            'noise',
            'gradient-transparency',
            'pixelate',
            'blur',
            'sharpen',
            'emboss',
            'tint',
            'multiply',
            'blend'
        ],

		shapeDefaults: angular.extend({
            left: 150,
            top:200,
            scaleX: .35,
            scaleY:.35
		}, objectDefaults),

        imageDefaults: angular.extend({

        }, objectDefaults),

		textDefaults: angular.extend({
			originX: 'left',
			scaleX: 1,
			scaleY: 1,
			fontFamily: 'ゴシック体',
			fontSize: 32,
			fill: '#000000',
			textAlign: 'left'
		}, objectDefaults),

        curvedTextDefaults: angular.extend({
            angle: 0,
            spacing: 10,
            radius: 100,
            text: 'Curved text',
            textAlign: 'center',
            reverse: false
        }, objectDefaults)

	};

}]);

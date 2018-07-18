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
			{ name: '龍神' , family: 'KswRyujin3N'},
			{ name: '雷神' , family: 'KswRaijinN'},
			{ name: '風神' , family: 'KswFujinN'},
			{ name: '清龍' , family: 'KswSeiryuN'},
			{ name: '昇龍' , family: 'KswShoryuN'},
			{ name: '花神' , family: 'KswKashinN'},
			{ name: '太楷書' , family: 'KswFutokaishoN'},
			{ name: '太行書' , family: 'KswFutogyoshoN'},
			{ name: '昭和楷書' , family: 'KswKaishoN'},
			{ name: '昭和隷書' , family: 'KswReishoN'},
			{ name: '昭和行書' , family: 'KswGyoshoN'},
			{ name: '青柳隷書しも' , family: 'aoyagireisyosimo'},
			{ name: '衡山毛筆フォント' , family: 'KouzanBrushFont'},
			{ name: 'さむらい' , family: 'Samurai'},
			{ name: '康印体' , family: 'DFKoIn-W4-WINP-RKSJ-H'},
			{ name: 'ゴシック体' , family: 'DFHSGothic-W5-WINP-RKSJ-H'},
			{ name: 'やさしさゴシック' , family: '07YasashisaGothicBold'},
			{ name: 'フォーク' , family: 'FolkPro-Bold-90ms-RKSJ-H'},
			{ name: 'スターゴシック体' , family: 'DFStarGothic-W12-WINP-RKSJ-H'},
			{ name: 'ひびゴシック体' , family: 'DFHibiGothic-W14-WIN-RKSJ-H'},
			{ name: '太丸ゴシック体' , family: 'DFMaruGothic-SB-WINP-RKSJ-H'},
			{ name: '細丸ゴシック体' , family: 'DFMaruGothic-Lt-WINP-RKSJ-H'},
			{ name: '猫まる体' , family: 'DFNekoMaru-W12-WINP-RKSJ-H'},
			{ name: '丸シャドー' , family: 'GMYPMSHADOWOREB'},
			{ name: 'ポップ体' , family: 'HGPSoeiKakupoptai'},
			{ name: 'たぬき油性マジック' , family: 'Tanuki-Permanent-Marker'},
			{ name: 'てがき筆' , family: 'RiiTegakiFude-90ms-RKSJ-H'},
			{ name: '明朝体' , family: 'DFMincho-UB-WINP-RKSJ-H'},
			{ name: '華康明朝体' , family: 'DFMinchoP-W5-WINP-RKSJ-H'},
			{ name: '優雅宋' , family: 'DFYuGaSo-W5-WINP-RKSJ-H'},
			{ name: 'Arial' , family: 'ArialMT'},
			{ name: 'Times New Roman' , family: 'TimesNewRomanPSMT'},
			{ name: 'Beau' , family: 'BeauNormal'},
			{ name: 'Impact' , family: 'Impact'},
			{ name: 'Banty' , family: 'BantyNormal'},
			{ name: 'Vogel' , family: 'VogelNormal'},
			{ name: 'Cupid' , family: 'CupidWideNormal'},
			{ name: 'Arenski' , family: 'Arenski'},
			{ name: 'Magneto' , family: 'Magneto-Bold'},
			{ name: 'Gregory' , family: 'GregoryNormal'},
			{ name: 'Time' , family: 'TimeNormal'},
			{ name: 'Ninepin' , family: 'NinepinNormal'},
			{ name: 'stencil' , family: 'Stencil'},
			{ name: 'DEATH' , family: 'DEATH-FONT-ver1.0'},
			{ name: 'Saltpeter' , family: 'Saltpeter-N-Fungus'},
			{ name: 'Tangiers' , family: 'TangiersNormal'},
			{ name: 'Rosewood' , family: 'RosewoodStd-Regular'},
			{ name: 'Collegiate' , family: 'CollegiateHeavyOutline-Medium'},
			{ name: 'Phoenix' , family: 'PhoenixNormal'},
			{ name: 'Native', family: 'NativeNormal' }
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
			fontFamily: 'DFHSGothic-W5-WINP-RKSJ-H',
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

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
			{ name: 'Arial' },
			{ name: 'Destroy' },
			{ name: 'Carme' },
			{ name: 'Geneva' },
			{ name: 'Helvetica' },
			{ name: 'League Spartan' },
			{ name: 'Lobster' },
			{ name: 'Open Sans' },
			{ name: 'Times New Roman' },
			{ name: 'Varsity' },
			{ name: 'Verdana' },
            { name: 'Oswald'},
            { name: 'Montserrat'},
            { name: 'Lora'},
            { name: 'PT Sans'},
            { name: 'Ubuntu'},
            { name: 'Roboto Slab'},
            { name: 'Fjalla One'},
            { name: 'Indie Flower'},
            { name: 'Playfair Display'},
            { name: 'Poiret One'},
            { name: 'Comic Book' },
            { name: 'Dosis'},
            { name: 'Oxyzen'},
            { name: 'Lobster'},
            { name: 'Play'},
            { name: 'Fearless' },
            { name: 'Shadows Into Light'},
            { name: 'Pacifico'},
            { name: 'Dansign Script'},
            { name: 'Kaushan Script'},
            { name: 'Gloria Hallelujah'},
            { name: 'Black Ops One'},
            { name: 'Lobster Two'},
            { name: 'Satisfy'},
            { name: 'Pontano Sans'},
            { name: 'Domine'},
            { name: 'Russo One'},
            { name: 'Arcade' },
            { name: 'Handlee'},
            { name: 'Courgette'},
            { name: 'Special Elite'},
            { name: 'Amaranth'},
            { name: 'Vidaloka'}

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
			fontFamily: 'Montserrat',
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

/**
 * Travelfic Slider Hero in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initSliderHero(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		// 1. Design 1 Slider
		$root.find('.tft-hero-design__one .tft-hero-slider-selector').each(function () {
			const $slider = $(this);

			// Prevent double initialization
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			// Clean up any existing counter to avoid duplicates on re-render in builder
			$slider.find('.slider__counter').remove();

			const sliderCounter = document.createElement('div');
			sliderCounter.classList.add('slider__counter');

			const updateCounter = function (slick) {
				let current = slick.slickCurrentSlide() + 1;
				current = ('0000' + current).match(/\d{2}$/);
				$(sliderCounter).text(current);
			};

			$slider.on('init', function (e, slick) {
				$slider.append(sliderCounter);
				updateCounter(slick);
			});

			$slider.on('afterChange', function (e, slick) {
				updateCounter(slick);
			});

			$slider.slick({
				dots: false,
				infinite: true,
				slidesToShow: 1,
				fade: true,
				speed: 500,
				cssEase: 'ease-in-out',
				touchThreshold: 100,
				autoplay: false,
				arrows: true,
				prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
				nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
				autoplaySpeed: 2000
			});
		});

		// 2. Design 4 Slider
		$root.find('.tft-hero-design__four__slider').each(function () {
			const $slider = $(this);

			// Read configuration options from data attributes
			const loop = $slider.data('loop') === true || $slider.data('loop') === 'true';
			const autoplay = $slider.data('autoplay') === true || $slider.data('autoplay') === 'true';
			const autoplaySpeed = parseInt($slider.data('autoplay-speed')) || 3000;
			const speed = parseInt($slider.data('speed')) || 1500;
			const fade = $slider.data('fade') === true || $slider.data('fade') === 'true';
			const dots = $slider.data('dots') === true || $slider.data('dots') === 'true';
			const arrows = $slider.data('arrows') === true || $slider.data('arrows') === 'true';
			const pauseOnHover = $slider.data('pause-on-hover') === true || $slider.data('pause-on-hover') === 'true';
			const pauseOnFocus = $slider.data('pause-on-focus') === true || $slider.data('pause-on-focus') === 'true';
			const rtl = $slider.data('rtl') === true || $slider.data('rtl') === 'true';
			const draggable = $slider.data('draggable') === true || $slider.data('draggable') === 'true';

			// Prevent double initialization
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			// Scope prev/next arrows to current element container/siblings
			let $prevArrow = $slider.siblings('.tft-hero-design__four__slider--nav').find('.tft-prev-slide');
			let $nextArrow = $slider.siblings('.tft-hero-design__four__slider--nav').find('.tft-next-slide');

			if (!$prevArrow.length) {
				$prevArrow = $root.find(".tft-hero-design__four__slider--nav .tft-prev-slide");
			}
			if (!$nextArrow.length) {
				$nextArrow = $root.find(".tft-hero-design__four__slider--nav .tft-next-slide");
			}

			$slider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: loop,
				autoplay: autoplay,
				autoplaySpeed: autoplaySpeed,
				speed: speed,
				fade: fade,
				dots: dots,
				arrows: arrows,
				pauseOnHover: pauseOnHover,
				pauseOnFocus: pauseOnFocus,
				rtl: rtl,
				draggable: draggable,
				prevArrow: $prevArrow,
				nextArrow: $nextArrow
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksSliderHero = function () {
			initSliderHero(document);
		};

		return;
	}

	const tftBricksSliderHeroFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-slider-hero',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initSliderHero(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksSliderHero = function () {
		tftBricksSliderHeroFn.run({ forceReinit: true });
	};
})();

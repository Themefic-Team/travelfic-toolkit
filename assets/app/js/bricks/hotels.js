/**
 * Travelfic Hotels/Tours/Apartments in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initHotels(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		// 1. Design 1 Tabs Switcher
		$root.find('.tft-popular-hotels-design__one').each(function () {
			const $this = $(this);
			$this.find('.tft-popular-hotel-header ul li').off('click').on('click', function () {
				let tab_type = $(this).attr('data-id');
				$this.find('.tft-hotel-header ul li').each(function () {
					$(this).children('button').removeClass('active').addClass('tft-btn_gray');
				});
				$(this).children('button').addClass('active').removeClass('tft-btn_gray');
				$this.find('.tft-popular-hotels-items').hide();
				$this.find('.tf-widget-' + tab_type + '-post').css('display', 'grid');
			});
		});

		// 2. Design 2 Slider
		$root.find('.tft-popular-hotels-design__two .tft-destination-slider').each(function () {
			const $slider = $(this);

			const slidesToShow = parseInt($slider.data('slides-to-show')) || 3;
			const slidesToScroll = parseInt($slider.data('slides-to-scroll')) || 1;
			const loop = $slider.data('loop') === true || $slider.data('loop') === 'true';
			const autoplay = $slider.data('autoplay') === true || $slider.data('autoplay') === 'true';
			const autoplaySpeed = parseInt($slider.data('autoplay-speed')) || 3000;
			const speed = parseInt($slider.data('speed')) || 1500;
			const dots = $slider.data('dots') === true || $slider.data('dots') === 'true';
			const arrows = $slider.data('arrows') === true || $slider.data('arrows') === 'true';
			const pauseOnHover = $slider.data('pause-on-hover') === true || $slider.data('pause-on-hover') === 'true';
			const pauseOnFocus = $slider.data('pause-on-focus') === true || $slider.data('pause-on-focus') === 'true';
			const rtl = $slider.data('rtl') === true || $slider.data('rtl') === 'true';
			const draggable = $slider.data('draggable') === true || $slider.data('draggable') === 'true';

			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			// Scope navigation buttons to current element's siblings/children
			let $prevArrow = $slider.siblings('.tft-destination-slider-nav').find('.tft-prev-slide');
			let $nextArrow = $slider.siblings('.tft-destination-slider-nav').find('.tft-next-slide');

			if (!$prevArrow.length) {
				$prevArrow = $root.find('.tft-popular-hotels-design__two .tft-prev-slide');
			}
			if (!$nextArrow.length) {
				$nextArrow = $root.find('.tft-popular-hotels-design__two .tft-next-slide');
			}

			$slider.slick({
				slidesToShow: slidesToShow,
				slidesToScroll: slidesToScroll,
				infinite: loop,
				autoplay: autoplay,
				autoplaySpeed: autoplaySpeed,
				speed: speed,
				dots: dots,
				arrows: arrows,
				pauseOnHover: pauseOnHover,
				pauseOnFocus: pauseOnFocus,
				rtl: rtl,
				draggable: draggable,
				cssEase: 'linear',
				prevArrow: $prevArrow,
				nextArrow: $nextArrow,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 640,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: true
						}
					}
				]
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksHotels = function () {
			initHotels(document);
		};

		return;
	}

	const tftBricksHotelsFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-hotels',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initHotels(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksHotels = function () {
		tftBricksHotelsFn.run({ forceReinit: true });
	};
})();

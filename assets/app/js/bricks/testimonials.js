/**
 * Travelfic Testimonials in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function getBool($element, key, fallback) {
		const value = $element.data(key);

		if (typeof value === 'undefined') {
			return fallback;
		}

		return value === true || value === 'true';
	}

	function getNumber($element, key, fallback) {
		const value = parseInt($element.data(key), 10);

		return Number.isNaN(value) ? fallback : value;
	}

	function initSlick($slider, config) {
		if (!$slider || !$slider.length || typeof $slider.slick !== 'function') {
			return;
		}

		if ($slider.hasClass('slick-initialized')) {
			$slider.slick('unslick');
		}

		$slider.slick(config);
	}

	function initTestimonials(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-testimonials-design__one .tft-testimonials-selector').each(function () {
			const $slider = $(this);
			const $wrapper = $slider.closest('.tft-testimonials-design__one');

			initSlick($slider, {
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 6000,
				speed: 700,
				dots: false,
				pauseOnHover: true,
				infinite: true,
				cssEase: 'linear',
				arrows: true,
				prevArrow: $wrapper.find('.slick-prev'),
				nextArrow: $wrapper.find('.slick-next'),
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: true,
							dots: false,
						},
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
				],
			});
		});

		$root.find('.tft-testimonials-design__two .tft-testimonials-slides').each(function () {
			const $slider = $(this);

			initSlick($slider, {
				dots: true,
				arrows: false,
				infinite: true,
				speed: 1000,
				autoplaySpeed: 3000,
				slidesToShow: 3,
				slidesToScroll: 1,
				centerMode: $slider.children().length > 3,
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: true,
						},
					},
					{
						breakpoint: 866,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
				],
			});
		});

		$root.find('.tft-testimonials-design__three .tft-testimonials-slides').each(function () {
			const $slider = $(this);
			const $wrapper = $slider.closest('.tft-testimonials-design__three');

			if ($slider.closest('.tft-testimonials-sliders').hasClass('tft-slider-disable')) {
				if ($slider.hasClass('slick-initialized')) {
					$slider.slick('unslick');
				}
				return;
			}

			initSlick($slider, {
				slidesToShow: getNumber($slider, 'slides-to-show', 2),
				slidesToScroll: getNumber($slider, 'slides-to-scroll', 1),
				infinite: getBool($slider, 'loop', true),
				autoplay: getBool($slider, 'autoplay', true),
				autoplaySpeed: getNumber($slider, 'autoplay-speed', 3000),
				speed: getNumber($slider, 'speed', 1500),
				dots: getBool($slider, 'dots', false),
				arrows: getBool($slider, 'arrows', true),
				pauseOnHover: getBool($slider, 'pause-on-hover', false),
				pauseOnFocus: getBool($slider, 'pause-on-focus', false),
				rtl: getBool($slider, 'rtl', false),
				draggable: getBool($slider, 'draggable', true),
				prevArrow: $wrapper.find('.tft-slider-prev'),
				nextArrow: $wrapper.find('.tft-slider-next'),
				responsive: [
					{
						breakpoint: 1199,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						},
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
				],
			});
		});

		$root.find('.tft-testimonials-design__four .tft-testimonials-selector').each(function () {
			const $slider = $(this);
			const $wrapper = $slider.closest('.tft-testimonials-design__four');

			initSlick($slider, {
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
				centerMode: true,
				centerPadding: '100px',
				autoplaySpeed: 6000,
				speed: 700,
				dots: false,
				pauseOnHover: true,
				infinite: true,
				cssEase: 'linear',
				arrows: true,
				prevArrow: $wrapper.find('.slick-prev'),
				nextArrow: $wrapper.find('.slick-next'),
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							centerPadding: '40px',
						},
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
				],
			});
		});

		$root.find('.tft-testimonials-design__five .tft-testimonials-selector').each(function () {
			const $slider = $(this);
			const $wrapper = $slider.closest('.tft-testimonials-design__five');

			initSlick($slider, {
				slidesToShow: 2,
				slidesToScroll: 1,
				infinite: getBool($slider, 'loop', true),
				autoplay: getBool($slider, 'autoplay', true),
				autoplaySpeed: getNumber($slider, 'autoplay-speed', 3000),
				speed: getNumber($slider, 'speed', 1500),
				dots: getBool($slider, 'dots', false),
				arrows: getBool($slider, 'arrows', true),
				pauseOnHover: getBool($slider, 'pause-on-hover', false),
				pauseOnFocus: getBool($slider, 'pause-on-focus', false),
				rtl: getBool($slider, 'rtl', false),
				draggable: getBool($slider, 'draggable', true),
				cssEase: 'linear',
				prevArrow: $wrapper.find('.slick-prev'),
				nextArrow: $wrapper.find('.slick-next'),
				variableWidth: true,
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: false,
						},
					},
				],
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksTestimonials = function () {
			initTestimonials(document);
		};

		return;
	}

	const tftBricksTestimonialsFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-testimonials',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initTestimonials(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksTestimonials = function () {
		tftBricksTestimonialsFn.run({ forceReinit: true });
	};
})();

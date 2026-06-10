/**
 * Travelfic Gallery Slider in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initGallerySlider(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-gallery-design__one .tft-gallery-selector').each(function () {
			const $slider = $(this);
			const $container = $slider.closest('.tft-gallery-design__one');

			const loop = $slider.data('loop') === true || $slider.data('loop') === 'true';
			const autoplay = $slider.data('autoplay') === true || $slider.data('autoplay') === 'true';
			const autoplaySpeed = parseInt($slider.data('autoplay-speed')) || 3000;
			const speed = parseInt($slider.data('speed')) || 1500;
			const dots = $slider.data('dots') === true || $slider.data('dots') === 'true';
			const arrows = $slider.data('arrows') === true || $slider.data('arrows') === 'true';
			const pauseOnHover = $slider.data('pause-on-hover') === true || $slider.data('pause-on-hover') === 'true';
			const pauseOnFocus = $slider.data('pause-on-focus') === true || $slider.data('pause-on-focus') === 'true';
			const draggable = $slider.data('draggable') === true || $slider.data('draggable') === 'true';

			// Prevent double initialization
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			const $prevArrow = $container.find('.slick-prev');
			const $nextArrow = $container.find('.slick-next');

			$slider.slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: loop,
				autoplay: autoplay,
				autoplaySpeed: autoplaySpeed,
				speed: speed,
				dots: dots,
				arrows: arrows,
				pauseOnHover: pauseOnHover,
				pauseOnFocus: pauseOnFocus,
				draggable: draggable,
				prevArrow: $prevArrow.length ? $prevArrow : undefined,
				nextArrow: $nextArrow.length ? $nextArrow : undefined,
				variableWidth: true,
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksGallery = function () {
			initGallerySlider(document);
		};

		return;
	}

	const tftBricksGalleryFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-gallery',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initGallerySlider(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksGallery = function () {
		tftBricksGalleryFn.run({ forceReinit: true });
	};
})();

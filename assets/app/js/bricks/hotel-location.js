/**
 * Travelfic Hotel Location in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initHotelLocation(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-destination-design__two .tft-destination-slides').each(function () {
			const $slider = $(this);

			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			const $container = $slider.closest('.tft-destination-design__two');
			const $prevArrow = $container.find('.tft-destination-slides-arrows .slick-prev');
			const $nextArrow = $container.find('.tft-destination-slides-arrows .slick-next');

			$slider.slick({
				dots: false,
				arrows: true,
				infinite: true,
				speed: 300,
				autoplaySpeed: 2000,
				slidesToShow: 3,
				slidesToScroll: 1,
				prevArrow: $prevArrow.length ? $prevArrow : undefined,
				nextArrow: $nextArrow.length ? $nextArrow : undefined,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: true,
						}
					},
					{
						breakpoint: 580,
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
		window.tftBricksHotelLocation = function () {
			initHotelLocation(document);
		};

		return;
	}

	const tftBricksHotelLocationFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-locations-hotel',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initHotelLocation(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksHotelLocation = function () {
		tftBricksHotelLocationFn.run({ forceReinit: true });
	};
})();

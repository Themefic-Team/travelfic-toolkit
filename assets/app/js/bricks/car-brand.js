/**
 * Travelfic Car Brands in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initCarBrands(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		// Car Brands Slider
		$root.find('.tft-brands[class*="tft-brands-slider-selector-"]').each(function () {
			const $slider = $(this);

			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			$slider.slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				dots: false,
				arrows: false,
				centerMode: true,
				focusOnSelect: true,
				infinite: true,
				autoplay: true,
				speed: 900,
				autoplaySpeed: 6000,
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
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							margin: '10px'
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
		window.tftBricksCarBrands = function () {
			initCarBrands(document);
		};

		return;
	}

	const tftBricksCarBrandsFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-car-brands',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initCarBrands(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksCarBrands = function () {
		tftBricksCarBrandsFn.run({ forceReinit: true });
	};
})();

/**
 * Travelfic Popular Tours Carousel in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initPopularTours(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-popular-tour-selector').each(function () {
			const $slider = $(this);

			// Prevent double initialization
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			$slider.slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: true,
				centerMode: true,
				dots: false,
				pauseOnHover: true,
				autoplay: true,
				autoplaySpeed: 7000,
				prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-angle-left' aria-hidden='true'></i></button>",
				nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa-solid fa-angle-right' aria-hidden='true'></i></button>",
				speed: 700,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
						},
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
						},
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
				],
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksPopularTours = function () {
			initPopularTours(document);
		};

		return;
	}

	const tftBricksPopularToursFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-popular-tours',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initPopularTours(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksPopularTours = function () {
		tftBricksPopularToursFn.run({ forceReinit: true });
	};
})();

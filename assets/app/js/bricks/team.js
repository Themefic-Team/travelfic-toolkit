/**
 * Travelfic Team Members Slider in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initTeamSlider(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-team-design__two .tft-team-members').each(function () {
			const $slider = $(this);

			// Read configuration options from data attributes
			const disable = $slider.data('slider-disable') === true || $slider.data('slider-disable') === 'true';
			if (disable) {
				if ($slider.hasClass('slick-initialized')) {
					$slider.slick('unslick');
				}
				return;
			}

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

			// Prevent double initialization
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}

			const $prevArrow = $slider.closest('.tft-team-content').find('.tft-prev-slide');
			const $nextArrow = $slider.closest('.tft-team-content').find('.tft-next-slide');

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
				prevArrow: $prevArrow.length ? $prevArrow : undefined,
				nextArrow: $nextArrow.length ? $nextArrow : undefined,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						}
					},
					{
						breakpoint: 640,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: true,
							adaptiveHeight: false,
						}
					}
				]
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksTeam = function () {
			initTeamSlider(document);
		};

		return;
	}

	const tftBricksTeamFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-team-members',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initTeamSlider(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksTeam = function () {
		tftBricksTeamFn.run({ forceReinit: true });
	};
})();

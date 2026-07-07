/**
 * Travelfic Rooms Carousel in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initRoomsSlider(root) {
		const $ = window.jQuery;

		if (!$ || !$.fn || typeof $.fn.slick !== 'function') {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-room-section .tft-room-slider').each(function () {
			const $slider = $(this);
			const $container = $slider.closest('.tft-room-section');

			const loop = $slider.data('loop') === true || $slider.data('loop') === 'true';
			const autoplay = $slider.data('autoplay') === true || $slider.data('autoplay') === 'true';
			const autoplaySpeed = parseInt($slider.data('autoplay-speed')) || 2000;
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

			const $prevArrow = $container.find('.tft-prev-slide');
			const $nextArrow = $container.find('.tft-next-slide');

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
				cssEase: 'linear',
				prevArrow: $prevArrow.length ? $prevArrow : undefined,
				nextArrow: $nextArrow.length ? $nextArrow : undefined,
				variableWidth: true,
				adaptiveHeight: true,
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
							variableWidth: false,
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksRooms = function () {
			initRoomsSlider(document);
		};

		return;
	}

	const tftBricksRoomsFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-rooms',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initRoomsSlider(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksRooms = function () {
		tftBricksRoomsFn.run({ forceReinit: true });
	};
})();

/**
 * Travelfic Features in Bricks builder and frontend.
 *
 * @since 1.4.2
 */
(function () {
	'use strict';

	function initFeatures(root) {
		const $ = window.jQuery;

		if (!$) {
			return;
		}

		const $root = root ? $(root) : $(document);

		$root.find('.tft-features-design__one').each(function () {
			const $container = $(this);
			const interaction = $container.data('interaction') || 'click';

			// Ensure only the active image is visible on load
			$container.find('.tft-single-feature-image').hide();
			$container.find('.tft-single-feature-image.active').show();

			function showFeatureById(idSelector, $clicked) {
				// activate left items
				$container.find('.tft-features-items-left .tft-single-feature').removeClass('active');
				if ($clicked) {
					$clicked.addClass('active');
				}

				// show corresponding image
				$container.find('.tft-features-items-right .tft-single-feature-image').removeClass('active').hide();
				$container.find('.tft-features-items-right .tft-single-feature-image[data-id="' + idSelector + '"]').addClass('active').show();
			}

			// Clear previous event handlers to avoid multiple bindings
			$container.find('.tft-features-items-left').off('mouseenter click', '.tft-single-feature');

			if (interaction === 'hover') {
				// Hover interaction (mouseenter)
				$container.find('.tft-features-items-left').on('mouseenter', '.tft-single-feature', function() {
					var $this = $(this);
					var id = '#' + $this.attr('id');
					showFeatureById(id, $this);
				});
			} else {
				// Click interaction (default)
				$container.find('.tft-features-items-left').on('click', '.tft-single-feature', function(e) {
					e.preventDefault();
					var $this = $(this);
					var id = '#' + $this.attr('id');
					showFeatureById(id, $this);
				});
			}
		});
	}

	if (typeof BricksFunction === 'undefined') {
		window.tftBricksFeatures = function () {
			initFeatures(document);
		};

		return;
	}

	const tftBricksFeaturesFn = new BricksFunction({
		parentNode: document,
		selector: '.brxe-tft-features',
		windowVariableCheck: ['jQuery'],
		eachElement: (root) => {
			initFeatures(root);
		},
		listenerHandler() {
			this.run({ forceReinit: true });
		},
	});

	window.tftBricksFeatures = function () {
		tftBricksFeaturesFn.run({ forceReinit: true });
	};
})();

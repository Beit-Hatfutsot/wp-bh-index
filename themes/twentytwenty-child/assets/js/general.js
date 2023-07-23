var $ = jQuery,
	bh_idx_general = (function() {

		var self = {};

		/**
		 * params
		 */
		self.params = {

			// api
			api : js_globals.template_url + '/api/',

			// general
			duration : 400

		};

		/**
		 * init
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.init = function() {

			// toggle sections
			toggleSections();

			// toggle display mode
			$('#display-mode-select').on('change', toggleDisplayMode);

		};

		/**
		 * toggleSections
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var toggleSections = function() {

			// vars
			var sections = $('.toggle-section');

			if ( sections.length ) {
				sections.each(function() {

					// vars
					var section = $(this),
						btn = section.children('h2').children('span'),
						content = section.children('.toggle-content');

					btn.click(function() {
						btn.toggleClass('close open');
						content.toggleClass('close open');
					});

				});
			}

		};

		/**
		 * toggleDisplayMode
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var toggleDisplayMode = function() {

			$.ajax({

				url		: self.params.api + 'display-mode.php',
				type	: 'POST',
				data	: {
					mode	: this.value
				},
				error: function() {
					return false;
				},
				success: function(result) {
					var r = JSON.parse(result);
					if (r.status == 0) {
						location.reload();
						return true;
					}

					return false;
				}

			});

		};

		/**
		 * loaded
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		self.loaded = function() {};

		/**
		 * alignment
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var alignments = function() {};

		// return
		return self;

	}

());

bh_idx_general.init();
$(window).load(bh_idx_general.loaded());
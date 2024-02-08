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
			$('#display-mode-select').on('change', togglePasswordInput);

			// curator display mode
			$('.display-mode-toggle .submit').on('click', toggleDisplayMode, event);

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
						btn = section.children('h3').children('span'),
						content = section.children('.toggle-content');

					btn.click(function() {
						btn.toggleClass('close open');
						content.toggleClass('close open');
					});

				});
			}

		};

		/**
		 * togglePasswordInput
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var togglePasswordInput = function() {

			// vars
			var select			= $('.display-mode-toggle #display-mode-select'),
				mode			= this.value,
				curatorFrame	= $('.display-mode-toggle #curator-mode-pass'),
				input			= $('.display-mode-toggle #display-mode-pass'),
				btn				= $('.display-mode-toggle .submit'),
				notification	= $('.display-mode-toggle .notification');

			notification.hide();

			if ('curator' == mode) {
				curatorFrame.slideDown();
			} else {
				curatorFrame.slideUp();
			}

		};

		/**
		 * toggleDisplayMode
		 *
		 * @since		1.0.0
		 * @param		N/A
		 * @return		N/A
		 */
		var toggleDisplayMode = function(event) {

			event.preventDefault();

			var select			= $('.display-mode-toggle #display-mode-select'),
				mode			= select.find(":selected").val(),
				pass			= $('.display-mode-toggle #display-mode-pass').val(),
				notification	= $('.display-mode-toggle .notification');

			notification.hide();

			$.ajax({

				url		: self.params.api + 'display-mode.php',
				type	: 'POST',
				data	: {
					mode	: mode,
					pass	: pass
				},
				error: function() {
					notification.html('Error!').show();
					return false;
				},
				success: function(result) {
					var r = JSON.parse(result);
					if (r.status == 0) {
						location.reload();
						return true;
					}
					else {
						notification.html('Wrong password...').show();
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
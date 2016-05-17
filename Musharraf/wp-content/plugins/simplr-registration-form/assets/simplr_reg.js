
/*
 * JavaScript for Simplr Registration Form plugin.
 * Will show a modal on post edit screen.
 */

jQuery(document).ready(function($) {

	jQuery('#insert-registration-form').on('click', function(e) {
		e.preventDefault();

		jQuery('#reg-form').remove();

		var data = {
			action:   'simplr_modal_ajax',
			security: simplr.security,
		};

		jQuery.post( simplr.ajaxurl, data, function(response) {

			// Update form verification feedback
			jQuery('body').append(response);
			jQuery('#reg-form').show().after('<div class="media-modal-backdrop"></div>');
		});
	});

});

/**
 * This theme toggle script is added here
 * for reference. The script is in use via
 * the `theme_mode_script` class method.
 *
 * @see /includes/classes/class-template-tags.php
 */
 ( function ($) {

	$(window).load( function() {

		var button = $( '.theme-toggle' );
		var cookie_class = $.cookie( 'fct_theme_mode_class' );
		var cookie_text  = $.cookie( 'fct_theme_mode_text' );
		var cookie_hover = $.cookie( 'fct_theme_mode_hover' );

		if ( ! cookie_class ) {
			$.cookie( 'fct_theme_mode_class', 'light-mode', { path : '/', expires : 7, secure : true } );
			$( 'html, body' ).removeClass( 'dark-mode' ).addClass( 'light-mode' );
		}

		if ( ! cookie_text ) {
			$.cookie( 'fct_theme_mode_text', 'Go Dark', { path : '/', expires : 7, secure : true } );
			$( button ).text( 'Go Dark' );
		}

		if ( ! cookie_hover ) {
			$.cookie( 'fct_theme_mode_hover', 'Switch to dark theme', { path : '/', expires : 7, secure : true } );
			$( button ).attr( 'title', 'Switch to dark theme' );
		}

		if ( cookie_class ) {
			$( 'html, body' ).addClass( cookie_class );
		};

		if ( cookie_text ) {
			$( button ).text( cookie_text );
		};

		// Switch theme and store in local storage.
		$( button ).click( function() {

			if ( $( 'html, body' ).hasClass( 'light-mode' ) ) {

				$.cookie( 'fct_theme_mode_class', 'dark-mode', { path : '/', expires : 7, secure : true } );
				$.cookie( 'fct_theme_mode_text', 'Go Light', { path : '/', expires : 7, secure : true } );
				$.cookie( 'fct_theme_mode_hover', 'Switch to light theme', { path : '/', expires : 7, secure : true } );

				$( 'html, body' ).removeClass( 'light-mode' ).addClass( 'dark-mode' );
				$( button ).text( 'Go Light' );
				$( button ).attr( 'title', 'Switch to light theme' );

			} else {

				$.cookie( 'fct_theme_mode_class', 'light-mode', { path : '/', expires : 7, secure : true } );
				$.cookie( 'fct_theme_mode_text', 'Go Dark', { path : '/', expires : 7, secure : true } );
				$.cookie( 'fct_theme_mode_hover', 'Switch to dark theme', { path : '/', expires : 7, secure : true } );

				$( 'html, body' ).removeClass( 'dark-mode' ).addClass( 'light-mode' );
				$( button ).text( 'Go Dark' );
				$( button ).attr( 'title', 'Switch to dark theme' );
			}
		});
	});
})(jQuery);

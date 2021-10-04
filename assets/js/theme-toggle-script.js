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

		if ( ! cookie_class ) {
			$.cookie( 'fct_theme_mode_class', 'light-mode', { path : '/', expires : 7, secure : true } );
			$( 'html, body' ).removeClass( 'dark-mode' ).addClass( 'light-mode' );
		}

		if ( ! cookie_text ) {
			$.cookie( 'fct_theme_mode_text', 'Dark Theme', { path : '/', expires : 7, secure : true } );
			$( button ).text( 'Dark Theme' );
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
				$.cookie( 'fct_theme_mode_text', 'Light Theme', { path : '/', expires : 7, secure : true } );

				$( 'html, body' ).removeClass( 'light-mode' ).addClass( 'dark-mode' );
				$( button ).text( 'Light Theme' );

			} else {

				$.cookie( 'fct_theme_mode_class', 'light-mode', { path : '/', expires : 7, secure : true } );
				$.cookie( 'fct_theme_mode_text', 'Dark Theme', { path : '/', expires : 7, secure : true } );

				$( 'html, body' ).removeClass( 'dark-mode' ).addClass( 'light-mode' );
				$( button ).text( 'Dark Theme' );
			}
		});
	});
})(jQuery);
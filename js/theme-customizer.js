/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			jQuery( '#site-title a' ).html( newval );
		} );
	} );

	wp.customize( 'solofolio_body_font_size', function( value ) {
		value.bind( function( newval ) {
			jQuery( 'body' ).css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_phone', function( value ) {
		value.bind( function( newval ) {
			jQuery( '.header-phone a' ).html( newval );
		} );
	} );

	wp.customize( 'solofolio_location', function( value ) {
		value.bind( function( newval ) {
			jQuery( '.header-location' ).html( newval );
		} );
	} );

	wp.customize( 'solofolio_email', function( value ) {
		value.bind( function( newval ) {
			jQuery( '.header-email a' ).html( newval );
		} );
	} );

	wp.customize( 'solofolio_body_font_size', function( value ) {
		value.bind( function( newval ) {
			jQuery('body').css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_logo_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.site-title a').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_body_font_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('body').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_body_link_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.wrapper a').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_navigation_font_size', function( value ) {
		value.bind( function( newval ) {
			jQuery('.header-content ul a').css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_header_meta_font_size', function( value ) {
		value.bind( function( newval ) {
			jQuery('.header-meta div').css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_navigation_link_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.header-content ul a').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_navigation_header_font_size', function( value ) {
		value.bind( function( newval ) {
			jQuery('.header-content h3').css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_navigation_header_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.header-content h3').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_blog_entry_title_size', function( value ) {
		value.bind( function( newval ) {
			jQuery('h2.post-title').css('font-size', newval );
		} );
	} );

	wp.customize( 'solofolio_blog_entry_title_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('h2.post-title a').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_blog_entry_byline_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.date').css('color', newval );
		} );
	} );

	wp.customize( 'solofolio_body_caption_color', function( value ) {
		value.bind( function( newval ) {
			jQuery('.solofolio-cyclereact-caption').css('color', newval );
			jQuery('.wp-caption .wp-caption-text').css('color', newval );
		} );
	} );

} )( jQuery );

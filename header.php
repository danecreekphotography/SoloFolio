<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<?php if (get_theme_mod( 'solofolio_favicon' ) != '') { ?>
		<link rel="icon" type="image/png" href="<?php echo get_theme_mod( 'solofolio_favicon' ); ?>"/>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
	<?php if (get_theme_mod( 'solofolio_css' ) != '') { ?>
	<style type="text/css">
		<?php echo get_theme_mod( 'solofolio_css' ) ?>
	</style>
	<?php } ?>
</head>
<body <?php body_class(get_theme_mod('solofolio_layout_mode')); ?>>
<div class="header pushy pushy-left">
	<div class="header-inner">
		<a class='menu-icon'><i class="fa fa-bars"></i></a>
		<?php if (get_theme_mod( 'solofolio_logo' ) != '') { ?>
			<div class="logo logo-img">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					 rel="home">
					 <img src="<?php echo get_theme_mod( 'solofolio_logo' ); ?>"
					 			alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				</a>
			</div>
		<?php } else { ?>
			<div class="logo logo-text">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						 rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</div>
		<?php } ?>
		<div class="header-meta">
			<?php if (get_theme_mod( 'solofolio_subheading' ) != '') { ?>
				<div class="header-subheading">
					<?php echo get_theme_mod( 'solofolio_subheading', 'John Doe' ); ?>
				</div>
			<?php } if (get_theme_mod( 'solofolio_phone' ) != '') { ?>
				<div class="header-phone">
					<a href="tel:<?php echo get_theme_mod( 'solofolio_phone' ); ?>"><?php echo get_theme_mod( 'solofolio_phone', '555-555-5555' ); ?></a>
				</div>
			<?php } if (get_theme_mod( 'solofolio_email' ) != '') { ?>
				<div class="header-email">
					<a href="mailto:<?php echo get_theme_mod( 'solofolio_email' ); ?>">
						<?php echo get_theme_mod( 'solofolio_email', 'john@johndoe.com' ); ?>
					</a>
				</div>
			<?php } if (get_theme_mod( 'solofolio_location' ) != '') { ?>
				<div class="header-location">
					<?php echo get_theme_mod( 'solofolio_location', 'Athens, Ohio' ); ?>
				</div>
			<?php } ?>
		</div>
		<div class="header-content">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Navigation") ) { ?>
				To add a menu to SoloFolio, create one in Appearance > Widgets.
			<?php } if (is_home() || is_single() || is_archive()) {
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Under Main Navigation on Blog") ) {} } ?>
		</div>
	</div>
</div>
<div class="site-overlay"></div>
<a class='menu-btn'><i class="fa fa-bars"></i> menu</a>
<div class="wrapper">

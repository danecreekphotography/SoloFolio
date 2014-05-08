<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--
  _____  ____  _      ____  ______ ____  _      _____ ____
 / ____|/ __ \| |    / __ \|  ____/ __ \| |    |_   _/ __ \
| (___ | |  | | |   | |  | | |__ | |  | | |      | || |  | |
 \___ \| |  | | |   | |  | |  __|| |  | | |      | || |  | |
 ____) | |__| | |___| |__| | |   | |__| | |____ _| || |__| |
|_____/ \____/|______\____/|_|    \____/|______|_____\____/
SoloFolio v6.20140330 - github.com/joelhawksley/SoloFolio
-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimal-ui" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,700italic' rel='stylesheet' type='text/css'>

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

	<?php wp_head(); ?>

	<?php if (get_theme_mod( 'solofolio_css' ) != '') { ?>
	<style type="text/css">
		<?php echo get_theme_mod( 'solofolio_css' ) ?>
	</style>
	<?php } ?>
</head>

<body <?php body_class(); ?> id="<?php echo get_post_type( $post ); ?>">

<div id="outerWrap">

<a id='menu-icon'><i class="fa fa-bars"></i></a>

<div id="header">

	<div id="header-inner">

		<div id="logo">
			<?php if (get_theme_mod( 'solofolio_logo' ) != '') { ?>
				<div id="logo-img">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						 rel="home">
						 <img src="<?php echo get_theme_mod( 'solofolio_logo' ); ?>"
						 			alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					</a>
				</div>
			<?php } else { ?>
				<div id="logo-noimg">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
							 rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				</div>
			<?php } ?>
		</div>

		<div id="header-meta">
			<div id="header-phone">
				<a href="tel:<?php echo get_theme_mod( 'solofolio_phone' ); ?>">
					<?php echo get_theme_mod( 'solofolio_phone', '555-555-5555' ); ?>
				</a>
			</div>
			<div id="header-email">
				<a href="mailto:<?php echo get_theme_mod( 'solofolio_email' ); ?>">
					<?php echo get_theme_mod( 'solofolio_email', 'john@johndoe.com' ); ?>
				</a>
			</div>
			<div id="header-location">
				<?php echo get_theme_mod( 'solofolio_location', 'Athens, Ohio' ); ?>
			</div>
		</div>

		<div class="clear"></div>

		<div id="header-content">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Navigation") ) : ?>
				Your site does not have any menus! Add one using the Custom Menu widget in Appearance > Widgets.
			<?php endif; ?>

			<?php if (is_home()){ ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Under Main Navigation on Blog") ) : ?>
				<?php endif; ?>
			<?php } ?>

			<?php if (is_single()){ ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Under Main Navigation on Blog") ) : ?>
				<?php endif; ?>
			<?php } ?>

			<?php if (is_archive()){ ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Under Main Navigation on Blog") ) : ?>
				<?php endif; ?>
			<?php } ?>

			<div id="sidebar-footer">
				<p id="info-footer">&copy; <?php echo date("Y"); ?> <?php echo get_theme_mod( 'solofolio_copyright_text' ); ?></p>
				<p id="solo-footer">Powered by <a title="The premier free WordPress theme for the creatively inclined." href="http://solofol.io">SoloFolio</a></p>
			</div>
		</div>

		<div class="clear"></div>
	</div>
</div>

<div id="wrapper">

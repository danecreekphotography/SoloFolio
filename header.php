<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--
  _____  ____  _      ____  ______ ____  _      _____ ____
 / ____|/ __ \| |    / __ \|  ____/ __ \| |    |_   _/ __ \
| (___ | |  | | |   | |  | | |__ | |  | | |      | || |  | |
 \___ \| |  | | |   | |  | |  __|| |  | | |      | || |  | |
 ____) | |__| | |___| |__| | |   | |__| | |____ _| || |__| |
|_____/ \____/|______\____/|_|    \____/|______|_____\____/
SoloFolio v6.20140216 - github.com/joelhawksley/SoloFolio
-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimal-ui" />
	<meta content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
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

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.retina.min.js"></script>
	<script type="text/javascript">$(window).load(function(){$("p:has(img)").css("margin","0");$("p:has(img)").css("padding","0");$("img").each(function(){var e=$(this);var t=new Image;t.src=e.attr("src");var n=t.width;var r=t.height;if(t.width>0){$(this).attr("style","max-width:"+n+"px")}});$("img").each(function(){$(this).removeAttr("width");$(this).removeAttr("height")});$("img").retina();$("#menu-icon").click(function(){$("#header-content").slideToggle();$(this).toggleClass("active")})})</script>
</head>

<body <?php body_class(); ?> id="<?php echo get_post_type( $post ); ?>">

<div id="outerWrap">

<div id="header">

	<div id="header-inner">
		<a id='menu-icon'><i class="fa fa-bars"></i></a>

		<div id="logo">
			<div id="logo-img">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					 rel="home">
					 <img src="<?php echo get_theme_mod( 'solofolio_logo' ); ?>"
					 			alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					 			data-retina="<?php echo get_theme_mod( 'solofolio_logo_retina' ); ?>" />
				</a>
			</div>

			<div id="logo-noimg">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
						 rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</div>

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
		</div>

		<div id="sidebar-footer">
			<p id="info-footer"><?php echo get_theme_mod( 'solofolio_footer_text' ); ?></p>
			<p id="solo-footer">Powered by <a title="The premier free WordPress theme for the creatively inclined." href="http://www.solofolio.net">SoloFolio</a></p>
		</div>

		<div class="clear"></div>
	</div>
</div>

<div id="wrapper">

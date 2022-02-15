<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<?php if ( get_field('td_theme_colour','options') ) : ?>
	<meta name="theme-color" content="<?php echo get_field('td_theme_colour','options'); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class('background-grey'); ?>>

	<div class="header">
		<div class="mobileMenu">
			<div class="hamburger js-nav-toggle">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hamburger.svg">
			</div>
		</div>
		<div class="wrap">
			<div class="header--menu mainMenu desktopMenu">
				<?php $args = array(
				'container'       => false,
				'echo'            => false,
				'items_wrap'      => '%3$s',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'depth'           => 0,
				'theme_location' => 'menu-header',
			); ?>
				<?php $menu = wp_nav_menu( $args ); ?>
				<?php $menu = str_replace( '<li', '<div', $menu); ?>
				<?php $menu = str_replace( 'li>', 'div>', $menu); ?>
				<?php echo $menu; ?>
			</div>
		</div>
		<?php if ( !is_cart() ) { ?>
		<a href="<?php echo wc_get_cart_url() ?>"> 
			<div class="cartButton">
				<?php $cartCount = WC()->cart->get_cart_contents_count(); ?>
				<?php if ($cartCount >= 1) { ?>
					<div class="cartCount small">
						<?php echo $cartCount ?>
					</div>
				<?php } ?>
				<i class="fal fa-shopping-cart"></i>
			</div>
		</a>
		<?php } ?>
	</div>

	<?php get_template_part('inc/hero'); ?>
<div class="offscreen">
	<div class="mobileMenuHeader">
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
		<div class="hamburger js-nav-toggle">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hamburger-cross.svg">
		</div>
		<?php if ( get_field('td_mobile_menu_logo','options') ) : $image = get_field('td_mobile_menu_logo','options'); ?>
		<div class="offscreen__logo">
			<img src="<?php echo $image['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
		</div>
		<?php endif; ?>
	</div>


	<div class="offscreen__body text-center">
		<div class="offscreen__nav">
			<?php $args = array(
					'container'      => 'false',
					'menu_class'     => 'nav--mobile',
					'theme_location' => 'mobile-menu'
				); ?>
			<?php wp_nav_menu( $args ); ?>
		</div>
	</div>

	<?php if ( have_rows( 'td_social_media', 'options' ) ) : ?>
	<div class="menuSocial m-t-l phone-m-t-xl m-b-xxl ">

		<?php while ( have_rows( 'td_social_media', 'options' ) ) :
				the_row(); ?>

		<?php $url = get_sub_field( 'url', 'options' )  ?>

		<?php if ( $icon = get_sub_field( 'icon', 'options' ) ) : ?>
		<?php if ($url != '') { ?>
		<a href="<?php echo $url; ?>" target="_blank">
			<?php } ?>
			<i class="<?php echo $icon; ?>"></i>
			<?php if ($url != '') { ?>
		</a>
		<?php } ?>
		<?php endif; ?>


		<?php endwhile; ?>
	</div>
	<?php endif; ?>

</div>
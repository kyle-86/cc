<?php if (is_front_page()) { ?>

<?php if ( have_rows( 'homepage_hero' ) ) : ?>
<?php while ( have_rows( 'homepage_hero' ) ) :
			the_row(); ?>

<?php
	$background_color = get_sub_field( 'background_color' );
	$background_text = get_sub_field( 'background_text' );
?>

<div class="hero hero--home" style="background:<?php echo $background_color; ?>">
	<span class="heroShape shape1 topLeft"></span>
	<span class="heroShape shape2 topRight"></span>
	<span class="heroShape shape3 bottomLeft"></span>
	<span class="heroShape shape4 bottomRight"></span>

	<?php include TEMPLATEPATH . '/layout/name-repeater.php'; ?>

	<?php
	$charlie_image = get_sub_field( 'charlie_image' );
	if ( $charlie_image ) : ?>
	<div class="heroImage hidden-phone">
		<img src="<?php echo esc_url( $charlie_image['url'] ); ?>"
			alt="<?php echo esc_attr( $charlie_image['alt'] ); ?>" />
	</div>
	<?php endif; ?>

	<?php
	$charlie_mobile_image = get_sub_field( 'charlie_mobile_image' );
	if ( $charlie_mobile_image ) : ?>
	<div class="heroImage heroImgPhone hidden show-phone">
		<img src="<?php echo esc_url( $charlie_mobile_image['url'] ); ?>"
			alt="<?php echo esc_attr( $charlie_mobile_image['alt'] ); ?>" />
	</div>
	<?php endif; ?>

</div>

<?php endwhile; ?>
<?php endif; ?>

<?php } else { ?>

<?php if ( have_rows( 'inner_page_hero' ) ) : ?>

<?php $themeColor = get_field( 'page_colour' ); ?>

<?php while ( have_rows( 'inner_page_hero' ) ) :
		the_row(); ?>
<?php $text = get_sub_field( 'text' ) ?>
<?php if ($text) { ?>
<div class="hero innerHero m-b-xxl theme-<?php echo $themeColor; ?>">
	<div class="wrap">

		<div class="custom-grid no-margin centerContent">
			<div class="grid-10 grid-phone-12">

				<div class="custom-grid no-margin centerContent">

					<div class="grid-5 grid-1000-12 topZ">

						<div class="hero-textImage">
							<?php if ( $text ) : ?>
							<div class="heroText">
								<h1><?php echo $text; ?></h1>
							</div>
							<?php endif; ?>

						</div>
					</div>
					<div class="grid-6 floatPosition topZ grid-md-5">
						<?php
					$left_image = get_sub_field( 'left_image' );
					if ( $left_image ) : ?>
						<div class="heroLeftImage">
							<img src="<?php echo esc_url( $left_image['url'] ); ?>"
								alt="<?php echo esc_attr( $left_image['alt'] ); ?>" />
							<div class="shape bottomLeft hidden-tablet topZ">
								<?php if ($themeColor == 'yellow') { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomLeftYellow.svg">
								<?php } else { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomLeft.svg">
								<?php } ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
					<div class="grid-7 no-padding-right grid-1000-12">
						<div class="heroRightImage">
							<div class="shape topLeft">
								<?php if ($themeColor == 'yellow') { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/topLeftBlue.svg">
								<?php } else { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/topLeft.svg">
								<?php } ?>
							</div>
							<div class="shape topRight">
								<?php if ($themeColor == 'green') { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/topRightRed.svg">
								<?php } else { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/topRight.svg">
								<?php } ?>
							</div>

							<div class="shape bottomLeft show-tablet hidden">
								<?php if ($themeColor == 'yellow' || $themeColor == 'blue') { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomLeft.svg">
								<?php } else { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomLeftYellow.svg">
								<?php } ?>
							</div>

							<div class="shape bottomRight">
								<?php if ($themeColor == 'green') { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomRightGreen.svg">
								<?php } else { ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero/bottomRight.svg">
								<?php } ?>
							</div>

							<?php
							$right_image = get_sub_field( 'right_image' );
							if ( $right_image ) : ?>
							<img src="<?php echo esc_url( $right_image['url'] ); ?>"
								alt="<?php echo esc_attr( $right_image['alt'] ); ?>" />
							<?php endif; ?>

						</div>
					</div>

				</div>
				<?php if ( get_sub_field( 'show_name_repeater' ) ) : ?>
				
					<?php include TEMPLATEPATH . '/layout/name-repeater-inner.php'; ?>

				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
<?php } ?>
<?php endwhile; ?>
<?php endif; ?>

<?php } ?>


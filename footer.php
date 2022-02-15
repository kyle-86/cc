<div class="footer m-t-xxl" data-aos="fade-up">
	<div class="wrap p-t-xxl">

		<div class="footerLogo text-center">
			<?php
			$td_footer_logo = get_field( 'td_footer_logo', 'options' );
			if ( $td_footer_logo ) : ?>
			<img src="<?php echo esc_url( $td_footer_logo['url'] ); ?>"
				alt="<?php echo esc_attr( $td_footer_logo['alt'] ); ?>" />
			<?php endif; ?>
		</div>

		<?php if ( have_rows( 'td_social_media', 'options' ) ) : ?>
		<div class="footerSocials m-t-l phone-m-t-xl m-b-xxl ">

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


		<div class="footer__copyright small tablet-text-center">
			<div class="custom-grid">
				<div class="grid-6 grid-tablet-12">
					Copyright <?php echo date('Y');?> &copy;
					<?php echo (get_field('td_business_name','options')) ? get_field('td_business_name','options') : get_bloginfo('name'); ?>.
					All Rights Reserved. <span class="thirteen_copy">A <a href="https://www.thirteendigital.com.au"> Thirteen Digital </a> site.</span>
				</div>
				<div class="grid-6 grid-tablet-12 text-right tablet-text-center">
					<div class="footerMenu">
						<?php 
							wp_nav_menu( array(
								'theme_location' => 'menu-footer'
							) );
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="footerRound"></div>

	</div><!-- /wrap -->
</div><!-- /footer -->

<?php get_template_part('inc/offscreen'); ?>

<?php wp_footer(); ?>

</body>

</html>
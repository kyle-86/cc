<div class="custom-grid no-margin centerContent"  data-aos="<?php echo getRandomAnimation(); ?>">
	<div class="grid-8 grid-md-12">

		<?php if ( $form = get_sub_field( 'form' ) ) : ?>
		<div class="grid-12 no-padding">
			<?php gravity_form($form['id'], false, true, false, '', true, 1); ?>
		</div>
		<?php endif; ?>

	</div>
</div>
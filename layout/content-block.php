<?php if ( get_sub_field('content') ) : ?>
<div class="wrap p-t-xxl">
	<div class="custom-grid">
		<div class="grid-10">
			<div class="full-width" data-aos="<?php echo getRandomAnimation(); ?>">
				<div class="wysiwyg">
					<?php echo get_sub_field('content'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
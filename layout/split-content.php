<div class="splitContent"  data-aos="<?php echo getRandomAnimation(); ?>">
	<div class="custom-grid no-margin">

	<?php $imageSide = get_sub_field( 'image_side' ) ?>

		<?php if ( $imageSide == 'right' ) { ?>
		<?php $imagePos = 'order-2' ?>
		<?php } ?>

		<?php $content_background_colour = get_sub_field( 'content_background_colour' ); ?>


		<div class="grid-6 grid-tablet-12 no-padding <?php echo $imagePos; ?> order-tablet-2">
			<div class="splitContentImage">
				<?php
			$image = get_sub_field( 'image' );
			if ( $image ) : ?>
				<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
				<?php endif; ?>
			</div>
		</div>
		<div class="grid-6 grid-tablet-12 no-padding splitContentText bg--<?php echo $content_background_colour; ?>">
			<div class="contentTextArea image<?php echo $imageSide; ?>">
				<div class="content__<?php echo $imageSide; ?>">
				<?php if ( $title = get_sub_field( 'title' ) ) : ?>
				<h2 class="light"><?php echo $title; ?></h2>
				<?php endif; ?>


				<?php if ( $content = get_sub_field( 'content' ) ) : ?>
				<div class="contentTextContent">
					<?php echo $content; ?>
				</div>
				<?php endif; ?>


				<?php
					$link = get_sub_field( 'link' );
					if ( $link ) :
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
				<div class="contentLink m-t-m">
					<a href="<?php echo esc_url( $link_url ); ?>" class="h6 underline semi"
						target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
				<?php endif; ?>

				</div>
			</div>
		</div>

	</div>
</div>
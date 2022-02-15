<?php $background_colour = get_sub_field('background_colour'); ?>
<?php $pagination = get_sub_field( 'show_pagination' ); ?>

<div
	class="featuredProducts <?php if (!$pagination) { ?>p-b-xxxxl phone-p-b-xxl p-t-xxl<?php } ?>"  data-aos="<?php echo getRandomAnimation(); ?>">

	<?php $animation = get_sub_field( 'background_animation'); ?>
	<?php if ( $animation[0] == 'yes' ) : ?>
    <?php include ('shapeAnimation.php') ?>
    <?php endif; ?>

	<div class="wrap">
		<div class="custom-grid centerContent no-overflow no-margin">
			<div class="grid-10 grid-phone-12 no-padding">

				<?php $title = get_sub_field('title'); ?>
				<?php 
				$number_of_products_to_show = ( get_sub_field('number_of_products_to_show') != '' ? get_sub_field('number_of_products_to_show') : '3');
				?>
				<?php 
				$product_sort = ( get_sub_field('product_sort') != '' ? get_sub_field('product_sort') : 'rand');

				if ($product_sort == 'title') {
					$product_order = 'asc';
				}	
				if ($product_sort == 'ID') {
					$product_order = 'desc';
				}
			?>

				<?php if ($title) { ?>
				<div class="featuredTitle text-center m-b-xl">
					<h2> <?php echo $title; ?> </h2>
				</div>
				<?php } ?>

				<div class="custom-grid product-grid no-margin no-overflow centerContent <?php if (!$pagination) { ?> featuredSlick <?php } ?>">

					<?php  
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $number_of_products_to_show,
					'orderby'=> $product_sort,
					'order' => $product_order
				);

					$loop = new WP_Query( $args );

					while ( $loop->have_posts() ) : $loop->the_post();
					
						global $product; ?>

						<?php if ($pagination) { ?>
							<div class="grid-4 no-padding m-b-m">
						<?php } ?>
						<div class="productFrame">

							<div class="productImage">
								<a href="<?php echo get_permalink() ?>">
									<img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
								</a>
							</div>
							<div class="productDetails m-b-none h6 semi">
								<div class="productTitle js-match-height">
									<?php echo get_the_title() ?>
								</div>
								<div class="productPrice">
									<?php 

										if ($product->is_type( 'simple' )) {
											$salePrice     =  $product->get_sale_price();
											$regPrice  =  $product->get_regular_price();
										}
										elseif($product->is_type('variable')){
											$salePrice     =  $product->get_variation_sale_price( 'min', true );
											$regPrice  =  $product->get_variation_regular_price( 'max', true );
										}
									
									?>

									<?php if($product->is_type('variable')){ ?>

									<span class="salePrice">
										<?php echo '$' . number_format($salePrice, 2, '.', ''); ?>
										<?php if ( $salePrice != $regPrice ) { ?>
										-
										<?php echo '$' . number_format($regPrice, 2, '.', ''); ?>
										<?php } ?>
									</span>

									<?php } else { ?>

									<span
										class="fullPrice <?php if ($salePrice) { echo 'hasSale'; } ?>"><?php echo '$' . number_format($regPrice, 2, '.', ''); ?></span>

									<?php if ($salePrice) { ?>
									<span class="salePrice">
										<?php echo '$' . number_format($salePrice, 2, '.', ''); ?>
									</span>
									<?php } ?>

									<?php } ?>


								</div>
								<div class="productButton">
									<a href="<?php echo get_permalink() ?>" class="h6 semi"> Buy Now </a>
								</div>
							</div>
						</div>

						<?php if ($pagination) { ?>
							</div>
						<?php } ?>

					<?php endwhile;

					if ($pagination) { ?>
					<div class="productPagination m-t-xxl h6">
						<?php echo do_shortcode( '[facetwp facet="pagination"]'); ?>
					</div>
					<?php }

					wp_reset_query();
				?>

				</div>
			</div>

		</div>
	</div>

</div>
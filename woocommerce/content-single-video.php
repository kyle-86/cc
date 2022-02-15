<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'video_product', $product ); ?> data-aos="<?php echo getRandomAnimation(); ?>">
	<div class="wrap">

		<?php $productID = $product->get_id(); ?>

		<div class="custom-grid centerContent">
			<div class="grid-6 grid-md-12">
				<?php 
					/**
					 * Hook: woocommerce_before_single_product.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 */
					do_action( 'woocommerce_before_single_product' );
				?>
			</div>
		</div>
		<div class="custom-grid centerContent">
			<div class="grid-10">
				<?php 
					/**
					 * Hook: woocommerce_before_single_product.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 */
					do_action( 'woocommerce_before_single_product' );
				?>
			</div>
			<div class="grid-8 grid-tablet-12">
				<div class="summary entry-summary">

					<div class="custom-grid centerContent">
						<div class="grid-10">
							<div class="video-details text-center">

								<?php if ( $title = get_field( 'title' ) ) : ?>
								<h2> <?php echo $title; ?> </h2>
								<?php endif; ?>

								<?php if ( $description = get_field( 'description' ) ) : ?>
								<div class="wysiwyg m-b-xxl">
									<?php echo $description; ?>
								</div>
								<?php endif; ?>

							</div>
						</div>
					</div>



					<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
				</div>

				<div class="productDiscalimer text-center m-t-l">

					<div class="custom-grid centerContent">
						<div class="grid-10">

							<?php if ( $disclaimer = get_field( 'disclaimer' ) ) : ?>
							<?php echo $disclaimer; ?>
							<?php endif; ?>

						</div>
					</div>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>

				</div>
			</div>
		</div>

	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
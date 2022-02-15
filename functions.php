<?php
// Admin Functions
	// Load /functions/ folder
		include('functions/loader.php');
	// Add title tag support
		add_theme_support( 'title-tag' );
	// Add support for custom styles in WordPress editor
		add_editor_style('/css/admin/editor-style.css');
	// Add default content width
		if ( ! !empty( $content_width ) ) $content_width = 1200;
	// Add support for WordPress custom menus
		add_action( 'init', 'register_my_menu' );
	// Register areas for custom menus
		function register_my_menu() {
			register_nav_menu( 'menu-header', __( 'Header Menu' ) );
			register_nav_menu( 'menu-footer', __( 'Footer Menu' ) );
			register_nav_menu( 'mobile-menu', __( 'Mobile Menu' ) );
		}
	// Enable post thumbnails
		add_theme_support('post-thumbnails');
	// Remove inline gallery styling
		add_filter( 'use_default_gallery_style', '__return_false' );
	// Remove inline caption style
		add_filter( 'img_caption_shortcode_width', '__return_false' );
// Scripts
	// Load custom javascript files
		add_action( 'wp_enqueue_scripts', 'td_load_javascript_files' );
		function td_load_javascript_files() {
			$rand = rand( 1, 9999 );
			wp_register_script( 'theme-vendor', get_template_directory_uri() . '/js/min/vendor.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-vendor' );
			wp_register_script( 'theme-functions', get_template_directory_uri() . '/js/min/custom.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-functions' );
		}
// Styles
	// Load Stylesheet
		function td_load_styles () {
			$rand = rand( 1, 9999 );
			wp_enqueue_style( 'td-style', get_stylesheet_uri(), '', $rand );

			wp_register_style( 'typekit', 'https://use.typekit.net/xpk1vtr.css');
       		wp_enqueue_style( 'typekit' ); 
		}
		add_action( 'wp_enqueue_scripts', 'td_load_styles' );
	// Gutenberg CSS removal
	function wps_deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
// Miscellaneous
	// Remove related YouTube videos
		add_filter('oembed_dataparse','td_strip_related_videos', 10, 3);
		function td_strip_related_videos($return, $data, $url) {
			if ($data->provider_name == 'YouTube') {
				$data->html = str_replace('feature=oembed', 'feature=oembed&#038;rel=0&#038;showinfo=0', $data->html);
				return $data->html;
			} else return $return;
		}
		function td_custom_youtube_settings($code){
			if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
				$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1", $code);
				return $return;
			}
			return $code;
		}
		add_filter('embed_handler_html', 'td_custom_youtube_settings');
		add_filter('embed_oembed_html', 'td_custom_youtube_settings');
	// Conditional statement for blog pages
		function is_blog_page(){
			global $wp_query;
			if (is_home() || is_category() || is_tag() || is_singular('post')) return true;
			return false;
		}
	// Custom body class
		add_filter( 'body_class', 'td_body_class' );
		function td_body_class( $classes ) {
			if (is_blog_page())
			$classes[] = 'page--blog';
			if (!is_front_page())
			$classes[] = 'not-home';
			return $classes;
		}
	// Apple Icons
		add_action('wp_head', 'td_favicon_header');
		function td_favicon_header() {
			?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/favicon.png" sizes="32x32" type="image/x-icon" />			
			<link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon_largetile.png">
			<?php
		}
// Add Current Class When On Single
	function td_menu_item_classes( $classes, $item, $args ) {
		$posts_page = get_option('page_for_posts');
		if( ( is_singular( 'post' ) || is_category() || is_tag() ) && $posts_page == $item->object_id )
		    $classes[] = 'current-menu-item';
		return array_unique( $classes );
	}
	add_filter( 'nav_menu_css_class', 'td_menu_item_classes', 10, 3 );
// Display Hamburger
	function td_display_hamburger() {
		echo '
		<div class="hamburger js-nav-toggle">
			<div class="hamburger__line hamburger__line--top"></div>
			<div class="hamburger__line hamburger__line--middle"></div>
			<div class="hamburger__line hamburger__line--bottom"></div>
		</div>';
	}
// WooCommerce
	add_theme_support( 'woocommerce' );
// Disable WooCommerce styles
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

	//Stop all themes from updating.
	add_filter( 'site_transient_update_themes', 'remove_update_themes' );
	function remove_update_themes( $value ) {
	    return null;
	}

	add_filter( 'nav_menu_css_class', function( $classes, $item )
{
    return array_filter( $classes, function( $val ) use ( $item )
    {
        return ! in_array( $val, (array) $item->wpse_classes ) ;
    } );
}, 10, 2 );

add_filter( 'wp_get_nav_menu_items',  function( $items, $menu, $args )
{
    foreach( $items as $item )
        $item->wpse_classes = $item->classes;

    return $items;
}, 10, 3 );

/**
 * Add all classess that aren't prefixed with "a-class-" to the <a> tag
 */
add_filter( 'nav_menu_link_attributes', function( $atts, $item )
{
	// echo '<pre>';
	// var_dump($item);
	// echo '</pre>';

    if( isset( $item->wpse_classes ) )
    {
        $atts['class'] = join( 
            ' ', 
            array_filter(
                $item->wpse_classes, 
                function( $val )
                {
                    return 'li-class-' !== substr( $val, 0, strlen( 'li-class-' ) );
                } 
            ) 
        );
    }

	$pageID = $item->object_id;
	$pageColor = get_field( "page_colour", $pageID );
	
	if ($pageColor) {
		$atts['class'] = $atts['class'] . ' pageColor-' . $pageColor;
	}

    return $atts;
}, 10, 2 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 0); 
remove_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 10, 0); 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0);

add_filter('woocommerce_reset_variations_link', '__return_empty_string');
add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 5, 0);

add_filter( 'wc_get_template_part', 'so_25789472_get_template_part', 10, 3 );

/**
 * Change wc template part for product with a specific category
 *
 * @param  string $templates
 * @param  string $slug
 * @param  string $name
 * @return string
 */
function so_25789472_get_template_part( $template, $slug, $name ) {
	if ( $slug == 'content' && $name = 'single-product' && has_term( 'Video', 'product_cat' ) ) {
    $template = locate_template( array( WC()->template_path() . 'content-single-video.php' ) );
  } 
  return $template;
}

function getRandomAnimation() {
	$animations = array("fade-up", "fade-up", "fade-down", "fade-right", "fade-up-right" , "fade-up-left", "fade-down-right", "fade-down-left", "flip-left", "flip-right", "flip-up", "flip-down", "zoom-in", "zoom-in-up", "zoom-in-down", "zoom-in-left", "zoom-in-right", "zoom-out", "zoom-out-up", "zoom-out-down", "zoom-out-right", "zoom-out-left");
	return $rand_keys = $animations[array_rand($animations, 1)];;
}

remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );
add_action( 'woocommerce_cart_is_empty', 'custom_empty_cart_message', 10 );

function custom_empty_cart_message() {
    $html  = '<div class="cart-empty p-t-xxl p-b-xxl">';
    $html .= wp_kses_post( apply_filters( 'wc_empty_cart_message', __( '<h1><strong>Your</strong> basket <strong>is</strong> empty</h1>', 'woocommerce' ) ) );
	$html .= '<a class="button">Continue Shopping</a>';
    echo $html . '</div>';
}

?>
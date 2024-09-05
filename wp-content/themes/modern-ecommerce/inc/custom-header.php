<?php
/**
 * Custom header
 */

function modern_ecommerce_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'modern_ecommerce_custom_header_args', array(
		'default-image'          => get_parent_theme_file_uri( '/assets/images/header-img.png' ),
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 100,
		'flex-width'			 => true,
		'flex-height'			 => true,
		'wp-head-callback'       => 'modern_ecommerce_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/header-img.png',
			'thumbnail_url' => '%s/assets/images/header-img.png',
			'description'   => __( 'Default Header Image', 'modern-ecommerce' ),
		),
		'default-image-2' => array(
			'url'           => '%s/assets/images/header-img-2.png',
			'thumbnail_url' => '%s/assets/images/header-img-2.png',
			'description'   => __( 'Default Header Image 2', 'modern-ecommerce' ),
		),
		'default-image-3' => array(
			'url'           => '%s/assets/images/header-img-3.png',
			'thumbnail_url' => '%s/assets/images/header-img-3.png',
			'description'   => __( 'Default Header Image 3', 'modern-ecommerce' ),
		),
	) );
}

add_action( 'after_setup_theme', 'modern_ecommerce_custom_header_setup' );

if ( ! function_exists( 'modern_ecommerce_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see modern_ecommerce_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'modern_ecommerce_header_style' );
function modern_ecommerce_header_style() {
	if ( get_header_image() ) :
	$custom_css = "
        .header-image, .woocommerce-page .single-post-image  {
			background-image:url('".esc_url(get_header_image())."');
			background-position: top;
			background-size:cover!important;
			background-repeat:no-repeat!important;
		}";
	   	wp_add_inline_style( 'modern-ecommerce-style', $custom_css );
	endif;
}
endif;


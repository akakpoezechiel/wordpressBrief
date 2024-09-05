<?php

$modern_ecommerce_custom_style= "";

/*---------------------------Width -------------------*/

$modern_ecommerce_theme_width = get_theme_mod( 'modern_ecommerce_width_options','full_width');

if($modern_ecommerce_theme_width == 'full_width'){

$modern_ecommerce_custom_style .='body{';

	$modern_ecommerce_custom_style .='max-width: 100%;';

$modern_ecommerce_custom_style .='}';

}else if($modern_ecommerce_theme_width == 'container'){

$modern_ecommerce_custom_style .='body{';

	$modern_ecommerce_custom_style .='width: 100%; padding-right: 15px; padding-left: 15px;  margin-right: auto !important; margin-left: auto !important;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='@media screen and (min-width: 601px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 720px;';
    
$modern_ecommerce_custom_style .='} }';

$modern_ecommerce_custom_style .='@media screen and (min-width: 992px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 960px;';
    
$modern_ecommerce_custom_style .='} }';

$modern_ecommerce_custom_style .='@media screen and (min-width: 1200px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 1140px;';
    
$modern_ecommerce_custom_style .='} }';

$modern_ecommerce_custom_style .='@media screen and (min-width: 1400px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 1320px;';
    
$modern_ecommerce_custom_style .='} }';

$modern_ecommerce_custom_style .='@media screen and (max-width:600px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$modern_ecommerce_custom_style .='} }';

}else if($modern_ecommerce_theme_width == 'container_fluid'){

$modern_ecommerce_custom_style .='body{';

	$modern_ecommerce_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='@media screen and (max-width:600px){';

$modern_ecommerce_custom_style .='body{';

    $modern_ecommerce_custom_style .='max-width: 100%; padding-right:0px; padding-left: 0px';
    
$modern_ecommerce_custom_style .='} }';

}

/*---------------------------Scroll-top-position -------------------*/

$modern_ecommerce_scroll_options = get_theme_mod( 'modern_ecommerce_scroll_options','right_align');

if($modern_ecommerce_scroll_options == 'right_align'){

$modern_ecommerce_custom_style .='.scroll-top button{';

	$modern_ecommerce_custom_style .='';

$modern_ecommerce_custom_style .='}';

}else if($modern_ecommerce_scroll_options == 'center_align'){

$modern_ecommerce_custom_style .='.scroll-top button{';

	$modern_ecommerce_custom_style .='z-index: 999; right: 0; left:0; margin: 0 auto; top:85%;';

$modern_ecommerce_custom_style .='}';

}else if($modern_ecommerce_scroll_options == 'left_align'){

$modern_ecommerce_custom_style .='.scroll-top button{';

	$modern_ecommerce_custom_style .='right: auto; left:5%; margin: 0 auto';

$modern_ecommerce_custom_style .='}';
}

/*---------------------------text-transform-------------------*/

$modern_ecommerce_text_transform = get_theme_mod( 'modern_ecommerce_menu_text_transform','CAPITALISE');
if($modern_ecommerce_text_transform == 'CAPITALISE'){

$modern_ecommerce_custom_style .='nav#top_gb_menu ul li a{';

	$modern_ecommerce_custom_style .='text-transform: capitalize ; font-size: 14px;';

$modern_ecommerce_custom_style .='}';

}else if($modern_ecommerce_text_transform == 'UPPERCASE'){

$modern_ecommerce_custom_style .='nav#top_gb_menu ul li a{';

	$modern_ecommerce_custom_style .='text-transform: uppercase ; font-size: 14px;';

$modern_ecommerce_custom_style .='}';

}else if($modern_ecommerce_text_transform == 'LOWERCASE'){

$modern_ecommerce_custom_style .='nav#top_gb_menu ul li a{';

	$modern_ecommerce_custom_style .='text-transform: lowercase ; font-size: 14px;';

$modern_ecommerce_custom_style .='}';
}

/*-------------------------Slider-content-alignment-------------------*/

$modern_ecommerce_slider_content_alignment = get_theme_mod( 'modern_ecommerce_slider_content_alignment','LEFT-ALIGN');

if($modern_ecommerce_slider_content_alignment == 'LEFT-ALIGN'){

$modern_ecommerce_custom_style .='#slider .carousel-caption {';

	$modern_ecommerce_custom_style .='text-align:left; right: 20%; left: 10%;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='@media screen and (max-width:1299px){';

$modern_ecommerce_custom_style .='#slider .carousel-caption{';

    $modern_ecommerce_custom_style .='right: 20%; left: 0;';
    
$modern_ecommerce_custom_style .='} }';


}else if($modern_ecommerce_slider_content_alignment == 'CENTER-ALIGN'){

$modern_ecommerce_custom_style .='#slider .carousel-caption {';

	$modern_ecommerce_custom_style .='text-align:center; right: 20%; left: 0;';

$modern_ecommerce_custom_style .='}';


}else if($modern_ecommerce_slider_content_alignment == 'RIGHT-ALIGN'){

$modern_ecommerce_custom_style .='#slider .carousel-caption {';

	$modern_ecommerce_custom_style .='text-align:right; right: 20%; left: 0;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='@media screen and (max-width:1299px){';

$modern_ecommerce_custom_style .='#slider .carousel-caption{';

    $modern_ecommerce_custom_style .='right: 20%; left: 10%;';
    
$modern_ecommerce_custom_style .='} }';

}

//--------------------sticky header----------------------
if (false === get_option('modern_ecommerce_sticky_header')) {
    add_option('modern_ecommerce_sticky_header', 'off');
}

// Define the custom CSS based on the 'modern_ecommerce_sticky_header' option

if (get_option('modern_ecommerce_sticky_header', 'off') !== 'on') {
    $modern_ecommerce_custom_style .= '.fixed_header.fixed {';
    $modern_ecommerce_custom_style .= 'position: static;';
    $modern_ecommerce_custom_style .= '}';
}

if (get_option('modern_ecommerce_sticky_header', 'off') !== 'off') {
    $modern_ecommerce_custom_style .= '.fixed_header.fixed {';
    $modern_ecommerce_custom_style .= 'position: fixed; background: #fff; box-shadow: 0px 3px 10px 2px #eee;';
    $modern_ecommerce_custom_style .= '}';

    $modern_ecommerce_custom_style .= '.admin-bar .fixed {';
    $modern_ecommerce_custom_style .= ' margin-top: 32px;';
    $modern_ecommerce_custom_style .= '}';
}

//---------------------------------Logo-Max-height--------------------------	
$modern_ecommerce_logo_max_height = get_theme_mod('modern_ecommerce_logo_max_height','100');

if($modern_ecommerce_logo_max_height != false){

$modern_ecommerce_custom_style .='.custom-logo-link img{';

	$modern_ecommerce_custom_style .='max-height: '.esc_html($modern_ecommerce_logo_max_height).'px;';

$modern_ecommerce_custom_style .='}';
}

//related products
if( get_option( 'modern_ecommerce_related_product',true) != 'on') {

$modern_ecommerce_custom_style .='.related.products{';

	$modern_ecommerce_custom_style .='display: none;';
	
$modern_ecommerce_custom_style .='}';
}

if( get_option( 'modern_ecommerce_related_product',true) != 'off') {

$modern_ecommerce_custom_style .='.related.products{';

	$modern_ecommerce_custom_style .='display: block;';
	
$modern_ecommerce_custom_style .='}';
}

// footer text alignment
$modern_ecommerce_footer_content_alignment = get_theme_mod( 'modern_ecommerce_footer_content_alignment','CENTER-ALIGN');

if($modern_ecommerce_footer_content_alignment == 'LEFT-ALIGN'){

$modern_ecommerce_custom_style .='.site-info{';

	$modern_ecommerce_custom_style .='text-align:left; padding-left: 30px;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='.site-info a{';

	$modern_ecommerce_custom_style .='padding-left: 30px;';

$modern_ecommerce_custom_style .='}';


}else if($modern_ecommerce_footer_content_alignment == 'CENTER-ALIGN'){

$modern_ecommerce_custom_style .='.site-info{';

	$modern_ecommerce_custom_style .='text-align:center;';

$modern_ecommerce_custom_style .='}';


}else if($modern_ecommerce_footer_content_alignment == 'RIGHT-ALIGN'){

$modern_ecommerce_custom_style .='.site-info{';

	$modern_ecommerce_custom_style .='text-align:right; padding-right: 30px;';

$modern_ecommerce_custom_style .='}';

$modern_ecommerce_custom_style .='.site-info a{';

	$modern_ecommerce_custom_style .='padding-right: 30px;';

$modern_ecommerce_custom_style .='}';

}

// slider button
$mobile_button_setting = get_option('modern_ecommerce_slider_button_mobile_show_hide', '1');
$main_button_setting = get_option('modern_ecommerce_slider_button_show_hide', '1');

$modern_ecommerce_custom_style .= '#slider .home-btn {';

if ($main_button_setting == 'off') {
    $modern_ecommerce_custom_style .= 'display: none;';
}

$modern_ecommerce_custom_style .= '}';

// Add media query for mobile devices
$modern_ecommerce_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_button_setting == 'off' || $mobile_button_setting == 'off') {
    $modern_ecommerce_custom_style .= '#slider .home-btn { display: none; }';
}
$modern_ecommerce_custom_style .= '}';


// scroll button
$mobile_scroll_setting = get_option('modern_ecommerce_scroll_enable_mobile', '1');
$main_scroll_setting = get_option('modern_ecommerce_scroll_enable', '1');

$modern_ecommerce_custom_style .= '.scrollup {';

if ($main_scroll_setting == 'off') {
    $modern_ecommerce_custom_style .= 'display: none;';
}

$modern_ecommerce_custom_style .= '}';

// Add media query for mobile devices
$modern_ecommerce_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_scroll_setting == 'off' || $mobile_scroll_setting == 'off') {
    $modern_ecommerce_custom_style .= '.scrollup { display: none; }';
}
$modern_ecommerce_custom_style .= '}';

// theme breadcrumb
$mobile_breadcrumb_setting = get_option('modern_ecommerce_enable_breadcrumb_mobile', '1');
$main_breadcrumb_setting = get_option('modern_ecommerce_enable_breadcrumb', '1');

$modern_ecommerce_custom_style .= '.archieve_breadcrumb {';

if ($main_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= 'display: none;';
}

$modern_ecommerce_custom_style .= '}';

// Add media query for mobile devices
$modern_ecommerce_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_breadcrumb_setting == 'off' || $mobile_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= '.archieve_breadcrumb { display: none; }';
}
$modern_ecommerce_custom_style .= '}';

// single post and page breadcrumb
$mobile_single_breadcrumb_setting = get_option('modern_ecommerce_single_enable_breadcrumb_mobile', '1');
$main_single_breadcrumb_setting = get_option('modern_ecommerce_single_enable_breadcrumb', '1');

$modern_ecommerce_custom_style .= '.single_breadcrumb {';

if ($main_single_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= 'display: none;';
}

$modern_ecommerce_custom_style .= '}';

// Add media query for mobile devices
$modern_ecommerce_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_single_breadcrumb_setting == 'off' || $mobile_single_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= '.single_breadcrumb { display: none; }';
}
$modern_ecommerce_custom_style .= '}';

// woocommerce breadcrumb
$mobile_woo_breadcrumb_setting = get_option('modern_ecommerce_woocommerce_enable_breadcrumb_mobile', '1');
$main_woo_breadcrumb_setting = get_option('modern_ecommerce_woocommerce_enable_breadcrumb', '1');

$modern_ecommerce_custom_style .= '.woocommerce-breadcrumb {';

if ($main_woo_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= 'display: none;';
}

$modern_ecommerce_custom_style .= '}';

// Add media query for mobile devices
$modern_ecommerce_custom_style .= '@media screen and (max-width: 600px) {';
if ($main_woo_breadcrumb_setting == 'off' || $mobile_woo_breadcrumb_setting == 'off') {
    $modern_ecommerce_custom_style .= '.woocommerce-breadcrumb { display: none; }';
}
$modern_ecommerce_custom_style .= '}';
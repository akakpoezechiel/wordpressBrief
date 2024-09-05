<?php
/**
 * Modern Ecommerce functions and definitions
 *
 * @subpackage Modern Ecommerce
 * @since 1.0
 */

//woocommerce//
//shop page no of columns
function modern_ecommerce_woocommerce_loop_columns() {
	
	$retrun = get_theme_mod( 'modern_ecommerce_archieve_item_columns', 3 );
    
    return $retrun;
}
add_filter( 'loop_shop_columns', 'modern_ecommerce_woocommerce_loop_columns' );
function modern_ecommerce_woocommerce_products_per_page() {

		$retrun = get_theme_mod( 'modern_ecommerce_archieve_shop_perpage', 6 );
    
    return $retrun;
}
add_filter( 'loop_shop_per_page', 'modern_ecommerce_woocommerce_products_per_page' );
// related products
function modern_ecommerce_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod( 'modern_ecommerce_related_shop_perpage', 3 ),
        'columns'        => get_theme_mod( 'modern_ecommerce_related_item_columns', 3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'modern_ecommerce_related_products_args' );
function modern_ecommerce_related_products_heading($modern_ecommerce_translated_text, $text, $domain) {
    $modern_ecommerce_heading = get_theme_mod('woocommerce_related_products_heading', 'Related products');

    if ($text === 'Related products' && $domain === 'woocommerce') {
        $modern_ecommerce_translated_text = $modern_ecommerce_heading;
    }
    return $modern_ecommerce_translated_text;
}
add_filter('gettext', 'modern_ecommerce_related_products_heading', 20, 3);
// breadcrumb seperator
function modern_ecommerce_woocommerce_breadcrumb_separator($modern_ecommerce_defaults) {
    $modern_ecommerce_separator = get_theme_mod('woocommerce_breadcrumb_separator', ' / ');

    // Update the separator
    $modern_ecommerce_defaults['delimiter'] = $modern_ecommerce_separator;

    return $modern_ecommerce_defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'modern_ecommerce_woocommerce_breadcrumb_separator');

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($modern_ecommerce_classes, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $modern_ecommerce_classes = array_merge(['wow','zoomIn'], $modern_ecommerce_classes);
	    }
	    return $modern_ecommerce_classes;
	},10,3);
}
//woocommerce-end//

// Get start function

// Enqueue scripts and styles
function modern_ecommerce_enqueue_admin_script($hook) {
    // Admin JS
    wp_enqueue_script('modern-ecommerce-admin-js', get_theme_file_uri('/assets/js/modern-ecommerce-admin.js'), array('jquery'), true);
    wp_localize_script(
		'modern-ecommerce-admin-js',
		'modern_ecommerce',
		array(
			'admin_ajax'	=>	admin_url('admin-ajax.php'),
			'wpnonce'			=>	wp_create_nonce('modern_ecommerce_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('modern-ecommerce-admin-js');

    wp_localize_script( 'modern-ecommerce-admin-js', 'modern_ecommerce_scripts_localize',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action('admin_enqueue_scripts', 'modern_ecommerce_enqueue_admin_script');

//dismiss function 
add_action( 'wp_ajax_modern_ecommerce_dismissed_notice_handler', 'modern_ecommerce_ajax_notice_dismiss_fuction' );

function modern_ecommerce_ajax_notice_dismiss_fuction() {
	if (!wp_verify_nonce($_POST['wpnonce'], 'modern_ecommerce_dismissed_notice_nonce')) {
		exit;
	}
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

//get start box
function modern_ecommerce_custom_admin_notice() {
    // Check if the notice is dismissed
    if ( ! get_option('dismissed-get_started_notice', FALSE ) )  {
        // Check if not on the theme documentation page
        $modern_ecommerce_current_screen = get_current_screen();
        if ($modern_ecommerce_current_screen && $modern_ecommerce_current_screen->id !== 'appearance_page_modern-ecommerce-guide-page') {
            $modern_ecommerce_theme = wp_get_theme();
            ?>
            <div class="notice notice-info is-dismissible" data-notice="get_started_notice">
                <div class="notice-div">
                    <div>
                        <p class="theme-name"><?php echo esc_html($modern_ecommerce_theme->get('Name')); ?></p>
                        <p><?php _e('For information and detailed instructions, check out our theme documentation.', 'modern-ecommerce'); ?></p>
                    </div>
                    <div class="notice-buttons-box">
                        <a class="button-primary livedemo" href="<?php echo esc_url( MODERN_ECOMMERCE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'modern-ecommerce'); ?></a>
                        <a class="button-primary buynow" href="<?php echo esc_url( MODERN_ECOMMERCE_BUY_PRO ); ?>" target="_blank"><?php esc_html_e('Buy Now', 'modern-ecommerce'); ?></a>
                        <a class="button-primary theme-install" href="themes.php?page=modern-ecommerce-guide-page"><?php _e('Begin Installation', 'modern-ecommerce'); ?></a> 
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
add_action('admin_notices', 'modern_ecommerce_custom_admin_notice');

//after switch theme
add_action('after_switch_theme', 'modern_ecommerce_after_switch_theme');
function modern_ecommerce_after_switch_theme () {
    update_option('dismissed-get_started_notice', FALSE );
}
//get-start-function-end//

// tag count
function modern_ecommerce_display_post_tag_count() {
    $modern_ecommerce_tags = get_the_tags();
    $modern_ecommerce_tag_count = ($modern_ecommerce_tags) ? count($modern_ecommerce_tags) : 0;
    $modern_ecommerce_tag_text = ($modern_ecommerce_tag_count === 1) ? 'tag' : 'tags';
    echo $modern_ecommerce_tag_count . ' ' . $modern_ecommerce_tag_text;
}

//media post format
function modern_ecommerce_get_media($modern_ecommerce_type = array()){
	$modern_ecommerce_content = apply_filters( 'the_content', get_the_content() );
  	$output = false;

  // Only get media from the content if a playlist isn't present.
  if ( false === strpos( $modern_ecommerce_content, 'wp-playlist-script' ) ) {
    $output = get_media_embedded_in_content( $modern_ecommerce_content, $modern_ecommerce_type );
    return $output;
  }
}

// front page template
function modern_ecommerce_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'modern_ecommerce_front_page_template' );

// excerpt function
function modern_ecommerce_custom_excerpt() {
    $modern_ecommerce_excerpt = get_the_excerpt();
    $modern_ecommerce_plain_text_excerpt = wp_strip_all_tags($modern_ecommerce_excerpt);
    
    // Get dynamic word limit from theme mod
    $modern_ecommerce_word_limit = esc_attr(get_theme_mod('modern_ecommerce_post_excerpt', '30'));
    
    // Limit the number of words
    $modern_ecommerce_limited_excerpt = implode(' ', array_slice(explode(' ', $modern_ecommerce_plain_text_excerpt), 0, $modern_ecommerce_word_limit));

    echo esc_html($modern_ecommerce_limited_excerpt);
}

// typography
function modern_ecommerce_fonts_scripts() {
	$modern_ecommerce_headings_font = esc_html(get_theme_mod('modern_ecommerce_headings_text'));
	$modern_ecommerce_body_font = esc_html(get_theme_mod('modern_ecommerce_body_text'));

	if( $modern_ecommerce_headings_font ) {
		wp_enqueue_style( 'modern-ecommerce-headings-fonts', '//fonts.googleapis.com/css?family='. $modern_ecommerce_headings_font );
	} else {
		wp_enqueue_style( 'modern-ecommerce-source-sans', '//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
	}
	if( $modern_ecommerce_body_font ) {
		wp_enqueue_style( 'modern-ecommerce-body-fonts', '//fonts.googleapis.com/css?family='. $modern_ecommerce_body_font );
	} else {
		wp_enqueue_style( 'modern-ecommerce-source-body', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,400italic,700,600');
	}
}
add_action( 'wp_enqueue_scripts', 'modern_ecommerce_fonts_scripts' );

// Footer Text
function modern_ecommerce_copyright_link() {
    $modern_ecommerce_footer_text = get_theme_mod('modern_ecommerce_footer_text', esc_html__('Ecommerce WordPress Theme', 'modern-ecommerce'));
    $modern_ecommerce_credit_link = esc_url('https://www.ovationthemes.com/products/free-ecommerce-wordpress-theme');

    echo '<a href="' . $modern_ecommerce_credit_link . '" target="_blank">' . esc_html($modern_ecommerce_footer_text) . '<span class="footer-copyright">' . esc_html__(' By Ovation Themes', 'modern-ecommerce') . '</span></a>';
}

// custom sanitizations
// dropdown
function modern_ecommerce_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}
// slider custom control
if ( ! function_exists( 'modern_ecommerce_sanitize_integer' ) ) {
	function modern_ecommerce_sanitize_integer( $input ) {
		return (int) $input;
	}
}
// range contol
function modern_ecommerce_sanitize_number_absint( $number, $setting ) {
	// Ensure input is an absolute integer.
	$number = absint( $number );

	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;

	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );

	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );

	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
// select post page
function modern_ecommerce_sanitize_select( $input, $setting ){  
    $input = sanitize_key($input);    
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );      
}
// toggle switch
function modern_ecommerce_callback_sanitize_switch( $value ) {
	// Switch values must be equal to 1 of off. Off is indicator and should not be translated.
	return ( ( isset( $value ) && $value == 1 ) ? 1 : 'off' );
}
//choices control
function modern_ecommerce_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
// Sanitize Sortable control.
function modern_ecommerce_sanitize_sortable( $val, $setting ) {
	if ( is_string( $val ) || is_numeric( $val ) ) {
		return array(
			esc_attr( $val ),
		);
	}
	$sanitized_value = array();
	foreach ( $val as $item ) {
		if ( isset( $setting->manager->get_control( $setting->id )->choices[ $item ] ) ) {
			$sanitized_value[] = esc_attr( $item );
		}
	}
	return $sanitized_value;
}

// customizer-dropdowns
function modern_ecommerce_slider_dropdown(){
	if(get_option('modern_ecommerce_slider_arrows') == true ) {
		return true;
	}
	return false;
}
function modern_ecommerce_service_dropdown(){
	if(get_option('modern_ecommerce_service_show_hide') == true ) {
		return true;
	}
	return false;
}
function modern_ecommerce_product_dropdown(){
	if(get_option('modern_ecommerce_product_show_hide') == true ) {
		return true;
	}
	return false;
}

// theme setup
function modern_ecommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "wp-block-styles" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'title-tag' );
	add_theme_support('custom-background',array(
		'default-color' => 'ffffff',
	));
	add_image_size( 'modern-ecommerce-featured-image', 2000, 1200, true );
	add_image_size( 'modern-ecommerce-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'modern-ecommerce' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       	=> 250,
		'height'      	=> 250,
		'flex-width'	=> true,
		'flex-height'	=> true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio','quote',) );
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', modern_ecommerce_fonts_url() ) );
}
add_action( 'after_setup_theme', 'modern_ecommerce_setup' );

// widgets
function modern_ecommerce_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'modern-ecommerce' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'modern-ecommerce' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'modern-ecommerce' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget wow zoomIn %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'modern-ecommerce' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'modern-ecommerce' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'modern-ecommerce' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'modern-ecommerce' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Product Category Dropdown', 'modern-ecommerce' ),
		'id'            => 'product-cat',
		'description'   => __( 'Add widgets here to appear in your header.', 'modern-ecommerce' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'modern_ecommerce_widgets_init' );

// fonts url
function modern_ecommerce_fonts_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Nunito Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

//Enqueue scripts and styles.
function modern_ecommerce_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'modern-ecommerce-fonts', modern_ecommerce_fonts_url(), array() );

	//Bootstarp
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );

	// Theme stylesheet.
	wp_enqueue_style( 'modern-ecommerce-style', get_stylesheet_uri() );

	wp_style_add_data('modern-ecommerce-style', 'rtl', 'replace');

	// Theme Customize CSS.
	require get_parent_theme_file_path( 'inc/extra_customization.php' );
	wp_add_inline_style( 'modern-ecommerce-style',$modern_ecommerce_custom_style );

	//font-awesome
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	// Block Style
	wp_enqueue_style( 'modern-ecommerce-block-style', esc_url( get_template_directory_uri() ).'/assets/css/blocks.css' );

	//Custom JS
	wp_enqueue_script( 'modern-ecommerce-custom.js', get_theme_file_uri( '/assets/js/theme-script.js' ), array( 'jquery' ), true );

	//Nav Focus JS
	wp_enqueue_script( 'modern-ecommerce-navigation-focus', get_theme_file_uri( '/assets/js/navigation-focus.js' ), array( 'jquery' ), true );

	//Bootstarp JS
	wp_enqueue_script( 'bootstrap-js', get_theme_file_uri( '/assets/js/bootstrap.js' ), array( 'jquery' ),true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (get_option('modern_ecommerce_animation_enable', false) !== 'off') {
		//wow.js
		wp_enqueue_script( 'wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

		//animate.css
		wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'modern_ecommerce_scripts' );

function modern_ecommerce_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'modern-ecommerce-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . '/assets/css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'modern-ecommerce-fonts', modern_ecommerce_fonts_url(), array() );
}
add_action( 'enqueue_block_editor_assets', 'modern_ecommerce_block_editor_styles' );

# Load scripts and styles.(fontawesome)
add_action( 'customize_controls_enqueue_scripts', 'modern_ecommerce_customize_controls_register_scripts' );
function modern_ecommerce_customize_controls_register_scripts() {
	
	wp_enqueue_style( 'modern-ecommerce-ctypo-customize-controls-style', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
}

// enque files
require get_parent_theme_file_path( '/inc/custom-header.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/customizer.php' );
require get_template_directory() .'/inc/TGM/tgm.php';
require get_parent_theme_file_path( '/inc/typofont.php' );
require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );
require get_template_directory() . '/inc/wptt-webfont-loader.php';
require get_parent_theme_file_path( '/inc/breadcrumb.php' );
require get_parent_theme_file_path( 'inc/sortable/sortable_control.php' );
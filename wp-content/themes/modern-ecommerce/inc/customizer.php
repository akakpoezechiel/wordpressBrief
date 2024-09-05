<?php
/**
 * Modern Ecommerce: Customizer
 *
 * @subpackage Modern Ecommerce
 * @since 1.0
 */

function modern_ecommerce_customize_register( $wp_customize ) {

	wp_enqueue_style('customizercustom_css', esc_url( get_template_directory_uri() ). '/assets/css/customizer.css');

	// fontawesome icon-picker

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

  	require get_parent_theme_file_path( 'inc/switch/control_switch.php' );

  	require get_parent_theme_file_path( 'inc/custom-control.php' );

  	//Register the sortable control type.
	$wp_customize->register_control_type( 'Modern_Ecommerce_Control_Sortable' );

  	// Add homepage customizer file
  	require get_template_directory() . '/inc/customizer-home-page.php';

	// pro section
 	$wp_customize->add_section('modern_ecommerce_pro', array(
        'title'    => __('UPGRADE ECOMMERCE PREMIUM', 'modern-ecommerce'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('modern_ecommerce_pro', array(
        'default'           => null,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Modern_Ecommerce_Pro_Control($wp_customize, 'modern_ecommerce_pro', array(
        'label'    => __('MODERN ECOMMERCE PREMIUM', 'modern-ecommerce'),
        'section'  => 'modern_ecommerce_pro',
        'settings' => 'modern_ecommerce_pro',
        'priority' => 1,
    )));
	$wp_customize->add_setting('modern_ecommerce_logo_title',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_logo_title',
			array(
				'settings'        => 'modern_ecommerce_logo_title',
				'section'         => 'title_tagline',
				'label'           => __( 'Show Site Title', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_logo_text',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_logo_text',
			array(
				'settings'        => 'modern_ecommerce_logo_text',
				'section'         => 'title_tagline',
				'label'           => __( 'show Site Tagline', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
    $wp_customize->add_setting('modern_ecommerce_logo_max_height',array(
		'default'=> '100',
		'transport' => 'refresh',
		'sanitize_callback' => 'modern_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control(new Modern_Ecommerce_Slider_Custom_Control( $wp_customize, 'modern_ecommerce_logo_max_height',array(
		'label'	=> esc_html__('Logo Width','modern-ecommerce'),
		'section'=> 'title_tagline',
		'settings'=>'modern_ecommerce_logo_max_height',
		'input_attrs' => array(
			'reset'				=>100,
            'step'             	=> 1,
			'min'              	=> 0,
			'max'              	=> 250,
        ),
	)));

	// Typography
	$wp_customize->add_section( 'modern_ecommerce_typography_settings', array(
		'title'       => __( 'Typography Settings', 'modern-ecommerce' ),
		'priority'       => 3,
	) );
	$font_choices = array(
		'' => 'Select',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);
	$wp_customize->add_setting( 'modern_ecommerce_section_typo_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_typo_heading', array(
		'label'       => esc_html__( 'Typography Settings', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_typography_settings',
		'settings'    => 'modern_ecommerce_section_typo_heading',
	) ) );
	$wp_customize->add_setting( 'modern_ecommerce_headings_text', array(
		'sanitize_callback' => 'modern_ecommerce_sanitize_fonts',
	));
	$wp_customize->add_control( 'modern_ecommerce_headings_text', array(
		'type' => 'select',
		'description' => __('Select your suitable font for the headings.', 'modern-ecommerce'),
		'section' => 'modern_ecommerce_typography_settings',
		'choices' => $font_choices
	));
	$wp_customize->add_setting( 'modern_ecommerce_body_text', array(
		'sanitize_callback' => 'modern_ecommerce_sanitize_fonts'
	));
	$wp_customize->add_control( 'modern_ecommerce_body_text', array(
		'type' => 'select',
		'description' => __( 'Select your suitable font for the body.', 'modern-ecommerce' ),
		'section' => 'modern_ecommerce_typography_settings',
		'choices' => $font_choices
	) );

    // Theme General Settings
    $wp_customize->add_section('modern_ecommerce_theme_settings',array(
        'title' => __('Theme General Settings', 'modern-ecommerce'),
        'priority' => 3,
    ) );
    $wp_customize->add_setting( 'modern_ecommerce_section_sticky_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_sticky_heading', array(
		'label'       => esc_html__( 'Sticky header Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_sticky_heading',
	) ) );
    $wp_customize->add_setting(
		'modern_ecommerce_sticky_header',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_sticky_header',
			array(
				'settings'        => 'modern_ecommerce_sticky_header',
				'section'         => 'modern_ecommerce_theme_settings',
				'label'           => __( 'Show Sticky Header', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'modern_ecommerce_section_loader_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_loader_heading', array(
		'label'       => esc_html__( 'Loader Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_loader_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_theme_loader',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => 'off',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_theme_loader',
			array(
				'settings'        => 'modern_ecommerce_theme_loader',
				'section'         => 'modern_ecommerce_theme_settings',
				'label'           => __( 'Show Site Loader', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('modern_ecommerce_loader_style',array(
        'default' => 'style_one',
        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('modern_ecommerce_loader_style',array(
        'type' => 'select',
        'label' => __('Select Loader Design','modern-ecommerce'),
        'section' => 'modern_ecommerce_theme_settings',
        'choices' => array(
            'style_one' => __('Circle','modern-ecommerce'),
            'style_two' => __('Bar','modern-ecommerce'),
        ),
	) );
	
	$wp_customize->add_setting( 'modern_ecommerce_theme_width_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_theme_width_heading', array(
		'label'       => esc_html__( 'Theme Width Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_theme_width_heading',
	) ) );
	$wp_customize->add_setting('modern_ecommerce_width_options',array(
        'default' => 'full_width',
        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('modern_ecommerce_width_options',array(
        'type' => 'select',
        'label' => __('Theme Width Option','modern-ecommerce'),
        'section' => 'modern_ecommerce_theme_settings',
        'choices' => array(
            'full_width' => __('fullwidth','modern-ecommerce'),
            'container' => __('container','modern-ecommerce'),
            'container_fluid' => __('container Fluid','modern-ecommerce'),
        ),
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_menu_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_menu_heading', array(
		'label'       => esc_html__( 'Menu Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_menu_heading',
	) ) );
	$wp_customize->add_setting('modern_ecommerce_menu_text_transform',array(
        'default' => 'CAPITALISE',
        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('modern_ecommerce_menu_text_transform',array(
        'type' => 'select',
        'label' => __('Menus Text Transform','modern-ecommerce'),
        'section' => 'modern_ecommerce_theme_settings',
        'choices' => array(
            'CAPITALISE' => __('CAPITALISE','modern-ecommerce'),
            'UPPERCASE' => __('UPPERCASE','modern-ecommerce'),
            'LOWERCASE' => __('LOWERCASE','modern-ecommerce'),
        ),
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_scroll_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_scroll_heading', array(
		'label'       => esc_html__( 'Scroll Top Settings', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_scroll_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_scroll_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_scroll_enable',
			array(
				'settings'        => 'modern_ecommerce_scroll_enable',
				'section'         => 'modern_ecommerce_theme_settings',
				'label'           => __( 'show Scroll Top', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'modern_ecommerce_scroll_options',
		array(
			'default' => 'right_align',
			'transport' => 'refresh',
			'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Text_Radio_Button_Custom_Control( $wp_customize, 'modern_ecommerce_scroll_options',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Scroll Top Alignment', 'modern-ecommerce' ),
			'section' => 'modern_ecommerce_theme_settings',
			'choices' => array(
				'left_align' => __('LEFT','modern-ecommerce'),
				'center_align' => __('CENTER','modern-ecommerce'),
				'right_align' => __('RIGHT','modern-ecommerce'),
			)
		)
	) );
	$wp_customize->add_setting('modern_ecommerce_scroll_top_icon',array(
		'default'	=> 'fas fa-chevron-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_scroll_top_icon',array(
		'label'	=> __('Add Scroll Top Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_theme_settings',
		'setting'	=> 'modern_ecommerce_scroll_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'modern_ecommerce_section_cursor_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_cursor_heading', array(
		'label'       => esc_html__( 'Cursor Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_cursor_heading',
	) ) );

	$wp_customize->add_setting(
		'modern_ecommerce_enable_custom_cursor',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_enable_custom_cursor',
			array(
				'settings'        => 'modern_ecommerce_enable_custom_cursor',
				'section'         => 'modern_ecommerce_theme_settings',
				'label'           => __( 'show custom cursor', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting( 'modern_ecommerce_section_animation_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_animation_heading', array(
		'label'       => esc_html__( 'Animation Setting', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_theme_settings',
		'settings'    => 'modern_ecommerce_section_animation_heading',
	) ) );

	$wp_customize->add_setting(
		'modern_ecommerce_animation_enable',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_animation_enable',
			array(
				'settings'        => 'modern_ecommerce_animation_enable',
				'section'         => 'modern_ecommerce_theme_settings',
				'label'           => __( 'show/Hide Animation', 'modern-ecommerce' ),
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);

	// Post Layouts
	$wp_customize->add_panel( 'modern_ecommerce_post_panel', array(
		'title' => esc_html__( 'Post Layout', 'modern-ecommerce' ),
		'priority' => 4,
	));
    $wp_customize->add_section('modern_ecommerce_layout',array(
        'title' => __('Single-Post Layout', 'modern-ecommerce'),
        'panel' => 'modern_ecommerce_post_panel',
    ) );
    $wp_customize->add_setting( 'modern_ecommerce_section_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_post_heading', array(
		'label'       => esc_html__( 'Single Post Structure', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_layout',
		'settings'    => 'modern_ecommerce_section_post_heading',
	) ) );
	$wp_customize->add_setting( 'modern_ecommerce_single_post_option',
		array(
			'default' => 'single_right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Radio_Image_Control( $wp_customize, 'modern_ecommerce_single_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Single Post Page Layout', 'modern-ecommerce' ),
			'section' => 'modern_ecommerce_layout',
			'choices' => array(

				'single_right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'modern-ecommerce' )
				),
				'single_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'modern-ecommerce' )
				),
				'single_full_width' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'modern-ecommerce' )
				),
			)
		)
	) );
	$wp_customize->add_setting('modern_ecommerce_single_post_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_post_date',
			array(
				'settings'        => 'modern_ecommerce_single_post_date',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show Date', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_single_post_date', array(
		'selector' => '.date-box',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_single_post_date',
	) );
	$wp_customize->add_setting('modern_ecommerce_single_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_single_date_icon',array(
		'label'	=> __('date Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_layout',
		'setting'	=> 'modern_ecommerce_single_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_single_post_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_post_admin',
			array(
				'settings'        => 'modern_ecommerce_single_post_admin',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show Author/Admin', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_single_post_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_single_post_admin',
	) );
	$wp_customize->add_setting('modern_ecommerce_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_single_author_icon',array(
		'label'	=> __('Author Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_layout',
		'setting'	=> 'modern_ecommerce_single_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_single_post_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_post_comment',
			array(
				'settings'        => 'modern_ecommerce_single_post_comment',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show Comment', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_single_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_single_comment_icon',array(
		'label'	=> __('comment Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_layout',
		'setting'	=> 'modern_ecommerce_single_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_single_post_tag_count',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_post_tag_count',
			array(
				'settings'        => 'modern_ecommerce_single_post_tag_count',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show tag count', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_single_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_single_tag_icon',array(
		'label'	=> __('tag Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_layout',
		'setting'	=> 'modern_ecommerce_single_tag_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_single_post_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_post_tag',
			array(
				'settings'        => 'modern_ecommerce_single_post_tag',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show Tags', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_single_post_tag', array(
		'selector' => '.single-tags',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_single_post_tag',
	) );
	$wp_customize->add_setting('modern_ecommerce_similar_post',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_similar_post',
			array(
				'settings'        => 'modern_ecommerce_similar_post',
				'section'         => 'modern_ecommerce_layout',
				'label'           => __( 'Show Similar post', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_similar_text',array(
		'default' => 'Explore More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('modern_ecommerce_similar_text',array(
		'label' => esc_html__('Similar Post Heading','modern-ecommerce'),
		'section' => 'modern_ecommerce_layout',
		'setting' => 'modern_ecommerce_similar_text',
		'type'    => 'text'
	));
	$wp_customize->add_section('modern_ecommerce_archieve_post_layot',array(
        'title' => __('Archieve-Post Layout', 'modern-ecommerce'),
        'panel' => 'modern_ecommerce_post_panel',
    ) );
	$wp_customize->add_setting( 'modern_ecommerce_section_archive_post_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_archive_post_heading', array(
		'label'       => esc_html__( 'Archieve Post Structure', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_archieve_post_layot',
		'settings'    => 'modern_ecommerce_section_archive_post_heading',
	) ) );
    $wp_customize->add_setting( 'modern_ecommerce_post_option',
		array(
			'default' => 'right_sidebar',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Radio_Image_Control( $wp_customize, 'modern_ecommerce_post_option',
		array(
			'type'=>'select',
			'label' => __( 'select Post Page Layout', 'modern-ecommerce' ),
			'section' => 'modern_ecommerce_archieve_post_layot',
			'choices' => array(
				'right_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/2column.jpg',
					'name' => __( 'Right Sidebar', 'modern-ecommerce' )
				),
				'left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/left.png',
					'name' => __( 'Left Sidebar', 'modern-ecommerce' )
				),
				'one_column' => array(
					'image' => get_template_directory_uri().'/assets/images/1column.jpg',
					'name' => __( 'One Column', 'modern-ecommerce' )
				),
				'three_column' => array(
					'image' => get_template_directory_uri().'/assets/images/3column.jpg',
					'name' => __( 'Three Column', 'modern-ecommerce' )
				),
				'four_column' => array(
					'image' => get_template_directory_uri().'/assets/images/4column.jpg',
					'name' => __( 'Four Column', 'modern-ecommerce' )
				),
				'grid_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-sidebar.jpg',
					'name' => __( 'Grid-Right-Sidebar Layout', 'modern-ecommerce' )
				),
				'grid_left_sidebar' => array(
					'image' => get_template_directory_uri().'/assets/images/grid-left.png',
					'name' => __( 'Grid-Left-Sidebar Layout', 'modern-ecommerce' )
				),
				'grid_post' => array(
					'image' => get_template_directory_uri().'/assets/images/grid.jpg',
					'name' => __( 'Grid Layout', 'modern-ecommerce' )
				)
			)
		)
	) );
	$wp_customize->add_setting( 'modern_ecommerce_grid_column',
		array(
			'default' => '3_column',
			'transport' => 'refresh',
			'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Text_Radio_Button_Custom_Control( $wp_customize, 'modern_ecommerce_grid_column',
		array(
			'type' => 'select',
			'label' => esc_html__('Grid Post Per Row','modern-ecommerce'),
			'section' => 'modern_ecommerce_archieve_post_layot',
			'choices' => array(
				'1_column' => __('1','modern-ecommerce'),
	            '2_column' => __('2','modern-ecommerce'),
	            '3_column' => __('3','modern-ecommerce'),
	            '4_column' => __('4','modern-ecommerce'),
			)
		)
	) );
	$wp_customize->add_setting('archieve_post_order', array(
        'default' => array('title', 'image', 'meta','excerpt','btn'),
        'sanitize_callback' => 'modern_ecommerce_sanitize_sortable',
    ));
    $wp_customize->add_control(new Modern_Ecommerce_Control_Sortable($wp_customize, 'archieve_post_order', array(
    	'label' => esc_html__('Post Order', 'modern-ecommerce'),
        'description' => __('Drag & Drop post items to re-arrange the order and also hide and show items as per the need by clicking on the eye icon.', 'modern-ecommerce') ,
        'section' => 'modern_ecommerce_archieve_post_layot',
        'choices' => array(
            'title' => __('title', 'modern-ecommerce') ,
            'image' => __('media', 'modern-ecommerce') ,
            'meta' => __('meta', 'modern-ecommerce') ,
            'excerpt' => __('excerpt', 'modern-ecommerce') ,
            'btn' => __('Read more', 'modern-ecommerce') ,
        ) ,
    )));
	$wp_customize->add_setting('modern_ecommerce_post_excerpt',array(
		'default'=> 30,
		'transport' => 'refresh',
		'sanitize_callback' => 'modern_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control(new Modern_Ecommerce_Slider_Custom_Control( $wp_customize, 'modern_ecommerce_post_excerpt',array(
		'label' => esc_html__( 'Excerpt Limit','modern-ecommerce' ),
		'section'=> 'modern_ecommerce_archieve_post_layot',
		'settings'=>'modern_ecommerce_post_excerpt',
		'input_attrs' => array(
			'reset'			   => 30,
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	$wp_customize->add_setting('modern_ecommerce_read_more_text',array(
		'default' => 'Read More',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('modern_ecommerce_read_more_text',array(
		'label' => esc_html__('Read More Text','modern-ecommerce'),
		'section' => 'modern_ecommerce_archieve_post_layot',
		'setting' => 'modern_ecommerce_read_more_text',
		'type'    => 'text'
	));
	$wp_customize->add_setting('modern_ecommerce_date',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_date',
			array(
				'settings'        => 'modern_ecommerce_date',
				'section'         => 'modern_ecommerce_archieve_post_layot',
				'label'           => __( 'Show Date', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_date', array(
		'selector' => '.date-box',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_date',
	) );
	$wp_customize->add_setting('modern_ecommerce_date_icon',array(
		'default'	=> 'far fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_date_icon',array(
		'label'	=> __('date Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_archieve_post_layot',
		'setting'	=> 'modern_ecommerce_date_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_sticky_icon',array(
		'default'	=> 'fas fa-thumb-tack',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_sticky_icon',array(
		'label'	=> __('Sticky Post Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_archieve_post_layot',
		'setting'	=> 'modern_ecommerce_sticky_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_admin',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_admin',
			array(
				'settings'        => 'modern_ecommerce_admin',
				'section'         => 'modern_ecommerce_archieve_post_layot',
				'label'           => __( 'Show Author/Admin', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_admin', array(
		'selector' => '.entry-author',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_admin',
	) );
	$wp_customize->add_setting('modern_ecommerce_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_author_icon',array(
		'label'	=> __('Author Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_archieve_post_layot',
		'setting'	=> 'modern_ecommerce_author_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_comment',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_comment',
			array(
				'settings'        => 'modern_ecommerce_comment',
				'section'         => 'modern_ecommerce_archieve_post_layot',
				'label'           => __( 'Show Comment', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_comment', array(
		'selector' => '.entry-comments',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_comment',
	) );
	$wp_customize->add_setting('modern_ecommerce_comment_icon',array(
		'default'	=> 'fas fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_comment_icon',array(
		'label'	=> __('comment Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_archieve_post_layot',
		'setting'	=> 'modern_ecommerce_comment_icon',
		'type'		=> 'icon'
	)));
	$wp_customize->add_setting('modern_ecommerce_tag',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_tag',
			array(
				'settings'        => 'modern_ecommerce_tag',
				'section'         => 'modern_ecommerce_archieve_post_layot',
				'label'           => __( 'Show tag count', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_tag', array(
		'selector' => '.tags',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_tag',
	) );
	$wp_customize->add_setting('modern_ecommerce_tag_icon',array(
		'default'	=> 'fas fa-tags',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_tag_icon',array(
		'label'	=> __('tag Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_archieve_post_layot',
		'setting'	=> 'modern_ecommerce_tag_icon',
		'type'		=> 'icon'
	)));

	// header-image
	$wp_customize->add_setting( 'modern_ecommerce_section_header_image_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_header_image_heading', array(
		'label'       => esc_html__( 'Header Image Settings', 'modern-ecommerce' ),
		'section'     => 'header_image',
		'settings'    => 'modern_ecommerce_section_header_image_heading',
		'priority'    =>'1',
	) ) );

	$wp_customize->add_setting('modern_ecommerce_show_header_image',array(
        'default' => 'on',
        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
	));
	$wp_customize->add_control('modern_ecommerce_show_header_image',array(
        'type' => 'select',
        'label' => __('Select Option','modern-ecommerce'),
        'section' => 'header_image',
        'choices' => array(
            'on' => __('With Header Image','modern-ecommerce'),
            'off' => __('Without Header Image','modern-ecommerce'),
        ),
	) );

	// breadcrumb
	$wp_customize->add_section('modern_ecommerce_breadcrumb_settings',array(
        'title' => __('Breadcrumb Settings', 'modern-ecommerce'),
        'priority' => 4
    ) );
	$wp_customize->add_setting( 'modern_ecommerce_section_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_breadcrumb_heading', array(
		'label'       => esc_html__( 'theme Breadcrumb Settings', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_breadcrumb_settings',
		'settings'    => 'modern_ecommerce_section_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_enable_breadcrumb',
			array(
				'settings'        => 'modern_ecommerce_enable_breadcrumb',
				'section'         => 'modern_ecommerce_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_breadcrumb_separator', array(
        'default' => ' / ',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('modern_ecommerce_breadcrumb_separator', array(
        'label' => __('Breadcrumb Separator', 'modern-ecommerce'),
        'section' => 'modern_ecommerce_breadcrumb_settings',
        'type' => 'text',
    ));
	$wp_customize->add_setting( 'modern_ecommerce_single_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_single_breadcrumb_heading', array(
		'label'       => esc_html__( 'Single post & Page', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_breadcrumb_settings',
		'settings'    => 'modern_ecommerce_single_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_single_enable_breadcrumb',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_enable_breadcrumb',
			array(
				'settings'        => 'modern_ecommerce_single_enable_breadcrumb',
				'section'         => 'modern_ecommerce_breadcrumb_settings',
				'label'           => __( 'Show Breadcrumb', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) { 
		$wp_customize->add_setting( 'modern_ecommerce_woocommerce_breadcrumb_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_woocommerce_breadcrumb_heading', array(
			'label'       => esc_html__( 'Woocommerce Breadcrumb', 'modern-ecommerce' ),
			'section'     => 'modern_ecommerce_breadcrumb_settings',
			'settings'    => 'modern_ecommerce_woocommerce_breadcrumb_heading',
		) ) );
		$wp_customize->add_setting(
			'modern_ecommerce_woocommerce_enable_breadcrumb',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Modern_Ecommerce_Customizer_Customcontrol_Switch(
				$wp_customize,
				'modern_ecommerce_woocommerce_enable_breadcrumb',
				array(
					'settings'        => 'modern_ecommerce_woocommerce_enable_breadcrumb',
					'section'         => 'modern_ecommerce_breadcrumb_settings',
					'label'           => __( 'Show Breadcrumb', 'modern-ecommerce' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'modern-ecommerce' ),
						'off'    => __( 'Off', 'modern-ecommerce' ),
					),
					'active_callback' => '',
				)
			)
		);
		$wp_customize->add_setting('woocommerce_breadcrumb_separator', array(
	        'default' => ' / ',
	        'sanitize_callback' => 'sanitize_text_field',
	    ));
	    $wp_customize->add_control('woocommerce_breadcrumb_separator', array(
	        'label' => __('Breadcrumb Separator', 'modern-ecommerce'),
	        'section' => 'modern_ecommerce_breadcrumb_settings',
	        'type' => 'text',
	    ));
	}

	if ( class_exists( 'WooCommerce' ) ) {	
		$wp_customize->add_section('modern_ecommerce_woocommerce_settings',array(
	        'title' => __('WooCommerce Settings', 'modern-ecommerce'),
	        'priority' => 4,
	    ) );
		$wp_customize->add_setting( 'modern_ecommerce_section_shoppage_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_shoppage_heading', array(
			'label'       => esc_html__( 'Sidebar Settings', 'modern-ecommerce' ),
			'section'     => 'modern_ecommerce_woocommerce_settings',
			'settings'    => 'modern_ecommerce_section_shoppage_heading',
		) ) );
		$wp_customize->add_setting( 'modern_ecommerce_shop_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Modern_Ecommerce_Radio_Image_Control( $wp_customize, 'modern_ecommerce_shop_page_sidebar',
			array(
				'type'=>'select',
				'label' => __( 'Show Shop Page Sidebar', 'modern-ecommerce' ),
				'section'     => 'modern_ecommerce_woocommerce_settings',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'modern-ecommerce' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'modern-ecommerce' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'modern-ecommerce' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'modern_ecommerce_wocommerce_single_page_sidebar',
			array(
				'default' => 'right_sidebar',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control( new Modern_Ecommerce_Radio_Image_Control( $wp_customize, 'modern_ecommerce_wocommerce_single_page_sidebar',
			array(
				'type'=>'select',
				'label'           => __( 'Show Single Product Page Sidebar', 'modern-ecommerce' ),
				'section'     => 'modern_ecommerce_woocommerce_settings',
				'choices' => array(

					'right_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/2column.jpg',
						'name' => __( 'Right Sidebar', 'modern-ecommerce' )
					),
					'left_sidebar' => array(
						'image' => get_template_directory_uri().'/assets/images/left.png',
						'name' => __( 'Left Sidebar', 'modern-ecommerce' )
					),
					'full_width' => array(
						'image' => get_template_directory_uri().'/assets/images/1column.jpg',
						'name' => __( 'Full Width', 'modern-ecommerce' )
					),
				)
			)
		) );
		$wp_customize->add_setting( 'modern_ecommerce_section_archieve_product_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_archieve_product_heading', array(
			'label'       => esc_html__( 'Archieve Product Settings', 'modern-ecommerce' ),
			'section'     => 'modern_ecommerce_woocommerce_settings',
			'settings'    => 'modern_ecommerce_section_archieve_product_heading',
		) ) );
		$wp_customize->add_setting('modern_ecommerce_archieve_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		));
		$wp_customize->add_control('modern_ecommerce_archieve_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','modern-ecommerce'),
	        'section' => 'modern_ecommerce_woocommerce_settings',
	        'choices' => array(
	            '1' => __('One Column','modern-ecommerce'),
	            '2' => __('Two Column','modern-ecommerce'),
	            '3' => __('Three Column','modern-ecommerce'),
	            '4' => __('four Column','modern-ecommerce'),
	            '5' => __('Five Column','modern-ecommerce'),
	            '6' => __('Six Column','modern-ecommerce'),
	        ),
		) );
		$wp_customize->add_setting( 'modern_ecommerce_archieve_shop_perpage', array(
			'default'              => 6,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'modern_ecommerce_archieve_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','modern-ecommerce' ),
			'section'     => 'modern_ecommerce_woocommerce_settings',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 30,
			),
		) );
		$wp_customize->add_setting( 'modern_ecommerce_section_related_heading', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_related_heading', array(
			'label'       => esc_html__( 'Related Product Settings', 'modern-ecommerce' ),
			'section'     => 'modern_ecommerce_woocommerce_settings',
			'settings'    => 'modern_ecommerce_section_related_heading',
		) ) );
		$wp_customize->add_setting('woocommerce_related_products_heading', array(
	        'default' => 'Related products',
	        'sanitize_callback' => 'sanitize_text_field',
	    ));
	    $wp_customize->add_control('woocommerce_related_products_heading', array(
	        'label' => __('Related Products Heading', 'modern-ecommerce'),
	        'section' => 'modern_ecommerce_woocommerce_settings',
	        'type' => 'text',
	    ));
		$wp_customize->add_setting('modern_ecommerce_related_item_columns',array(
	        'default' => '3',
	        'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		));
		$wp_customize->add_control('modern_ecommerce_related_item_columns',array(
	        'type' => 'select',
	        'label' => __('Select No of Columns','modern-ecommerce'),
	        'section' => 'modern_ecommerce_woocommerce_settings',
	        'choices' => array(
	            '1' => __('One Column','modern-ecommerce'),
	            '2' => __('Two Column','modern-ecommerce'),
	            '3' => __('Three Column','modern-ecommerce'),
	            '4' => __('four Column','modern-ecommerce'),
	            '5' => __('Five Column','modern-ecommerce'),
	            '6' => __('Six Column','modern-ecommerce'),
	        ),
		) );
		$wp_customize->add_setting( 'modern_ecommerce_related_shop_perpage', array(
			'default'              => 3,
			'type'                 => 'theme_mod',
			'transport' 		   => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_sanitize_number_absint',
			'sanitize_js_callback' => 'absint',
		) );
		$wp_customize->add_control( 'modern_ecommerce_related_shop_perpage', array(
			'label'       => esc_html__( 'Display Products','modern-ecommerce' ),
			'section'     => 'modern_ecommerce_woocommerce_settings',
			'type'        => 'number',
			'input_attrs' => array(
				'step'             => 1,
				'min'              => 0,
				'max'              => 10,
			),
		) );
		$wp_customize->add_setting(
			'modern_ecommerce_related_product',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(new Modern_Ecommerce_Customizer_Customcontrol_Switch($wp_customize,'modern_ecommerce_related_product',
			array(
				'settings'        => 'modern_ecommerce_related_product',
				'section'         => 'modern_ecommerce_woocommerce_settings',
				'label'           => __( 'show Related Products', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		));
	}

	// mobile width
	$wp_customize->add_section('modern_ecommerce_mobile_options',array(
        'title' => __('Mobile Media settings', 'modern-ecommerce'),
        'priority' => 4,
    ) );
    $wp_customize->add_setting( 'modern_ecommerce_section_mobile_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_mobile_heading', array(
		'label'       => esc_html__( 'Mobile Media settings', 'modern-ecommerce' ),
		'section'     => 'modern_ecommerce_mobile_options',
		'settings'    => 'modern_ecommerce_section_mobile_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_slider_button_mobile_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_slider_button_mobile_show_hide',
			array(
				'settings'        => 'modern_ecommerce_slider_button_mobile_show_hide',
				'section'         => 'modern_ecommerce_mobile_options',
				'label'           => __( 'Show Slider Button', 'modern-ecommerce' ),
				'description' => __('Control wont function if the button is off in the main slider settings.', 'modern-ecommerce') ,				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting(
		'modern_ecommerce_scroll_enable_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_scroll_enable_mobile',
			array(
				'settings'        => 'modern_ecommerce_scroll_enable_mobile',
				'section'         => 'modern_ecommerce_mobile_options',
				'label'           => __( 'Show Scroll Top', 'modern-ecommerce' ),
				'description' => __('Control wont function if scroll-top is off in the main settings.', 'modern-ecommerce') ,				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting( 'modern_ecommerce_section_mobile_breadcrumb_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_mobile_breadcrumb_heading', array(
		'label'       => esc_html__( 'Mobile Breadcrumb settings', 'modern-ecommerce' ),
		'description' => __('Controls wont function if the breadcrumb is off in the main breadcrumb settings.', 'modern-ecommerce') ,
		'section'     => 'modern_ecommerce_mobile_options',
		'settings'    => 'modern_ecommerce_section_mobile_breadcrumb_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_enable_breadcrumb_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_enable_breadcrumb_mobile',
			array(
				'settings'        => 'modern_ecommerce_enable_breadcrumb_mobile',
				'section'         => 'modern_ecommerce_mobile_options',
				'label'           => __( 'Theme Breadcrumb', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->add_setting(
		'modern_ecommerce_single_enable_breadcrumb_mobile',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '1',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_single_enable_breadcrumb_mobile',
			array(
				'settings'        => 'modern_ecommerce_single_enable_breadcrumb_mobile',
				'section'         => 'modern_ecommerce_mobile_options',
				'label'           => __( 'Single Post & Page', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'modern_ecommerce_woocommerce_enable_breadcrumb_mobile',
			array(
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => '1',
				'transport'            => 'refresh',
				'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
			)
		);
		$wp_customize->add_control(
			new Modern_Ecommerce_Customizer_Customcontrol_Switch(
				$wp_customize,
				'modern_ecommerce_woocommerce_enable_breadcrumb_mobile',
				array(
					'settings'        => 'modern_ecommerce_woocommerce_enable_breadcrumb_mobile',
					'section'         => 'modern_ecommerce_mobile_options',
					'label'           => __( 'wooCommerce Breadcrumb', 'modern-ecommerce' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'modern-ecommerce' ),
						'off'    => __( 'Off', 'modern-ecommerce' ),
					),
					'active_callback' => '',
				)
			)
		);
	}

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'modern_ecommerce_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'modern_ecommerce_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'modern_ecommerce_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'modern_ecommerce_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'modern-ecommerce' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'modern-ecommerce' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'modern_ecommerce_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'modern_ecommerce_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'modern_ecommerce_customize_register' );

function modern_ecommerce_customize_partial_blogname() {
	bloginfo( 'name' );
}
function modern_ecommerce_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
function modern_ecommerce_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}
function modern_ecommerce_is_view_with_layout_option() {
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

define('MODERN_ECOMMERCE_PRO_LINK',__('https://www.ovationthemes.com/products/ecommerce-wordpress-theme','modern-ecommerce'));

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Modern_Ecommerce_Pro_Control')):
    class Modern_Ecommerce_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
	        <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( MODERN_ECOMMERCE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE ECOMMERCE PREMIUM','modern-ecommerce');?> </a>
	        </div>
            <div class="col-md">
                <img class="modern_ecommerce_img_responsive " src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png">
            </div>
	        <div class="col-md">
	            <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('Modern Ecommerce PREMIUM - Features', 'modern-ecommerce'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'modern-ecommerce');?> </li>
                    <li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'modern-ecommerce');?> </li>
                   	<li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'modern-ecommerce');?> </li>
                   	<li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'modern-ecommerce');?> </li>
                   	<li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'modern-ecommerce');?> </li>
                   	<li class="upsell-modern_ecommerce"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'modern-ecommerce');?> </li>
                </ul>
        	</div>
		    <div class="col-md upsell-btn upsell-btn-bottom">
	            <a href="<?php echo esc_url( MODERN_ECOMMERCE_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE ECOMMERCE PREMIUM','modern-ecommerce');?> </a>
		    </div>
		    <p><?php printf(__('Please review us if you love our product on %1$sWordPress.org%2$s. </br></br>  Thank You', 'modern-ecommerce'), '<a target="blank" href="https://wordpress.org/support/theme/modern-ecommerce/reviews/">', '</a>');
            ?></p>
        </label>
    <?php } }
endif;

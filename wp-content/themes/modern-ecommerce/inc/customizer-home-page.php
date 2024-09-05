<?php
/**
 * Modern Ecommerce: Customizer-home-page
 *
 * @subpackage Modern Ecommerce
 * @since 1.0
 */
	
	//  Home Page Panel
	$wp_customize->add_panel( 'modern_ecommerce_custompage_panel', array(
		'title' => esc_html__( 'Custom Page Settings', 'modern-ecommerce' ),
		'priority' => 2,
	));
	// Top Header
    $wp_customize->add_section('modern_ecommerce_top',array(
        'title' => __('Header Section', 'modern-ecommerce'),
        'priority' => 3,
        'panel' => 'modern_ecommerce_custompage_panel',
    ) );
    $wp_customize->add_setting( 'modern_ecommerce_section_contact_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_contact_heading', array(
		'label'       => esc_html__( 'Header Settings', 'modern-ecommerce' ),		
		'section'     => 'modern_ecommerce_top',
		'settings'    => 'modern_ecommerce_section_contact_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_change_language',
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
			'modern_ecommerce_change_language',
			array(
				'settings'        => 'modern_ecommerce_change_language',
				'section'         => 'modern_ecommerce_top',
				'label'           => __( 'Show Language Translator', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_change_language', array(
		'selector' => '.g-translate',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_change_language',
	) );
	$wp_customize->add_setting(
		'modern_ecommerce_change_usd',
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
			'modern_ecommerce_change_usd',
			array(
				'settings'        => 'modern_ecommerce_change_usd',
				'section'         => 'modern_ecommerce_top',
				'label'           => __( 'Show Currency Switcher', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_change_usd', array(
		'selector' => '.dropdown',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_change_usd',
	) );
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'modern_ecommerce_myaccount_show_hide',
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
				'modern_ecommerce_myaccount_show_hide',
				array(
					'settings'        => 'modern_ecommerce_myaccount_show_hide',
					'section'         => 'modern_ecommerce_top',
					'label'           => __( 'Show My Account', 'modern-ecommerce' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'modern-ecommerce' ),
						'off'    => __( 'Off', 'modern-ecommerce' ),
					),
					'active_callback' => '',
				)
			)
		);
	}
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_myaccount_show_hide', array(
		'selector' => '.options',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_myaccount_show_hide',
	) );
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'modern_ecommerce_cart_show_hide',
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
				'modern_ecommerce_cart_show_hide',
				array(
					'settings'        => 'modern_ecommerce_cart_show_hide',
					'section'         => 'modern_ecommerce_top',
					'label'           => __( 'Show Cart', 'modern-ecommerce' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'modern-ecommerce' ),
						'off'    => __( 'Off', 'modern-ecommerce' ),
					),
					'active_callback' => '',
				)
			)
		);
	}
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_cart_show_hide', array(
		'selector' => '.cart',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_cart_show_hide',
	) );
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting(
			'modern_ecommerce_product_search_show_hide',
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
				'modern_ecommerce_product_search_show_hide',
				array(
					'settings'        => 'modern_ecommerce_product_search_show_hide',
					'section'         => 'modern_ecommerce_top',
					'label'           => __( 'Show Product Search', 'modern-ecommerce' ),				
					'choices'		  => array(
						'1'      => __( 'On', 'modern-ecommerce' ),
						'off'    => __( 'Off', 'modern-ecommerce' ),
					),
					'active_callback' => '',
				)
			)
		);
	}
    $wp_customize->add_setting('modern_ecommerce_top_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_top_text',array(
		'label' => esc_html__('Add Announcement Text','modern-ecommerce'),
		'section' => 'modern_ecommerce_top',
		'setting' => 'modern_ecommerce_top_text',
		'type'    => 'text'
	));
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_top_text', array(
		'selector' => '.bull-icon',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_top_text',
	) );
	$wp_customize->add_setting('modern_ecommerce_offer_icon',array(
		'default'	=> 'fas fa-bullhorn',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
        $wp_customize,'modern_ecommerce_offer_icon',array(
		'label'	=> __('Add Topbar Offer Icon','modern-ecommerce'),
		'transport' => 'refresh',
		'section'	=> 'modern_ecommerce_top',
		'setting'	=> 'modern_ecommerce_offer_icon',
		'type'		=> 'icon'
	)));	
    $wp_customize->add_setting('modern_ecommerce_wishlist',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_wishlist',array(
		'label' => esc_html__('Add  Wishlist Text','modern-ecommerce'),
		'section' => 'modern_ecommerce_top',
		'setting' => 'modern_ecommerce_wishlist',
		'type'    => 'text'
	));
    $wp_customize->add_setting('modern_ecommerce_wishlist_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('modern_ecommerce_wishlist_url',array(
		'label' => esc_html__('Add URL','modern-ecommerce'),
		'section' => 'modern_ecommerce_top',
		'setting' => 'modern_ecommerce_wishlist_url',
		'type'    => 'url'
	));
    $wp_customize->add_setting('modern_ecommerce_regiter',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_regiter',array(
		'label' => esc_html__('Add  Register/signin Text','modern-ecommerce'),
		'section' => 'modern_ecommerce_top',
		'setting' => 'modern_ecommerce_regiter',
		'type'    => 'text'
	));
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_regiter', array(
		'selector' => '.options a',
		'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_regiter',
	) );
    $wp_customize->add_setting('modern_ecommerce_regiter_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('modern_ecommerce_regiter_url',array(
		'label' => esc_html__('Add URL','modern-ecommerce'),
		'section' => 'modern_ecommerce_top',
		'setting' => 'modern_ecommerce_regiter_url',
		'type'    => 'url'
	));

    //Slider
	$wp_customize->add_section( 'modern_ecommerce_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'modern-ecommerce' ),    	
		'priority'   => 3,
		'panel' => 'modern_ecommerce_custompage_panel',
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_slide_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_slide_heading', array(
			'label'       => esc_html__( 'Slider Settings', 'modern-ecommerce' ),
			'description' => __('Slider Image Dimension ( 600px x 700px )','modern-ecommerce'),		
			'section'     => 'modern_ecommerce_slider_section',
			'settings'    => 'modern_ecommerce_section_slide_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_slider_arrows',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_slider_arrows',
			array(
				'settings'        => 'modern_ecommerce_slider_arrows',
				'section'         => 'modern_ecommerce_slider_section',
				'label'           => __( 'Check To show Slider', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$pst_sls[]= __('Select','modern-ecommerce');
	foreach ($post_list as $key => $p_post) {
		$pst_sls[$p_post->ID]=$p_post->post_title;
	}
	for ( $i = 1; $i <= 4; $i++ ) {
		$wp_customize->add_setting('modern_ecommerce_post_setting'.$i,array(
			'sanitize_callback' => 'modern_ecommerce_sanitize_select',
		));
		$wp_customize->add_control('modern_ecommerce_post_setting'.$i,array(
			'type'    => 'select',
			'choices' => $pst_sls,
			'label' => __('Select post','modern-ecommerce'),
			'section' => 'modern_ecommerce_slider_section',
			'active_callback' => 'modern_ecommerce_slider_dropdown',
		));
		$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_post_setting'.$i, array(
			'selector' => '.slide-content',
			'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_post_setting'.$i,
		) );
	}
	wp_reset_postdata();

	$wp_customize->add_setting(
		'modern_ecommerce_slider_excerpt_show_hide',
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
			'modern_ecommerce_slider_excerpt_show_hide',
			array(
				'settings'        => 'modern_ecommerce_slider_excerpt_show_hide',
				'section'         => 'modern_ecommerce_slider_section',
				'label'           => __( 'Show Hide excerpt', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => 'modern_ecommerce_slider_dropdown',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_slider_excerpt_count',array(
		'default'=> 20,
		'transport' => 'refresh',
		'sanitize_callback' => 'modern_ecommerce_sanitize_integer'
	));
	$wp_customize->add_control(new Modern_Ecommerce_Slider_Custom_Control( $wp_customize, 'modern_ecommerce_slider_excerpt_count',array(
		'label' => esc_html__( 'Excerpt Limit','modern-ecommerce' ),
		'section'=> 'modern_ecommerce_slider_section',
		'settings'=>'modern_ecommerce_slider_excerpt_count',
		'input_attrs' => array(
			'reset'			   => 20,
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
        'active_callback' => 'modern_ecommerce_slider_dropdown',
	)));
	$wp_customize->add_setting(
		'modern_ecommerce_slider_button_show_hide',
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
			'modern_ecommerce_slider_button_show_hide',
			array(
				'settings'        => 'modern_ecommerce_slider_button_show_hide',
				'section'         => 'modern_ecommerce_slider_section',
				'label'           => __( 'Show Hide Button', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => 'modern_ecommerce_slider_dropdown',
			)
		)
	);
	$wp_customize->add_setting('modern_ecommerce_slider_read_more',array(
		'default' => 'Shop Now',
		'sanitize_callback' => 'sanitize_text_field'
	)); 
	$wp_customize->add_control('modern_ecommerce_slider_read_more',array(
		'label' => esc_html__('Button Text','modern-ecommerce'),
		'section' => 'modern_ecommerce_slider_section',
		'setting' => 'modern_ecommerce_slider_read_more',
		'type'    => 'text',
		'active_callback' => 'modern_ecommerce_slider_dropdown',
	));

	$wp_customize->add_setting( 'modern_ecommerce_slider_content_alignment',
		array(
			'default' => 'LEFT-ALIGN',
			'transport' => 'refresh',
			'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Text_Radio_Button_Custom_Control( $wp_customize, 'modern_ecommerce_slider_content_alignment',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Slider Content Alignment', 'modern-ecommerce' ),
			'section' => 'modern_ecommerce_slider_section',
			'choices' => array(
				'LEFT-ALIGN' => __('LEFT','modern-ecommerce'),
	            'CENTER-ALIGN' => __('CENTER','modern-ecommerce'),
	            'RIGHT-ALIGN' => __('RIGHT','modern-ecommerce'),
			),
			'active_callback' => 'modern_ecommerce_slider_dropdown',
		)
	) );

	// Services Section
	$wp_customize->add_section( 'modern_ecommerce_service_box_section' , array(
    	'title'      => __( 'Services Settings', 'modern-ecommerce' ),
		'priority'   => 4,
		'panel' => 'modern_ecommerce_custompage_panel',
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_services_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_services_heading', array(
			'label'       => esc_html__( ' Services Settings', 'modern-ecommerce' ),	
			'section'     => 'modern_ecommerce_service_box_section',
			'settings'    => 'modern_ecommerce_section_services_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_service_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_service_show_hide',
			array(
				'settings'        => 'modern_ecommerce_service_show_hide',
				'section'         => 'modern_ecommerce_service_box_section',
				'label'           => __( 'Check To show Section', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);

	$wp_customize->add_setting('modern_ecommerce_service_number',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('modern_ecommerce_service_number',array(
		'label'	=> __('Number of posts to show in a category','modern-ecommerce'),
		'section' => 'modern_ecommerce_service_box_section',
		'type'	  => 'number',
		'active_callback' => 'modern_ecommerce_service_dropdown',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}
	$wp_customize->add_setting('modern_ecommerce_category_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'modern_ecommerce_sanitize_select',
	));
	$wp_customize->add_control('modern_ecommerce_category_setting',array(
		'type'    => 'select',
		'choices' => $cat_pst,
		'label' => esc_html__('Select Category to display Post','modern-ecommerce'),
		'section' => 'modern_ecommerce_service_box_section',
		'active_callback' => 'modern_ecommerce_service_dropdown',
	));

	$modern_ecommerce_category_number = get_theme_mod('modern_ecommerce_service_number','');
	for ($i=1; $i <= $modern_ecommerce_category_number; $i++) {
	    
	    $wp_customize->add_setting('modern_ecommerce_service_icon'.$i,array(
			'default'	=> 'fas fa-truck',
			'sanitize_callback'	=> 'sanitize_text_field'
		));	
		$wp_customize->add_control(new Modern_Ecommerce_Fontawesome_Icon_Chooser(
	        $wp_customize,'modern_ecommerce_service_icon'.$i,array(
			'label'	=> __('date Icon','modern-ecommerce').$i,
			'transport' => 'refresh',
			'section'	=> 'modern_ecommerce_service_box_section',
			'setting'	=> 'modern_ecommerce_service_icon',
			'type'		=> 'icon',
			'active_callback' => 'modern_ecommerce_service_dropdown',
		)));
	}

	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_category_setting', array(
	  'selector' => '.services-box',
	  'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_category_setting',
	) );

	// Product Box
	$wp_customize->add_section( 'modern_ecommerce_product_box_section' , array(
    	'title'      => __( 'Product Settings', 'modern-ecommerce' ),
		'priority'   => 5,
		'panel' => 'modern_ecommerce_custompage_panel',
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_product_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_product_heading', array(
			'label'       => esc_html__( 'Product Settings', 'modern-ecommerce' ),
			'section'     => 'modern_ecommerce_product_box_section',
			'settings'    => 'modern_ecommerce_section_product_heading',
	) ) );
	$wp_customize->add_setting(
		'modern_ecommerce_product_show_hide',
		array(
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'theme_supports'       => '',
			'default'              => '',
			'transport'            => 'refresh',
			'sanitize_callback'    => 'modern_ecommerce_callback_sanitize_switch',
		)
	);
	$wp_customize->add_control(
		new Modern_Ecommerce_Customizer_Customcontrol_Switch(
			$wp_customize,
			'modern_ecommerce_product_show_hide',
			array(
				'settings'        => 'modern_ecommerce_product_show_hide',
				'section'         => 'modern_ecommerce_product_box_section',
				'label'           => __( 'Check To show Section', 'modern-ecommerce' ),				
				'choices'		  => array(
					'1'      => __( 'On', 'modern-ecommerce' ),
					'off'    => __( 'Off', 'modern-ecommerce' ),
				),
				'active_callback' => '',
			)
		)
	);
    $wp_customize->add_setting('modern_ecommerce_product_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_product_title',array(
		'label'	=> esc_html__('Section Title','modern-ecommerce'),
		'section'	=> 'modern_ecommerce_product_box_section',
		'type'		=> 'text',
		'active_callback' => 'modern_ecommerce_product_dropdown',
	));
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_product_title', array(
	  'selector' => '.prod_head',
	  'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_product_title',
	) );
    $wp_customize->add_setting('modern_ecommerce_product_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_product_text',array(
		'label'	=> esc_html__('Section Text','modern-ecommerce'),
		'section'	=> 'modern_ecommerce_product_box_section',
		'type'		=> 'text',
		'active_callback' => 'modern_ecommerce_product_dropdown',
	));
	$modern_ecommerce_args = array(
		'type'                     => 'product',
		'child_of'                 => 0,
		'parent'                   => '',
		'orderby'                  => 'term_group',
		'order'                    => 'ASC',
		'hide_empty'               => false,
		'hierarchical'             => 1,
		'number'                   => '',
		'taxonomy'                 => 'product_cat',
		'pad_counts'               => false
	);
	$categories = get_categories($modern_ecommerce_args);
	$cat_posts = array();
	$m = 0;
	$cat_posts[]='Select';
	foreach($categories as $category){
	if($m==0){
		$default = $category->slug;
			$m++;
		}
		$cat_posts[$category->slug] = $category->name;
	}
	$wp_customize->add_setting('modern_ecommerce_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'modern_ecommerce_sanitize_select',
	));
	$wp_customize->add_control('modern_ecommerce_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select category to display products ','modern-ecommerce'),
		'section' => 'modern_ecommerce_product_box_section',
		'active_callback' => 'modern_ecommerce_product_dropdown'
	));
	$wp_customize->add_setting('modern_ecommerce_category_number',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('modern_ecommerce_category_number',array(
		'label'	=> __('Number of posts to show in a category','modern-ecommerce'),
		'section' => 'modern_ecommerce_product_box_section',
		'type'	  => 'number',
		'active_callback' => 'modern_ecommerce_product_dropdown',
	));

	//Footer
    $wp_customize->add_section( 'modern_ecommerce_footer_copyright', array(
    	'title'      => esc_html__( 'Footer Text', 'modern-ecommerce' ),
    	'priority' => 6,
    	'panel' => 'modern_ecommerce_custompage_panel',
	) );
	$wp_customize->add_setting( 'modern_ecommerce_section_footer_heading', array(
		'default'           => '',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new Modern_Ecommerce_Customizer_Customcontrol_Section_Heading( $wp_customize, 'modern_ecommerce_section_footer_heading', array(
		'label'       => esc_html__( 'Footer Settings', 'modern-ecommerce' ),		
		'section'     => 'modern_ecommerce_footer_copyright',
		'settings'    => 'modern_ecommerce_section_footer_heading',
		'priority' => 1,
	) ) );
    $wp_customize->add_setting('modern_ecommerce_footer_text',array(
		'default'	=> 'Ecommerce WordPress Theme',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('modern_ecommerce_footer_text',array(
		'label'	=> esc_html__('Copyright Text','modern-ecommerce'),
		'section'	=> 'modern_ecommerce_footer_copyright',
		'type'		=> 'textarea'
	));
	$wp_customize->selective_refresh->add_partial( 'modern_ecommerce_footer_text', array(
	  'selector' => '.site-info',
	  'render_callback' => 'modern_ecommerce_customize_partial_modern_ecommerce_footer_text',
	) );
	$wp_customize->add_setting( 'modern_ecommerce_footer_content_alignment',
		array(
			'default' => 'CENTER-ALIGN',
			'transport' => 'refresh',
			'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Text_Radio_Button_Custom_Control( $wp_customize, 'modern_ecommerce_footer_content_alignment',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Footer Content Alignment', 'modern-ecommerce' ),
			'section' => 'modern_ecommerce_footer_copyright',
			'choices' => array(
				'LEFT-ALIGN' => __('LEFT','modern-ecommerce'),
	            'CENTER-ALIGN' => __('CENTER','modern-ecommerce'),
	            'RIGHT-ALIGN' => __('RIGHT','modern-ecommerce'),
			),
			'active_callback' => '',
		)
	) );
	$wp_customize->add_setting( 'modern_ecommerce_footer_widget',
		array(
			'default' => '4',
			'transport' => 'refresh',
			'sanitize_callback' => 'modern_ecommerce_sanitize_choices'
		)
	);
	$wp_customize->add_control( new Modern_Ecommerce_Text_Radio_Button_Custom_Control( $wp_customize, 'modern_ecommerce_footer_widget',
		array(
			'type' => 'select',
			'label' => esc_html__('Footer Per Column','modern-ecommerce'),
			'section' => 'modern_ecommerce_footer_copyright',
			'choices' => array(
				'1' => __('1','modern-ecommerce'),
	            '2' => __('2','modern-ecommerce'),
	            '3' => __('3','modern-ecommerce'),
	            '4' => __('4','modern-ecommerce'),
			)
		)
	) );
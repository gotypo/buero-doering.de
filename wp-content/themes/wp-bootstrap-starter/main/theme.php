<?php



/**********************************
 *
 * 	PAGE SPEED
 *
 ***********************************/


// deregister dashicons

// remove dashicons in frontend to non-admin 
    function wpdocs_dequeue_dashicon() {
        if (current_user_can( 'update_core' )) {
            return;
        }
        wp_deregister_style('dashicons');
    }
    add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );


/**********************************
 *
 * 	IMAGES
 *
 ***********************************/



// REMOVE DEFAULT IMAGES



// ADD IMAGE SIZES

add_theme_support( 'post-thumbnails' );




add_filter( 'intermediate_image_sizes_advanced', 'prefix_remove_default_images' );
function prefix_remove_default_images( $sizes ) {

    unset( $sizes['small']); // 150px
    unset( $sizes['medium']); // 300px
    unset( $sizes['large']); // 1024px
    unset( $sizes['medium_large']); // 768px

    return $sizes;
}


add_image_size( 'square_small', 400, 400, true );
add_image_size( 'square', 800, 800, true );

add_action('init', 'remove_extra_image_sizes');
function remove_extra_image_sizes() {
    foreach ( get_intermediate_image_sizes() as $size ) {
        if ( !in_array( $size, array( 'thumbnail', 'medium', 'square', 'square_small' ) ) ) {
            remove_image_size( $size );
        }
    }
}






add_filter( 'genesis_search_text', 'gen_search_text' );
function gen_search_text( $text ) {
    return esc_attr( __( 'Suche', 'genesis' ));
}





/**********************************
 *
 * 	WIDGETS
 *
 ***********************************/

// Adds support for after entry widget.
//add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
//add_theme_support( 'genesis-footer-widgets', 3 );

genesis_register_sidebar(
	array(
		'id' => 'headersearch',
		'name' => __( 'Header Search', 'genesis' ),
		'description' => __( 'Custom Widget Area', 'childtheme' ),
	)
);
/*
genesis_register_sidebar(
	array(
		'id' => 'footertext',
		'name' => __( 'Footer Text', 'genesis' ),
		'description' => __( 'Custom Footertext', 'childtheme' ),
		'before_widget' => '<div class="footeritem footeritem-2">',
		'after_widget' => '</div>',
	)
);
genesis_register_sidebar(
	array(
		'id' => 'contact-th',
		'name' => __( 'Kontakt Thüringen', 'genesis' ),
		'description' => __( 'Contact Thüringen', 'childtheme' ),
		'before_widget' => '<div class="teaser-container contact">',
		'after_widget' => '</div>',
	)
);
genesis_register_sidebar(
	array(
		'id' => 'contact-sa',
		'name' => __( 'Kontakt Sachsen-Anhalt', 'genesis' ),
		'description' => __( 'Custom Footertext', 'childtheme' ),
		'before_widget' => '<div class="teaser-container contact">',
		'after_widget' => '</div>',
	)
);*/


/**********************************
 *
 * 	REMOVE WIDGETS
 *
 ***********************************/

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );



/**********************************
 *
 *  GUTENBERG
 *
 ***********************************/

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}


/**********************************
 *
 * 	CLEANING
 *
 ***********************************/


// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );


add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	return $config;

}

/**********************************
 *
 * 	CUSTOMIZER
 *
 ***********************************/


// Adds custom logo in Customizer > Site Identity.
/*add_theme_support(
	'custom-logo', array(
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	)
);*/


/*

add_action( 'customize_register', 'theme_customize_register' );

function theme_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'theme_awo_options',
	    array(
            'title'          => __( 'AWO Settings', 'awo' ),
        )
    );

    // title 1
    $wp_customize->add_setting( 'theme_awo_title1_setting',
	    array(
            'default'        => ''
        )
    );
    $wp_customize->add_control( 'theme_awo_title1',
	    array(
		    'label' => __( 'Titel (z.B. Kindergärten)', 'awo' ),
		    'section' => 'theme_awo_options',
		    'type' => 'text',
		    'settings' => 'theme_awo_title1_setting'
	    )
    );

	// title 2
	$wp_customize->add_setting( 'theme_awo_title2_setting',
	    array(
            'default'        => ''
        )
	);
    $wp_customize->add_control( 'theme_awo_title2',
	    array(
		    'label' => __( 'Titel (z.B. in Altenburg)', 'awo' ),
		    'section' => 'theme_awo_options',
		    'type' => 'text',
		    'settings' => 'theme_awo_title2_setting'
	    )
    );

	// matomo-id
	$wp_customize->add_setting( 'theme_awo_matomo_setting',
	    array(
            'default'        => ''
        )
	);
    $wp_customize->add_control( 'theme_awo_matomo',
	    array(
		    'label' => __( 'Matomo-Id', 'awo' ),
		    'section' => 'theme_awo_options',
		    'type' => 'number',
		    'settings' => 'theme_awo_matomo_setting'
	    )
    );

}
*/






?>
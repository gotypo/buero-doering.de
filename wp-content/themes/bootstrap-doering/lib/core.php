<?php


// theme support HTML5

add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);



add_action( 'genesis_setup', 'bfg_core_setup', 20 );

function bfg_core_setup() {


    // Start the engine
	//include_once( get_template_directory() . '/lib/init.php' );


	// Child theme (do not remove)
	/*define( 'BFG_THEME_NAME', 'Bootstrap for Genesis' );
	//define( 'BFG_THEME_URL', 'http://webdevsuperfast.github.io/' );
	define( 'BFG_THEME_LIB', CHILD_DIR . '/lib/' );
	define( 'BFG_THEME_LIB_URL', CHILD_URL . '/lib/' );
	define( 'BFG_THEME_IMAGES', CHILD_URL . '/images/' );
	define( 'BFG_THEME_JS', CHILD_URL . '/assets/js/' );
	define( 'BFG_THEME_CSS', CHILD_URL . '/assets/css/' );
	define( 'BFG_THEME_MODULES', CHILD_DIR . '/lib/modules/' );
*/
	// Cleanup WP Head
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Add HTML5 markup structure
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );


		// Add viewport meta tag for mobile browsers
		add_theme_support( 'genesis-responsive-viewport' );


		// Custom Logo
		add_theme_support( 'custom-logo', array(
			'flex-width' => true,
			'flex-height' => true
		) );

		// Structural Wraps
		add_theme_support( 'genesis-structural-wraps', array(
			'site-inner',
			'footer-widgets',
			'footer',
			'home-featured',
			'nav'
		) );

        // WooCommerce Support
		//add_theme_support( 'genesis-connect-woocommerce' );


        /*
         *      SIDEBARS
         *
         *************************/

		// Remove unneeded widget areas
		unregister_sidebar( 'header-right' );

        //* Unregister primary sidebar
        unregister_sidebar( 'sidebar' );

        //* Unregister secondary sidebar
        unregister_sidebar( 'sidebar-alt' );

        // Register new sidebar for footer
        genesis_register_sidebar( array(
            'id'          => 'footer-sidebar',
            'name'        => 'Footer',
            'description' => 'This is the sidebar for the address.',
        ) );




        // REMOVE WP EMOJI
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');

        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );


		// Remove Gallery CSS
		add_filter( 'use_default_gallery_style', '__return_false' );

		// Add Shortcode Functionality to Text Widgets
		add_filter( 'widget_text', 'shortcode_unautop' );
		add_filter( 'widget_text', 'do_shortcode' );

		// Move Featured Image
		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		add_action( 'genesis_entry_header',  'genesis_do_post_image', 0 );

		// Custom Image Size
		add_image_size( 'doering-keyvisual', 1800, 355, true );
        add_image_size( 'doering-gallery', 600, 390, true );
        add_image_size( 'doering-slider', 800, 630, true );

		// Add Accessibility support
		add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form') );


// Load Child theme text domain
		load_child_theme_textdomain( 'bootstrap-for-genesis', get_stylesheet_directory() . '/languages' );

}




/*-------------------
	REMOVE TITLE
---------------------*/

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );







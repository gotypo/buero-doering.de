<?php


/**********************************
 *
 * 	OUTPUT
 *
 ***********************************/




/**********************************
 *
 * 	FONTS
 *
 ***********************************/

/*
wp_enqueue_style(
	'custom-fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700', array()
);
wp_enqueue_style(
	'custom-fonts-2', '//fonts.googleapis.com/css?family=Playfair+Display:400,700', array()
);
*/

/**********************************
 *
 * 	CSS + JS
 *
 ***********************************/



add_action('wp_enqueue_scripts', 'custom_style_sheet');
function custom_style_sheet() {
    /*wp_enqueue_style( 'dashicons' );*/
    wp_enqueue_style( 'css-custom', get_stylesheet_directory_uri() . '/css/custom.css' );
    wp_enqueue_style( 'css-elements', get_stylesheet_directory_uri() . '/css/elements.css' );
   /* wp_enqueue_style( 'css-fontawesome', get_stylesheet_directory_uri() . '/lib/fontawesome/css/all.css' );*/
}


add_action( 'wp_enqueue_scripts', 'my_javascripts' );
function my_javascripts() {
    wp_enqueue_script( 'js-script', get_stylesheet_directory_uri() . '/js/script.js', '', '', true);
}



/**********************************
 *
 *  REMOVE RSS
 *
 ***********************************/

add_action( 'init', 'disable_wp_rssfeed' );
function disable_wp_rssfeed() {

    /*
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'rsd_link' );
    */

    /*
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
    remove_action( 'wp_head', 'wp_generator' );
    */
}

//
///**********************************
// *
// * 	REMOVE EMOJICONS
// *
// ***********************************/
//
//add_action( 'init', 'disable_wp_emojicons' );
//function disable_wp_emojicons() {
//
//    remove_action( 'admin_print_styles', 'print_emoji_styles' );
//    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
//    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
//    remove_action( 'wp_print_styles', 'print_emoji_styles' );
//    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
//
//    add_filter( 'emoji_svg_url', '__return_false' );
//}
//
//
//


?>
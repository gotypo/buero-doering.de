<?php


/**********************************
 *
 * 	BOOTSTRAP
 *
 ***********************************/


// Theme Scripts & Stylesheet
add_action( 'wp_enqueue_scripts', 'gb_deregister_scripts' );
function gb_deregister_scripts() {

    wp_deregister_script( 'superfish' );
    wp_deregister_script( 'superfish-args' );
    //wp_deregister_script( 'jquery' );

}


/**********************************
 *
 * 	CSS + JS
 *
 ***********************************/

add_action('wp_enqueue_scripts', 'custom_style_sheet', 1);
function custom_style_sheet() {

    wp_enqueue_style( 'css-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
//	wp_enqueue_style( 'css-fontawesome', get_stylesheet_directory_uri() . '/assets/css/fontawesome.min.css' );
	wp_enqueue_style( 'css-animate', get_stylesheet_directory_uri() . '/assets/css/animate.min.css' );
	wp_enqueue_style( 'css-klaro', get_stylesheet_directory_uri() . '/assets/css/klaro.min.css' );
	wp_enqueue_style( 'css-icons', '/wp-content/themes/bootstrap-doering/assets/icons/material-icons.css' );
	wp_enqueue_style( 'css-fonts', get_stylesheet_directory_uri() . '/assets/fonts/fonts.css' );
//	wp_enqueue_style( 'css-fonts', 'https://use.typekit.net/xxa2ups.css' );
    wp_enqueue_style( 'wp-block-library', '/wp-includes/css/dist/block-library/style.min.css' );
    wp_enqueue_style( 'css-custom', get_stylesheet_directory_uri() . '/assets/css/custom.css' );
}


add_action( 'wp_enqueue_scripts', 'my_javascripts', 1);
function my_javascripts() {

    wp_enqueue_script( 'js-jquery', get_stylesheet_directory_uri() . '/assets/js/jquery-3.6.0.min.js', '', '', false);
    wp_enqueue_script( 'js-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true);
    wp_enqueue_script( 'js-popper', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', '', '', true);
	wp_enqueue_script( 'js-klaro-config', get_stylesheet_directory_uri() . '/assets/js/klaro-config.js', '', '', true);
	wp_enqueue_script( 'js-klaro-min', get_stylesheet_directory_uri() . '/assets/js/klaro.js', '', '', true);
    wp_enqueue_script( 'js-script', get_stylesheet_directory_uri() . '/assets/js/script.js', '', '', true);
}




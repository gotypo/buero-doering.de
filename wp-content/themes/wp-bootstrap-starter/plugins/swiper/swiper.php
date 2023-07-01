<?php


/**********************************
  *
  * 	SWIPER
  *
 ***********************************/

add_action( 'wp_enqueue_scripts', 'my_swiper' );
function my_swiper() {
	wp_enqueue_style( 'css-swiper', get_stylesheet_directory_uri() . '/plugins/swiper/swiper.min.css' );
    wp_enqueue_script( 'js-swiper', get_stylesheet_directory_uri() . '/plugins/swiper/swiper.min.js', '', '', true);
}




?>
<?php


/**********************************
  *
  * 	SWIPER
  *
 ***********************************/

add_action( 'wp_enqueue_scripts', 'my_swiper' );
function my_swiper() {
	wp_enqueue_style( 'css-swiper', get_stylesheet_directory_uri() . '/lib/modules/swiper/8.4.7/swiper-bundle.min.css' );
    wp_enqueue_script( 'js-swiper', get_stylesheet_directory_uri() . '/lib/modules/swiper/8.4.7/swiper-bundle.min.js', '', '', true);
}




?>
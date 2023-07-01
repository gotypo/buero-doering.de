<?php


/**********************************
  *
  * 	LEAFLET
  *
 ***********************************/


function my_leaflet() {
	wp_enqueue_style( 'css-leaflet', get_stylesheet_directory_uri() . '/lib/modules/leaflet/leaflet.css' );
    wp_enqueue_script( 'js-leaflet', get_stylesheet_directory_uri() . '/lib/modules/leaflet/leaflet.js' );
}
add_action( 'wp_enqueue_scripts', 'my_leaflet' );





?>
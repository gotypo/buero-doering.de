<?php


/**********************************
  *
  * 	WAYPOINTS
  *
 ***********************************/

add_action( 'wp_enqueue_scripts', 'my_waypoints' );
function my_waypoints() {
    wp_enqueue_script( 'js-waypoints', get_stylesheet_directory_uri() . '/lib/modules/waypoints/lib/jquery.waypoints.min.js', '', '', true);
}




?>
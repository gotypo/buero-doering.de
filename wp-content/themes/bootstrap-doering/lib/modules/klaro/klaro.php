<?php


/**********************************
  *
  * 	KLARO
  *
 ***********************************/


//global $wp_query;
//$postID = $wp_query->post->ID;

//print_r ('--'.$postID);

function my_klaro() {
	wp_enqueue_style( 'css-klaro', get_stylesheet_directory_uri() . '/lib/modules/klaro/style.css' );
    wp_enqueue_script( 'js-klaro-config', get_stylesheet_directory_uri() . '/lib/modules/klaro/config.js' );
    wp_enqueue_script( 'js-klaro', get_stylesheet_directory_uri() . '/lib/modules/klaro/klaro.js' );
}
//if($currentID != 56) {
//    add_action( 'wp_enqueue_scripts', 'my_klaro' );
//}
//
//function add_matomo_to_head_js() {
//    $out = '<script type="text/plain" data-type="application/javascript" data-name="matomo">
//
//        </script>';
//    echo $out;
//}
//add_action( 'wp_head', 'add_matomo_to_head_js' );

?>
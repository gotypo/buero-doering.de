<?php


/**********************************
 *
 * 	FSELECT
 *
 ***********************************/


function my_fselect() {
    wp_enqueue_style( 'css-fselect', get_stylesheet_directory_uri() . '/lib/modules/fselect/fselect.css' );
    wp_enqueue_script( 'js-fselect', get_stylesheet_directory_uri() . '/lib/modules/fselect/fselect.js', '', '', true);
}
add_action( 'wp_enqueue_scripts', 'my_fselect' );



?>
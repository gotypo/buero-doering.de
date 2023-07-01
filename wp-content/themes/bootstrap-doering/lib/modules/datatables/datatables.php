<?php


/**********************************
 *
 * 	DATATABLES
 *
 ***********************************/


function my_datatables() {
    wp_enqueue_style( 'css-datatables', get_stylesheet_directory_uri() . '/lib/modules/datatables/datatables.min.css' );
    wp_enqueue_script( 'js-datatables', get_stylesheet_directory_uri() . '/lib/modules/datatables/datatables.min.js', '', '', true);
}
add_action( 'wp_enqueue_scripts', 'my_datatables' );



?>
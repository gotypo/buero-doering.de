<?php



/*-------------------
	GET FEATUREIMAGE
---------------------*/

add_action( 'genesis_before_content', 'themeprefix_featured_image', 30 );
function themeprefix_featured_image() {

    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


    $image = genesis_get_image( array( // more options here -> genesis/lib/functions/image.php
        'format'  => 'url',
        'size'    => $size,
        'context' => '',
        'fallback' => '',
        'attr'    => array ( 'class' => 'doering-keyvisual' ),
    ) );

    $title = get_the_title();

    if (is_single() || is_category() || is_search()) {
        $image = '/wp-content/uploads/2020/10/default-keyvisual.jpg';
    }

    if ( $image ) {
        $out = '<div class="keyvisual"><div class="container"><img src="'.$image.'" class="img-fluid" /></div></div>';
    }



    print ($out);


}


?>
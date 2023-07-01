<?php


/**********************************
  *
  * 	FANCYBOX
  *
 ***********************************/


function my_fancybox() {
	wp_enqueue_style( 'css-fancybox', get_stylesheet_directory_uri() . '/lib/modules/fancybox/jquery.fancybox.min.css' );
    wp_enqueue_script( 'js-fancybox', get_stylesheet_directory_uri() . '/lib/modules/fancybox/jquery.fancybox.min.js', '', '', true);
}
add_action( 'wp_enqueue_scripts', 'my_fancybox' );



add_filter('the_content', 'aggiungi_fancybox');

function aggiungi_fancybox($content) {
    global $post;
    $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
    $replacement = '<a$1href=$2$3.$4$5 data-fancybox="gallery" title="'.$post->post_title.'"$6>';
    $replacement = '<a$1href=$2$3.$4$5 title="'.$post->post_title.'"$6>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}



?>
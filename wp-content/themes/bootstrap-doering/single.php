<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */






remove_action( 'genesis_loop', 'genesis_do_loop' );


add_action( 'genesis_loop', 'get_single' );
function get_single() {



    $currentID = get_the_ID();
    $args = array('p'=>$currentID, 'post_type'=>'', 'posts_per_page'=> '1');
    $loop = new WP_Query($args);
    $author_id = get_post_field('post_author', $currentID);
    $display_name = get_the_author_meta( 'display_name' , $author_id );
    $avatarSrc = get_avatar_url($author_id);
    $copyright = get_field('photocredits');
    $categories = get_the_category();
    $categoryClasses = "";

    foreach($categories as $category => $value) {
        $categoryClasses .= " category-".$value->slug;
    }

    $loop->the_post();

    $out = '<div class="single-image">'.get_the_post_thumbnail( $loop->post->ID, 'full', array( 'class' => 'alignleft' ) ).'';

    if($copyright) {
        $out .= '<div class="copyright" data-copyright-text="'.$copyright.'"><span>&copy;</span>'.$copyright.'</div>';
    }

    $out .= '</div>';
    $out .= '<div class="element"><div class="element-inside">';
    $out .= '<div class="news-single blog-single">';

    $out .= '<div class="p-center">';

    $out .= '<div class="row">';
    $out .= '<div class="col-md-9">';
    $out .= '<h1>'.$loop->post->post_title.'</h1>';
    $out .= '</div>';

    $out .= '<div class="col-md-3">';   
    $out .= '<div class="author-info py-3 '.$categoryClasses.'">';
    $out .= '<h3 class="writtenBy w-100">von:</h3>';
    $out .= '<img src="'.$avatarSrc.'" width="80" height="80" class="avatar rounded-circle " alt="'.$display_name.'" />';
    $out .= '<span class="px-3"><b>'.$display_name.'</b></span>';
    $out .= '</div>';
    $out .= '</div>';

    $out .= '</div>';

    $out .= '<div class="text">'.apply_filters( 'the_content', get_post_field('post_content', $currentID ) ).'</div>';

   /* $out .= '<div class="image">';
    $out .= get_the_post_thumbnail( $currentID, 'blog-preview', array( 'class' => 'single' ) );
    if (get_the_post_thumbnail_caption($currentID)) {
        $out .= '<div class="caption">'.get_the_post_thumbnail_caption($currentID).'</div>';
    }
    $out .= '</div>';*/

    $out .= '</div>';
    $out .= '<div class="clearfix"></div>';

    $out .= '</div>';

    $out .= '<hr />';
    $out .= '<a href="#" onClick="javascript:history.back(); return false;" class="btn">zurück</a>';

    $out .= '</div></div>';


    echo $out;


}


/*
add_action( 'genesis_loop', 'get_single_comments' );
function get_single_comments() {
    comment_form();
}*/

// This file handles single entries, but only exists for the sake of child theme forward compatibility.
genesis();



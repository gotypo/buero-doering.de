<?php
/*
Plugin Name: Press
Plugin URI: http://www.gotypo.de
Description: A pluginto manage Press
Version: 1.2
Author: Christian Franke
Author URI: http://www.gotypo.de
License: GPL2
*/


function my_custom_post_Press() {
    $labels = array(
        'name'               => _x( 'Pressebereiche', 'post type general name' ),
        'singular_name'      => _x( 'Pressebereiche', 'post type singular name' ),
        'add_new'            => _x( 'Neuer Pressebereich', 'Press' ),
        'add_new_item'       => __( 'Neuer Pressebereich' ),
        'edit_item'          => __( 'Pressebereich bearbeiten' ),
        'new_item'           => __( 'Neuer Pressebereich' ),
        'all_items'          => __( 'Alle Pressebereich' ),
        'view_item'          => __( 'Press Pressebereich' ),
        'search_items'       => __( 'Pressebereich Suchen' ),
        'not_found'          => __( 'No Pressebereich found' ),
        'not_found_in_trash' => __( 'No Pressebereich found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Pressebereiche'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our Press specific data',
        'public'        => true,
        'menu_position' => 8,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-admin-document',
        'taxonomies' => array( 'category' ),
    );
    register_post_type( 'Press', $args );
}
add_action( 'init', 'my_custom_post_Press' );

/*
 function tr_create_my_taxonomy() {

     register_taxonomy(
         'profile-category',
         'profile',
         array(
             'label' => __( 'Category' ),
             'rewrite' => array( 'slug' => 'profile-category' ),
             'hierarchical' => true,
         )
     );
 }
 add_action( 'init', 'tr_create_my_taxonomy' );
*/



/* function my_taxonomies_profile() {

      $args = array();
      register_taxonomy( 'profile_category', 'profile', $args );
  }

  add_action( 'init', 'my_taxonomies_profile', 0 );
 */


/*-----------------------------
	SHORTCODE CUSTOM POST-TYPE
-------------------------------*/

add_shortcode( 'displaypress', 'display_press_post_type' );

function display_press_post_type(){

    $args = array(
        'post_type' => array('press'),
        'posts_per_page' => '50',
        'orderby'   => 'menu_order',
        'order' => 'ASC'
    );
    $query = new WP_Query( $args );

    $sectioncontent = '<div id="press" class="teaser">';

    $sectioncontent .= '<div class="row">';
    $sectioncontent .= '<div class="container">';
    $sectioncontent .= '<h2 style="text-align: center;">Unsere Press</h2>';


    $sectioncontent .= '<div class="row">';
    $sectioncontent .= '<div class="offset-xl-2 col-xl-8 offset-lg-0 col-lg-12 offset-md-0 col-md-12">';
    $sectioncontent .= '<div class="row">';

    while ( $query->have_posts() ) {
        $query->the_post();

        $sectioncontent .= '<div class="teaser-element col-lg-4 col-md-6">';

        $image = get_the_post_thumbnail_url($query->post->post_ID, 'large');
        $hoverimage = get_field('hoverbild');
        $sectioncontent .= '<a href="'.esc_url(get_permalink()).'"><img class="thumbnail-image" src="' . $image . '" /><div class="hover-image"><img src="' . $hoverimage . '" /></div></a>';

        $sectioncontent .= '<div class="teaser-text"><h3><a href="'.esc_url(get_permalink()).'">' . $query->post->post_title . '</a></h3>';
        $sectioncontent .= '<span class="circle">' . get_field('maxpax') . '<i class="fas fa-user"></i></span>';
        $sectioncontent .= '</div>';
        $sectioncontent .= '</div>';

    }

    $sectioncontent .= '</div>';
    $sectioncontent .= '</div>';
    $sectioncontent .= '</div></div></div></div>';

    wp_reset_postdata();
    return $sectioncontent;

}







?>
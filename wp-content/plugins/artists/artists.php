<?php
/*
Plugin Name: artists
Plugin URI: http://www.gotypo.de
Description: A pluginto manage artists
Version: 1.2
Author: Christian Franke
Author URI: http://www.gotypo.de
License: GPL2
*/


function my_custom_post_artist() {
    $labels = array(
        'name'               => _x( 'Artists', 'post type general name' ),
        'singular_name'      => _x( 'Artist', 'post type singular name' ),
        'add_new'            => _x( 'Neuer Artist', 'artist' ),
        'add_new_item'       => __( 'Neuer Artist' ),
        'edit_item'          => __( 'Artist bearbeiten' ),
        'new_item'           => __( 'Neuer Artist' ),
        'all_items'          => __( 'Alle Artists' ),
        'view_item'          => __( 'Artist zeigen' ),
        'search_items'       => __( 'Artists Suchen' ),
        'not_found'          => __( 'No Artists found' ),
        'not_found_in_trash' => __( 'No Artists found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Artists'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our artist specific data',
        'public'        => true,
        'menu_position' => 8,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-admin-users',
        'taxonomies' => array( 'category' ),
    );
    register_post_type( 'artist', $args );
}
add_action( 'init', 'my_custom_post_artist' );

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

add_shortcode( 'displayartists', 'display_artists_post_type' );

function display_artists_post_type(){

    $args = array(
        'post_type' => array('artist'),
        'posts_per_page' => '50',
        'orderby'   => 'menu_order',
        'order' => 'ASC'
    );
    $query = new WP_Query( $args );

    $sectioncontent = '<div id="artists" class="teaser">';

    $sectioncontent .= '<div class="row">';
    $sectioncontent .= '<div class="container">';
    $sectioncontent .= '<h2 style="text-align: center;">Unsere artists</h2>';


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
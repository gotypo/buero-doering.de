<?php

/**
 * Author: Sridhar Katakam
 * Link: https://sridharkatakam.com/
 */


remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

remove_action( 'genesis_loop', 'genesis_do_loop' );


add_action( 'genesis_loop', 'sk_do_search_loop' );
/**
 * Outputs a custom loop.
 *
 * @global mixed $paged current page number if paginated.
 * @return void
 */
function sk_do_search_loop() {
    // create an array variable with specific post types in your desired order.




    echo '<h3>'.__( 'Results for', 'doering' ).': '.get_search_query().'</h3>';

    echo '<div class="search-content">';

    // get the search term entered by user.
    $s = isset( $_GET["s"] ) ? $_GET["s"] : "";

    if ($_GET['lang'] == 'en') {
        global $sitepress;
        $sitepress->switch_lang( 'en' );
    }

    // accepts any wp_query args.
    $args = (array(
        's' => $s,
        'posts_per_page' => 25,
        'order' => 'ASC',
        'orderby' => 'title'
    ));

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {

        add_action( 'genesis_entry_header', 'genesis_do_post_title' );


        // remove post info.
        remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

        // remove post image (from theme settings).
        remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

        // remove entry content.
        // remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

        // remove post content nav.
        remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
        // remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

        // force content limit.
        add_filter( 'genesis_pre_get_option_content_archive_limit', 'sk_content_limit' );

        // modify the Content Limit read more link.
        add_filter( 'get_the_content_more_link', 'sp_read_more_link' );

        // force excerpts.
        // add_filter( 'genesis_pre_get_option_content_archive', 'sk_show_excerpts' );

        // modify the Excerpt read more link.
        add_filter( 'excerpt_more', 'new_excerpt_more' );

        // modify the length of post excerpts.
        add_filter( 'excerpt_length', 'sp_excerpt_length' );

        // remove entry footer.
        remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
        remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
        remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

        // remove archive pagination.
        remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

        // custom genesis loop with the above query parameters and hooks.
        genesis_custom_loop( $args );

    }


    echo '</div>'; // .search-content

}

function sk_content_limit() {
    return '150'; // number of characters.
}

function sp_read_more_link() {
    return '... <a class="more-link" href="' . get_permalink() . '">Continue Reading</a>';
}

function sk_show_excerpts() {
    return 'excerpts';
}

function new_excerpt_more( $more ) {
    return '... <a class="more-link" href="' . get_permalink() . '">Continue Reading</a>';
}

function sp_excerpt_length( $length ) {
    return 20; // pull first 20 words.
}




genesis();
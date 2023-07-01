<?php

/**********************************
 *
 * 	CONTENT
 *
 ***********************************/


/*-------------------
	WRAP BLOCKS
---------------------*/

//function themeprefix_wrap_alignment( $block_content, $block ) {
//
//	/*
//	if ( isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'wide', 'full' ) ) ) {
//		$block_content = sprintf(
//			'<div class="%1$s">%2$s</div>',
//			'align-wrap align-wrap-' . esc_attr( $block['attrs']['align'] ),
//			$block_content
//		);
//	}*/
//
//
//	if ( !empty( $block['innerContent'] ) && strlen($block_content) > 2) {
//			$block_content = sprintf( '<div class="%1$s">%2$s</div>', 'element-inside element-gutenberg align-wrap align-wrap-' . esc_attr( $block['attrs']['align'] ), $block_content );
//	}
//
//	return $block_content;
//}
//add_filter( 'render_block', 'themeprefix_wrap_alignment', 10, 2 );


/*-------------------
	ADD FEATURE IMAGE
---------------------*/

add_action( 'genesis_after_header', 'themeprefix_featured_image', 1 );
function themeprefix_featured_image() {


}



/*-----------------------------
	SHORTCODE POSTS
-------------------------------*/

add_shortcode('showPosts', 'showPosts');

function showPosts($atts){

    if ($atts['limit'] > 0) {
        $limit = $atts['limit'];
    } else {
        $limit = 500;
    }

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'cat' => $atts['catid'],
		'posts_per_page' => $limit,
	);

	if ($atts['year']) {
        $args['date_query']['year'] = $atts['year'];
    }
    if ($atts['month']) {
        $args['date_query']['month'] = $atts['month'];
    }


	$query = new WP_Query( $args );

    $out .= '<div class="site-inner news-header"><h2>Presse&shy;mitteilungen und Messetermine</h2></div>';

	$out .= '<div class="element element news-list flex-container flex-50">';

		while ( $query->have_posts() ) {

		    $query->the_post();

			/* excerpt */
			if (strlen($query->post->post_excerpt)>1) {
	            $excerpt  =  $query->post->post_excerpt;
	        } else {
	            $excerpt = get_the_content();
	            $excerpt = esc_attr( strip_tags( stripslashes( $excerpt ) ) );
	            $excerpt = wp_trim_words( $excerpt, $num_words = 32, $more = NULL );
	        }

			/* categories */
            $categories = get_the_category($query->post->post_ID);
            if ( ! empty( $categories ) ) {
                $cat = '<ul>';
                foreach( $categories as $category ) {
                    $cat .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                }
                $cat .= '</ul>';
            }


			/* date */
			$months = array(1=>"Januar",2=>"Februar",3=>"M&auml;rz", 4=>"April", 5=>"Mai", 6=>"Juni", 7=>"Juli", 8=>"August", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Dezember");

			$day = date('d', strtotime($query->post->post_date));
			$month = date('n', strtotime($query->post->post_date));
			$year = date('Y', strtotime($query->post->post_date));


			// get_option( 'page_for_posts' );


            $image = get_the_post_thumbnail( $query->post->post_ID, 'square', array( 'class' => 'img' ));


            $out .= '<div class="flex-box">
                        <div class="flex-body news-list-container"><a href="'.get_page_link($query->post->post_ID).'">
                            <div class="news-list-left">';

            if ($image) {
                $out .= '<div class="nl-image">'.$image.'</div>';
            } else {
	            $out .= '<div class="nl-image"><img src="'.get_stylesheet_directory_uri().'/images/placeholder.png'.'" /></div>';
            }


            $out .= '</div>
                            <div class="news-list-right">
                                <div class="nl-date">'.$day.'.'.$month.'.'.$year.'</div>
                                <h3 class="nl-headline">'.$query->post->post_title.'</h3>
                                <div class="nl-excerpt">'.$excerpt.'</div>
                            </div>
                            <div class="clearfix"></div>
                        </a></div>
                    </div>';

		}



	$out .= '</div>';

    if (!$atts['view'] != 'start') {
        $out .= '<div class="center-button productlink"><a class="button" href="'.get_permalink(976).'" target=""><span>'.__('More news','genesis-jenophthalmo').'</span></a></div>';
    }




	wp_reset_postdata();
	return $out;
}








/*-------------------
	HEADER-TEXT
---------------------*/
/*
add_action( 'genesis_header_right', 'pageheadertext', 30);
function pageheadertext() {
	if( !is_front_page()) {
    	dynamic_sidebar( 'headertext-widget' );
	}

}*/


/*-------------------
	REMOVE TITLE
---------------------*/

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );



/*-------------------
	HEADER REMOVE/ADD
---------------------*/

remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// add header data
add_action( 'genesis_header', 'genesis_header_markup_open', 5 );
add_action( 'genesis_header', 'pageheader10', 10);
function pageheader10() {



    /*____ HEADER ___*/

    $header .= '<div id="site-inner" class="site-inner">
                    <div class="pos-absolute burger"><div class="nav-icon"><div></div></div></div>
                    <div class="row">
                        <div class="float-left logo"><a href="'.get_home_url().'"><img src="'.get_stylesheet_directory_uri().'/images/Logo_Header.svg" /></a></div>         
                        <div class="float-right navigation">';
	echo $header;
}

add_action( 'genesis_header', 'genesis_do_nav', 15 );


add_action( 'genesis_header', 'pageheader20', 20);
function pageheader20() {

    do_action('wpml_add_language_selector');

	$header .= '</div></div></div>';
	echo $header;
}

add_action( 'genesis_header', 'genesis_header_markup_close', 55 );


/*-------------------
	FOOTER REMOVE/ADD
---------------------*/

remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

add_action( 'genesis_footer', 'pagefooter', 30);
function pagefooter() {

	
    register_nav_menu( 'secondary', 'Secondary Menu' );

    $menusettings = array (
        'menu' => 'secondary',
        'theme_location' => 'secondary',
        'depth'          => 0,
        'menu_class'     => 'footermenu',
        'echo'           => false,
    );


    $footer = '<footer itemscope="" itemtype="https://schema.org/WPFooter">';
	$footer .= '<div class="footer">';
	$footer .= '<div class="footerlogo"><img src="'.get_stylesheet_directory_uri().'/images/Logo_Footer.svg" alt="" width="400" ></div>';
	$footer .= '<div class="site-inner">';
	$footer .= '<div class="sm-logos"><div class="sm-icon sm-instagram"><img src="'.get_stylesheet_directory_uri().'/images/Icon_linkedin.svg" alt="" width="32" height="32" ></div><div class="sm-icon sm-facebook"><img src="'.get_stylesheet_directory_uri().'/images/Icon_facebook.svg" alt="" width="32" height="32" ></div></div>'.wp_nav_menu( $menusettings );
	$footer .= '<div class="copy">&copy; Jen-Ophthalmo '.date("Y").'</div>';
	$footer .= '</div></div>';
	$footer .= '</footer>';


	echo $footer;
}


/*-------------------
	REMOVE FOOTER-TEXT
---------------------*/

add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
	$creds = '';
	return $creds;
}



/*-------------------
	BEFORE SIDEBAR
---------------------*/

add_action( 'genesis_before_sidebar_widget_area', 'beforesidebar', 20);
function beforesidebar() {
    $out = '<div class="logo"><img src="/wp-content/themes/genesis-vhs/images/logo.png" /></div>';
    $out .= '<div class="sidebar-container">';
    echo $out;
}

/*-------------------
	AFTER SIDEBAR
---------------------*/

add_action( 'genesis_after_sidebar_widget_area', 'aftersidebar', 10);
function aftersidebar() {
    $out = '</div>';
    echo $out;
}




/*-------------------
	GET FEATUREIMAGE
---------------------*/

function get_featureimage( $args ) {

    /*
     *      recursive
     *      single
     *      url
     *      notfoundpage
     *      default
     */

    global $post;

    //print_r ($post->post_parent);

    $img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

    if ($args['recursive']) {
        $parent = $post->post_parent;
        if (intval($parent)>0) {
            while (!is_array($img)) {
                $getpost = $parent;
                $img = wp_get_attachment_image_src( get_post_thumbnail_id($getpost), 'full' );
                if (is_array($img)) {
                    break;
                } else {
                    if ($getpost->post_parent) {
                        $parent = get_post($getpost->post_parent);
                    } else {
                        break;
                    }

                }
            }
        }
    }

    if (is_single()) {
        if ($args['single'] == 1) {
            $img[0] = $img[0];
        } else {
            $img[0] = $args['default'];
        }
    }

    if (!is_array($img) && $args['default']) {
        $img[0] = $args['default'];
    }
    $image = '<img src="'.$img[0].'" />';

    return $image;
}



?>
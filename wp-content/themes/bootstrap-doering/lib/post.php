<?php



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
        'posts_per_page' => $limit,
    );

    if ($atts['catid']) {
        $args['cat'] = $atts['catid'];
    }
    if ($atts['year']) {
        $args['date_query']['year'] = $atts['year'];
    }
    if ($atts['month']) {
        $args['date_query']['month'] = $atts['month'];
    }


    $query = new WP_Query( $args );


    // termlist
    if ($atts['view'] == 'list') {

        /* get all terms  */
        $terms = get_terms( array(
            'taxonomy' => 'category'
        ) );


        $out = '<div class="row blogfilter"><span>'.__( 'Filter by:', 'doering' ).'</span><ul>';
	    $out .= '<li><a class="all" href="'.get_the_permalink(419).'">'.__( 'Display all', 'doering' ).'</a></li>';
        foreach ($terms as $k => $v) {
            if ($v->term_id == $page_object->cat_ID) {
                $class = ' active ';
            } else {
                $class = '';
            }
            $term_link = get_term_link($v);
            $out .= '<li><a class="'.$class.' " href="'.$term_link.'">'.$v->name.'</a></li>';
        }
        $out .= '</ul></div>';
    }


    $out .= '<div class="element-gutenberg element-news"><div class="row same-height-row">';


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



        /* date */
        $months = array(1=>"Januar",2=>"Februar",3=>"M&auml;rz", 4=>"April", 5=>"Mai", 6=>"Juni", 7=>"Juli", 8=>"August", 9=>"September", 10=>"Oktober", 11=>"November", 12=>"Dezember");

        $day = date('d', strtotime($query->post->post_date));
        $month = date('n', strtotime($query->post->post_date));
        $year = date('Y', strtotime($query->post->post_date));

        // get_option( 'page_for_posts' );

        $image = get_the_post_thumbnail( $query->post->post_ID, 'doering-gallery', array( 'class' => '' ));

        if (!$image) {
            $image = '<img src="'.get_stylesheet_directory_uri().'/images/placeholder.png'.'" />';
        }



        $out .= '<div class="element el-news col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="el-news-inner"><a href="'.get_page_link($query->post->post_ID).'">
                        <div class="image">'.$image.'</div>
                        <div class="date">'.$day.'.'.$month.'.'.$year.'</div>
                        <h3>'.$query->post->post_title.'</h3>
                        <p class="text">'.$excerpt.'</p></a>
                    </div>
                </div>';


    }



    $out .= '</div></div>';

    /*if (!$atts['view'] != 'start') {
        $out .= '<div class="center-button productlink"><a class="button" href="'.get_permalink(976).'" target=""><span>'.__('More news','genesis-jenophthalmo').'</span></a></div>';
    }*/




    wp_reset_postdata();
    return $out;
}





?>
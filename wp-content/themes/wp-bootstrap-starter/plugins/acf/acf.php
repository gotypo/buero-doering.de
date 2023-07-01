<?php


/**********************************
  *
  * 	ACF
  *
 ***********************************/



/* SLIDER
--------------------------------------------- */

add_action('acf/init', 'slider_acf_init');
function slider_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'slider',
            'title'				=> __('Slider'),
            'description'		=> __(''),
            'render_callback'	=> 'slider_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'slider'),
        ));
    }
}

function slider_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'slider-' . $block['id'];

    if(get_field('sliderelement')) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Slider</div>';
            $out.= '<div class="element site-inner el-slider">';

            foreach (get_field('sliderelement') as $k => $v) {
                $image = $v['bild_background'];
                foreach (get_field('sliderelement') as $k => $v) {
                    $image = $v['bild_background'];
                    $out .= '<div><img src="'.$image['sizes']['thumbnail'].'" /></div>';
                }
            }

            $out.= '<hr /></div>';

        } else {

            if (is_array(get_field('sliderelement'))) {

                $out .= '<div class="element el-slider">';
                $out .= '<div class="element-side">';
                $out .= '<div class="swiper-container slider-size-'.get_field('slider_view').'"><div class="swiper-wrapper">';

                foreach (get_field('sliderelement') as $k => $v) {

                    $image = $v['bild_background'];
                    $video = $v['video_alternativ'];

                    if ($video['url']) {
                        $out .= '<div class="swiper-slide"><div class="swiper-slide-container">';
                        $out .= '<div class="swiper-slide-image">
                                        <video id="videoBG" autoplay muted loop>
                                            <source src="'.$video['url'].'" type="video/mp4">
                                        </video>
                                 </div>';
                    } else {
                        $out .= '<div class="swiper-slide"><div class="swiper-slide-container">';
                        $out .= '<img src="'.$image['url'].'" class="swiper-slide-image" />';
                    }

                    if (get_field('slider_overlay')) {
	                    $out .= '<div class="swiper-overlay">';
                        if (strlen($v['text']) > 5) {
                            $out .= '<div class="text-overlay">';
                            $out .= $v['text'];
                            if (is_array($v['link'])) {
                                $out .= '<a class="button transparent" href="'.$v['link']['url'].'"><span>'.$v['link']['title'].'</span></a>';
                            }
                            $out .= '</div>';
                        }
                        $out .= '</div>';
                    }
                    

                    $out .= '</div></div>';

                }

                $out .= '</div>';

                if (count(get_field('sliderelement')) > 1) {
	                $out .= '<div class="swiper-button-next swiper-button-white"></div><div class="swiper-button-prev swiper-button-white"></div>';
                }

                $out .= '</div>';
                $out .= '</div>';
                $out .= '</div>';

            }

        }
        echo $out;
    }
}



/* TEASER
--------------------------------------------- */

add_action('acf/init', 'teaser_acf_init');
function teaser_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'teaser',
            'title'				=> __('Teaser'),
            'description'		=> __(''),
            'render_callback'	=> 'teaser_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'teaser'),
        ));
    }
}

function teaser_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'teaser-' . $block['id'];

    if(get_field('teaser_text')) {

        $image = get_field('teaser_background');
        $link = get_field('teaser_link');

        if (is_admin() ) {

            $out = '<div>Teaser</div>';
            $out .= '<div>'.get_field('teaser_text');
            $out.= '<hr /></div>';

        } else {

            $out .= '<div class="element el-teaser">
                        <div class="color-container">
                            <div class="element-inside">
                                <div class="teaserblock view-'.get_field('teaser_abstand').'">';

            $out .= '<div class="teaseritem">';
            if($image) {
                $out .= '<div class="image"><img src="'.$image['url'].'" alt="" title="" /></div>';
            }
            $out .= ''.get_field('teaser_text').'</div>';


            if (strlen($link['url']) > 5) {

                $out .= '<div class="teaserlink"><a class="btn" href="'.$link['url'].'" target="'.$link['target'].'"><span>'.$link['title'].'</span></a></div>';

            }

            $out .= '</div></div></div></div>';
        }
        echo $out;
    }
}



/* TEAM
--------------------------------------------- */

add_action('acf/init', 'team_acf_init');
function team_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'team',
            'title'				=> __('Team'),
            'description'		=> __(''),
            'render_callback'	=> 'team_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'team'),
        ));
    }
}

function team_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'team-' . $block['id'];



    if(get_field('teammember')) {

        $image = get_field('team-bild');



        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Team-Member</div>';
            $out .= '<div>'.get_field('team-name');
            $out.= '<hr /></div>';

        } else {

            $out .= '<div class="element el-team">
                            <div class="element-inside">';

            $out .= '<div class="flex-container flex-33">';

            foreach (get_field('teammember') as $k => $v) {

                $image = $v['team-bild'];


                $out .= '<div class="flex-box">';

                $out .= '<div class="product-inside">';

                if ($image) {
                    $out .= '<div class="product-image"><div class="p-image-inside"><img src="'.$image['sizes']['square'].'" /></div></div>';
                } else {
                    $out .= '<div class="product-image"><div class="p-image-inside"><img src="'.get_stylesheet_directory_uri().'/images/placeholder.png'.'" /></div></div>';
                }

                $out .= '<div class="team-textbox">';
                $out .= '<div class="title">'.$v['team-position'].'</div>';
                $out .= '<h3>'.$v['team-name'].'</h3>';
                $out .= '<p>'.$v['team-text'].'</p>';
                $out .= '</div>';
                $out .= '</div></div>';

            }

            $out .= '</div></div></div>';
        }
        echo $out;
    }
}



/* GALERIE
--------------------------------------------- */

/*

add_action('acf/init', 'galerie_acf_init');
function galerie_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'galerie',
            'title'				=> __('Galerie'),
            'description'		=> __(''),
            'render_callback'	=> 'galerie_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'teaser'),
        ));
    }
}

function galerie_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'galerie-' . $block['id'];


        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Galerie</div>';
            $out.= '<div class="element el-galerir">';
            if(get_field('galerie-1')) {
                $galerie1 = get_field('galerie-1');
                foreach ($galerie1 as $k => $v) {
                    $out .= '<img src="'.$v['sizes']['thumbnail'].'" />';
                }
            }

            $out.= '<hr /></div>';

        } else {



            $out .= '<div class="element-content el-galerie">';
            $out .= '<div class="element-side">';
            $out .= '<div class="galerie">';


            if(get_field('galerie-1')) {
                $galerie1 = get_field('galerie-1');
                $i = 1;
                foreach ($galerie1 as $k => $v) {
                    $i++;
                    $wall[$i]['thumbnail'] = $v['sizes']['medium'];
                }
            }

            if(get_field('galerie-2')) {
                $galerie2 = get_field('galerie-2');
                $i = 1;
                foreach ($galerie2 as $k => $v) {
                    $i++;
                    $wall[$i]['large'] = $v['url'];
                }
            }

            $out .= '<div class="wall-container">';
            foreach ($wall as $k => $v) {
                $out .= '<div class="wall-item fancybox"><a class="fb" href="'.$v['large'].'" data-fancybox="'.$id.'"><img src="'.$v['thumbnail'].'" /></a></div>';
            }
            $out .= '</div>';




            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>';
        }
        echo $out;

}

*/



/* POSTS
--------------------------------------------- */

/*

add_action('acf/init', 'posts_acf_init');
function posts_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'posts',
            'title'				=> __('Posts'),
            'description'		=> __(''),
            'render_callback'	=> 'posts_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'posts'),
        ));
    }
}

function posts_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'galerie-' . $block['id'];



    $categories = get_field('blogbeitrage');

    foreach ($categories as $k => $v) {
        $cat .= $v.', ';
    }
    $cat = substr($cat,0,-2);



    $args = array(
        'post_type' => 'post',
        'post_status' => 'any',
        'cat' => $cat,
    );



    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Posts</div>';
        $out.= '<div class="element el-galerir">';
        $out.= '<hr /></div>';

    } else {

        $out .= '<div class="element-content el-posts">';
        $out .= '<div class="element-side">';
        $out .= '<div class="posts posts-related">';

        $query = new WP_Query( $args );

        $out .= '<h3>Verwandte Blogbeiträge</h3>';
        $out .= '<div class="posts-container">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $out .= '<div class="posts-item">
                        <a href="'.get_page_link($query->post->post_ID).'">
                        '.get_the_post_thumbnail( $query->post->post_ID, 'medium', array( 'class' => '' ) ).'
                        <div class="t-text"><div class="t-text-inside entry-header">'.$query->post->post_title.'</div></div>
                        </a>
                    </div>';
        }
        $out .= '</div>';


        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }
    echo $out;

}

*/


/* ACCORDION
--------------------------------------------- */

/*


add_action('acf/init', 'accordion_acf_init');
function accordion_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'accordion',
            'title'				=> __('Accordion'),
            'description'		=> __(''),
            'render_callback'	=> 'accordion_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments',
            'keywords'			=> array( 'accordion'),
        ));
    }
}

function accordion_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $id = 'accordion-' . $block['id'];

    if(get_field('titel')) {


        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Accordion</div>';
            $out.= '<div class="element el-deals">
		             <h3><span>'.get_field('titel').'</span></h3>';

            $out.= '<hr /></div>';

        } else {


            $out .= '<div class="element el-accordion">';
            $out .= '<div class="element-inside">
                        <h3 class="accoredon-headline bg-'.get_field('hintergrund').'">'.get_field('titel').'<i class="fas fa-plus"></i></h3>
                        <div class="accoredon-text">'.get_field('inhalt').'</div>
                    </div>';
            $out .= '</div>';
        }
        echo $out;
    }
}

*/

/*********************
 *
 * 		SIDEBAR
 *
 *********************/


/*

add_action( 'genesis_after_sidebar_widget_area', 'pagesidebar', 20);
function pagesidebar() {

    if(have_rows('container')) {
		$output = '<div class="teaser-area">';
		$i = 0;
	    while ( have_rows('container') ) : the_row();
			$i++;
			//if ($i == 1) {
				$output .= '<div class="teaser-container bg-'.get_sub_field('hintergrund').'">';
				if (get_sub_field('titel')) {
					$output .= '<h4>'.get_sub_field('titel').'</h4>';
				}
				$output .= get_sub_field('inhalt');	
				if (is_array(get_sub_field('links'))) {

				    $output .= '<p>';

					foreach (get_sub_field('links') as $k => $v) {
						if (is_array($v['linkfile'])) {
							$link = $v['linkfile']['url'];
							$target = 'target="_blank"';
						}
						if ($v['seite']) {
							$link = $v['seite'];
						}
						if ($link) {
							$output .= '<a class="link-button" href="'.$link.'" '.$target.'>'.$v['linktext'].'</a>';
						}
					}
                    $output .= '</p>';
				}
 				
				$output .= '</div>';
			//}
	    endwhile;
		$output .= '</div>';
		echo $output;
	}

}

*/

/* ADD CLASS TO BODY
--------------------------------------------- */

add_filter( 'body_class', 'my_body_class' );
function my_body_class( $classes ) {

    if(have_rows('container')) {
        $classes[] = 'has-marginalie';
    }

    return $classes;

}

 



/*********************
 *
 * 		OPTIONS
 *
 *********************/

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));


	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));



}




?>
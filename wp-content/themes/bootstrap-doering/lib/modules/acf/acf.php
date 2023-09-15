<?php


/**********************************
 *
 * 	ACF
 *
 ***********************************/

/* KEYVISUAL
--------------------------------------------- */
function getKeyvisual() {

    if ((get_field('keyvisualvideo') || (get_field('keyvisualimage')))) {
        $imageSrc = (get_field('keyvisualimage'))['url'];
        $claim = strip_tags(get_field('keyvisualclaim'));

        $out = '<div id="keyvisual" class="keyvisual noize">';
        $out .= '<div class="gradient-overlay"></div>';
        if((get_field('keyvisualvideo'))) {
            $out .= ' <video poster="'.get_field('keyvisualimage').'" muted autoplay loop playsinline>
                          <source src="'.get_field('keyvisualvideo').'" type="video/mp4">
                        </video>';
        }
        if((get_field('keyvisualimage'))) {
            $out .= '<picture>
                        <source srcset="'.$imageSrc.'">
                        <img src="'.$imageSrc.'" alt="'.$claim.'" />
                    </picture>';
        }
        if((get_field('keyvisualclaim'))) {
            $out .= '<div class="container">'.get_field('keyvisualclaim').'</div>';
        }

        if((get_field('copyright'))) {
            $out .= '<div class="copyright"><span>&copy;</span>'.get_field('copyright').'</div>';
        }

        $out .= '</div>';

        echo $out;

    }
}

/* TEAM
--------------------------------------------- */

add_action('acf/init', 'team_acf_init');
function team_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'team',
            'title'				=> __('team'),
            'description'		=> __(''),
            'render_callback'	=> 'team_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'businessman'
        ));
    }
}

function team_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $align = $block['align'];
    $cssClass = $block['className'];

    if (is_admin() ) {
        $out = '<h2>'.get_field('name').'</h2>';
        $out .= '<p>'.get_field('position').'</p>';
    } else {
        $image = get_field('image');
        $size = 'full';
        $out = '<div class="team waypoint-marker '.$cssClass.'">';
        $out .= '<div class="row">';
        $out .= '<div class="col-xl-3 col-lg-4 col-md-5 team-left animate__animated" data-animation="animate__bounceInLeft">';
        $out .= '<div class="team-image-wrapper">';

        if( $image ) {
            $out .= '<div class="masked-image-team">';
            $out .= '<div class="image">'.wp_get_attachment_image( $image, $size ).'</div>';
            $out .= '<div class="bands"><h3>Auf meiner Playlist</h3>'.get_field('bands').'</div>';
            $out .= '</div>';
        }
        $out .= '<h3 class="name">'.get_field('name').'</h3>';
        $out .= '<p class="position">'.get_field('position').'</p>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '<div class="col-xl-8 col-lg-7 col-md-6 offset-lg-1 offset-md-0 team-right">';
        if(get_field('email')) {
            $out .= '<p class="fact"><strong>E-Mail:</strong><a href="mailto:'.get_field('email').'" title="Mail an '.get_field('name').'">'.get_field('email').'</a></p>';
        }
        if(get_field('phone')) {
            $out .= '<p class="fact"><strong>Telefon:</strong><a href="tel:'.get_field('phone').'" title="'.get_field('name').' anrufen">'.get_field('phone').'</a></p>';
        }
        if(get_field('office')) {
            $out .= '<p class="fact"><strong>Büro:</strong>'.get_field('office').'</p>';
        }
        if(get_field('linkedin')) {
            $out .= '<p class="fact"><strong>LinkedIn:</strong><a href="'.get_field('linkedin').'" target="_blank"><em class="fa-brands fa-linkedin"></em></a></p>';
        }
        $out .= '<p>'.get_field('text').'</p>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }

    echo $out;
}

/* YOUTUBE VIDEO
--------------------------------------------- */

add_action('acf/init', 'youtubevideo_acf_init');
function youtubevideo_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'youtubevideo',
            'title'				=> __('YouTube Video'),
            'description'		=> __(''),
            'render_callback'	=> 'youtubevideo_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-media'
        ));
    }
}

function youtubevideo_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];

    if (is_admin() ) {
        $out = '<h2>Video mit der ID'.get_field('videoid').'</h2>';
    } else {
        $out = '<div class="youtube-video-element waypoint-marker mt-4 mb-4 '.$cssClass.'">';
        $out .= '<div class="row">';
        $out .= '<div class="col-md-8">';

        $out .= '<div class="video-container"><iframe width="100%" data-name="youtube" data-src="https://www.youtube.com/embed/'.get_field('videoid').'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }

    echo $out;
}


/* EXTERNAL IFRAME
--------------------------------------------- */

add_action('acf/init', 'externaliframe_acf_init');
function externaliframe_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'externaliframe',
            'title'				=> __('Externer Iframe Embed'),
            'description'		=> __(''),
            'render_callback'	=> 'externaliframe_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'editor-code'
        ));
    }
}

function externaliframe_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];

    if (is_admin() ) {
        $out = '<h2>Externer Embed mit der URL'.get_field('embed-url').'</h2>';
    } else {
        $out = '<div class="external-iframe-element waypoint-marker mt-4 mb-4 '.$cssClass.'">';
        $out .= '<div class="row">';
        $out .= '<div class="col-md-8">';
        $out .= '<div class="video-container"><iframe width="100%" data-name="externaliframe" data-src="'.get_field('embed-url').'" title="Externer Iframe" frameborder="0" allowfullscreen></iframe></div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }

    echo $out;
}



/* SHORTCUTS
--------------------------------------------- */

add_action('acf/init', 'shortcut_acf_init');
function shortcut_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'shortcut',
            'title'				=> __('Shortcut'),
            'description'		=> __(''),
            'render_callback'	=> 'shortcut_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-links'
        ));
    }
}

function shortcut_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $align = $block['align'];
    $cssClass = $block['className'];

    if (is_admin() ) {
        $out = '<h2>'.get_field('shortcutheader').'</h2>';
        $out .= '<p>'.get_field('shortcutdescription').'</p>';
    } else {
        $out = '<div class="shortcuts waypoint-marker '.$cssClass.'">';
        $out .= '<div class="row">';
        $out .= '<div class="col-lg-8 offset-lg-2 col-md-12 offset-md-0">';
        $out .= '<h2>'.get_field('shortcutheader').'</h2>';
        $out .= '<p>'.get_field('shortcutdescription').'</p>';
        $out .= '<div class="buttons">';

        while( have_rows('shortcutbuttons') ) : the_row();

            $sub_value = get_sub_field('shortcutbuttonlink');
            $out .= '<a href="'.$sub_value["url"].'" class="btn animate__animated" data-animation="animate__zoomIn">'.$sub_value["title"].'</a>';

        endwhile;

        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }

    echo $out;
}

/* SERVICES
--------------------------------------------- */

add_action('acf/init', 'services_acf_init');
function services_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'services',
            'title'				=> __('Services'),
            'description'		=> __(''),
            'render_callback'	=> 'services_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-links'
        ));
    }
}

function services_acf_block_render_callback( $block ) {

    $index = 1;
    $amountOfCols = get_field('cols');
    $animationDirection = 'animate__fadeInRightBig';
    $cssClass = $block['className'];

    if ($amountOfCols == "col-md-6") {
        $colWrapper = 'items-in-2-cols';
    } else {
        $colWrapper = 'items-in-3-cols';
    }

    if (is_admin() ) {
        $out = '<h2>'.get_field('servicesheader').'</h2>';
        $out .= '<p>'.get_field('servicesdescription').'</p>';
    } else {
        $out = '<div class="services waypoint-marker '.$cssClass.'">';
        $out .= '<h2>'.get_field('servicesheader').'</h2>';
        $out .= '<p>'.get_field('servicesdescription').'</p>';
        $out .= '<div class="items '.$colWrapper.'">';
        $out .= '<div class="row">';

        while( have_rows('serviceitems') ) : the_row();

            if ($index % 3 == 0) {
                $animationDirection = 'animate__fadeInLeftBig';
            } else if($index % 2 == 0) {
                $animationDirection = 'animate__fadeInUp';
            } else {
                $animationDirection = 'animate__fadeInRightBig';
            }

            $icon = get_sub_field('icon');
            $fontawesome = get_sub_field('fontawesome');
            $title = get_sub_field('title');
            $link = get_sub_field('link');
            $text = get_sub_field('text');
            $flipImage = get_sub_field('flip_image');

            if($flipImage) {
                $flipClass = 'service-flip';
            }

            $out .= '<div class="item '.$flipClass.' '.$amountOfCols.' animate__animated" data-animation="'.$animationDirection.'">';
            $out .= '<div class="services-wrapper">';
            $out .= '<div class="services-gradient">
                       <div class="gradient"></div>';
                    if($flipImage) {
                        $out .= '<div class="flip-image"><img src="'. $flipImage['sizes']['cube-image'] .'" alt="" /></div>';

                    }
            $out .= '</div>';
            $out .= '<div class="services-inner">';
            if($link) {
                $out .= '<a href="'.$link.'" title="'.$title.'">';
            }
            if ($icon) {
                $out .= '<div class="icon"><img src="'.$icon.'" alt="'.$title.'" /></div>';
            } else {
                $out .= '<div class="icon">'.$fontawesome.'</div>';
            }
            $out .= '<h3>'.$title.'</h3>';
            $out .= '<p>'.$text.'</p>';
            if($link) {
                $out .= '</a>';
            }
            $out .= '</div>';

            $out .= '</div>';
            $out .= '</div>';

            $index = $index+1;
            $flipClass = "";

        endwhile;

        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';
    }

    echo $out;
}

/* POSTS
--------------------------------------------- */

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

    $header = get_field('newsheader');
    $description = get_field('newsdescription');
    $amountOfPosts = get_field('amount');
    $selectedCategory = get_field('categoryselector');
    $cssClass = $block['className'];

    // IF CATEGORY FILTER IS SET
    if(isset($_GET['cat'])) {
        $selectedCategory = $_GET['cat'];
    }

    $index = 1;

    // GET CHILD CATEGORIES OF SELECTED CATEGORY
//    $parentCategory = get_field('categoryselector');
//    $args = array('child_of' => $parentCategory);
//    $childCategories = get_categories( $args );

    // GET CHILD CATEGORIES OF SELECTED CATEGORY
    $parentCategory = get_field('categoryselector');
    $childCategories = get_categories( array('parent' => $parentCategory[0]) );

    $showCategory = get_field('showCategories');
    $showMoreLink = get_field('showMoreLink');
    $showPagination = get_field('showPagination');

    // set the "paged" parameter (use 'page' if the query is on a static front page)
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';

    if(!$amountOfPosts) {
        $amountOfPosts = 5;
    }

    $args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'post_status' => 'publish',
        'posts_per_page' => $amountOfPosts,
        'cat' => $selectedCategory,
    );


    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Posts</div>';
        $out.= '<div class="element">';
        $out.= '<hr /></div>';

    } else {

        $out = '<div id="news" class="element-content el-posts waypoint-marker '.$cssClass.'">';
        $out .= '<h2>'.$header.'</h2>';
        $out .= '<p>'.$description.'</p>';
        $out .= '<div class="element-side">';
        $out .= '<div class="posts posts-related">';

        if($showCategory == 1) {
            $out .= '<div id="category-filter" class="filterbar">';
            $out .= '<div class="form-group custom-select">
                        <select class="form-select form-control" onchange="location = this.value;">
                        <option value="buero-doering.de/blog/" selected>News nach Projekt filtern</option>';

            foreach($childCategories as $childCategory) {
                $out .= '<option data-category-name="'.$childCategory->name.'" data-category-id="'.$childCategory->term_id.'" value="https://'.$_SERVER['HTTP_HOST']. parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?cat='.$childCategory->term_id.'#category-filter">'.$childCategory->name.'</option>';
            }

            $out .= '</select></div>';
            $out .= '</div>';
        }

        $query = new WP_Query( $args );

        if ($query->have_posts()) {
            $out .= '<div id="posts-container" class="posts-container">';

            while (($query->have_posts()) && ($index <= $amountOfPosts)) {

                if ($index % 2 == 0) {
                    $animationDirection = 'animate__slideInLeft';
                } else {
                    $animationDirection = 'animate__slideInRight';
                }

                $query->the_post();

                $monthFull = date('F', strtotime($query->post->post_date));
                $shortDate = substr($monthFull, 0, 3);
                $imageObject = get_the_post_thumbnail( $query->post->post_ID, 'masked-image', array( 'class' => 'alignleft' ));

                $content = $query->post->post_content;
                $content = apply_filters('the_content', $content);
                $content = wp_strip_all_tags($content);

                if($imageObject != '') {

                } else {
                    $imageObject = "<img src='/wp-content/themes/bootstrap-doering/assets/images/placeholder-news.jpg' alt='buero doering' />";
                }
                $out .= '<div class="post-item animate__animated row ml-0 mr-0" data-animation="'.$animationDirection.'">';
                $out .= '';
                $out .= '<div class="image col-lg-3 col-md-4">
                        '.$imageObject.'
                        <div class="date-element">
                            <span class="day">'.date('d', strtotime($query->post->post_date)).'</span>
                            <div class="rotate-90">
                                <span class="month">'.$shortDate.'</span>
                                <span class="year">'.date('Y', strtotime($query->post->post_date)).'</span>
                            </div>
                        </div>
                    </div>';

                $out .= '<div class="text offset-md-1 col-lg-7 col-md-6"><div class="wrapper">
                     <a href="'.get_page_link($query->post->post_ID).'">
                        <h3>'.$query->post->post_title.'</h3>
                     </a>';

                if($query->post->post_excerpt != "") {
                    $out .= '<p class="excerpt">'.wp_trim_words($query->post->post_excerpt, 20, '...').'</p>';
                } else {
                    $out .= '<p>'.wp_trim_words($content, 20, '...').'</p>';
                }
                if($showCategory == 'show') {
                    $out .= '<p class="category">'.$query->post->get_the_category.'</p>';
                }
                $out .= '</div></div>';

                $out .= '<div class="masked-overlay gradient-primary">
                            <div class="masked-image col-lg-4 col-md-5 p-0">
                                '.$imageObject.'
                            </div>
                            <div class="masked-text offset-md-1 col-lg-8 col-md-7 p-0">
                            
                            </div>
                         </div>';

                $out .= '</div>';

                $content == "";

                $index = $index+1;
            }

            $out .= '</div>';

            // THE PAGINATION
            if($showPagination == 1) {
                previous_posts_link( 'zurück' );
                next_posts_link('weiter', $query->max_num_pages);

                $out .= '<div class="pagination">';
                $out .= '<div class="btn nav-prev-trigger">zurück</div>';
                $out .= '<div class="btn nav-next-trigger">weiter</div>';
                $out .= '</div>';
            }
        }

        $out .= '</div>';

        if($showMoreLink == 1) {
            $out .= '<a href="/blog" class="btn btn-more">mehr</a>';
        }

        $out .= '</div>';


        // Restore original Post Data
        wp_reset_postdata();
    }
    echo $out;

}


/* PRESSEFILTER MIT ELEMENTEN
--------------------------------------------- */

add_action('acf/init', 'pressfilter_acf_init');
function pressfilter_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'Presse filter',
            'title'				=> __('pressfilter'),
            'description'		=> __(''),
            'render_callback'	=> 'pressfilter_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'sos'
        ));
    }
}

function pressfilter_acf_block_render_callback( $block ) {

    $cssClass = $block['className'];

    // GET CHILD CATEGORIES OF SELECTED CATEGORY
    $parentCategory = get_field('category');
    $childCategories = get_categories( array('parent' => $parentCategory) );

    $selectedCategory = null;

    // IF CATEGORY FILTER IS SET
    if(isset($_GET['cat'])) {
        $selectedCategory = $_GET['cat'];
    }

    // set the "paged" parameter (use 'page' if the query is on a static front page)
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';


    $args = array(
        'post_type' => 'Press',
        'paged' => $paged,
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'cat' => $selectedCategory,
    );

    $query = new WP_Query( $args );


    if (is_admin() ) {
        $out = '<h2>Kategoriefilter</h2>';
    } else {

        // KATEGORIE FILTER
        $out = '<div id="category-filter" class="event-filter filterbar '.$cssClass.'">';
        $out .= '<div class="form-group custom-select">
                    <select class="form-select form-control" onchange="location = this.value;"> 
                    <option selected>Projekt auswählen</option>';

        foreach($childCategories as $childCategory) {
            $out .= '<option data-category-name="'.$childCategory->name.'" data-category-id="'.$childCategory->term_id.'" value="https://'.$_SERVER['HTTP_HOST']. parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH).'?cat='.$childCategory->term_id.'#jumpto">'.$childCategory->name.'</option>';
        }

        $out .= '</select></div>';
        $out .= '</div>';

        if($selectedCategory !== null) {
            while ($query->have_posts()) {

                $content = $query->post->post_content;
                $content = apply_filters('the_content', $content);
                $query->the_post();

                $out .= '<div class="anchorpoint" id="jumpto">'.$content.'</div>';

            }
        }


        $out .= '';

    }

    echo $out;
}

/* LINKBUTTON
--------------------------------------------- */

add_action('acf/init', 'linkbutton_acf_init');
function linkbutton_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'linkbutton',
            'title'				=> __('Linkbutton'),
            'description'		=> __(''),
            'render_callback'	=> 'linkbutton_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-links'
        ));
    }
}

function linkbutton_acf_block_render_callback( ) {

    $buttonText = get_field('buttontext');
    $buttonLink = get_field('buttonlink');
    $buttonIcon = get_field('buttonicon');


    if (is_admin() ) {
        $out = '<h1>Linkbutton</h1>';
    } else {
        if($buttonText && $buttonLink && $buttonIcon) {

            if ($buttonLink["target"]) {
                $target = 'target="'.$buttonLink["target"].'"';
            }

            $out = '<div class="element-gutenberg waypoint-marker element-linkbutton">';
            $out .= '<a href="'.$buttonLink["url"].'" class="btn" '.$target.'>';
            if(($buttonIcon) && ($buttonIcon != 'none')) {
                $out .= '<span class="material-symbols-outlined">'.$buttonIcon.'</span>';
            }
            $out .= '<span>'.$buttonText.'</span></a>';
            $out .= '</div>';
        }
    }

    echo $out;
}


/* DIVIDER
--------------------------------------------- */

add_action('acf/init', 'dividerstyle_acf_init');
function dividerstyle_acf_init() {
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'				=> 'dividerstyle',
            'title'				=> __('Trenner gestyled'),
            'description'		=> __(''),
            'render_callback'	=> 'dividerstyle_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'leftright'
        ));
    }
}

function dividerstyle_acf_block_render_callback( $block ) {

    $cssClass = $block['className'];
    $dividerstyle = get_field('dividerstyle');

    if (is_admin() ) {
        $out = '<h2>Trennerstyle auswählen und konfigurieren </h2>';
    } else {
        if($dividerstyle == 'triangle') {

            $out = '<div class="styled-divider element-full-width '.$dividerstyle.' '.$cssClass.'"></div>';

        } else if ($dividerstyle == 'gradient') {

            $out = '<div class="styled-divider element-full-width '.$dividerstyle.' '.$cssClass.'"></div>';

        } else if ($dividerstyle == 'image') {

            $imageSrc = (get_field('image'))['url'];
            $copyright = (get_field('image'))['description'];

            $out = '<div id="divider-with-image" class="divider-with-image element-full-width '.$dividerstyle.' '.$cssClass.'">';
            $out .= '<div class="gradient-overlay"></div>';
            if((get_field('image'))) {
                $out .= '<div class="masked-image">
                    <picture>
                        <source srcset="'.$imageSrc.'">
                        <img src="'.$imageSrc.'" alt="'.get_field('header').'" />
                    </picture>
                    </div>';
            }
            if($copyright) {
                $out .= '<div class="copyright"><span>&copy;</span>'.$copyright.'</div>';
            }


            if((get_field('header')) || (get_field('text'))) {
                $out .= '<div class="text-overlay"><div class="container">
                        <h2>'.get_field('header').'</h2>
                        <p>'.get_field('text').'</p>
                    </div></div>';
            }

            $out .= '</div>';
        }

    }

    echo $out;
}

/* EVENTSLIDER
--------------------------------------------- */

add_action('acf/init', 'eventslider_acf_init');
function eventslider_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'eventslider',
            'title'				=> __('Eventslider'),
            'description'		=> __(''),
            'render_callback'	=> 'eventslider_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'calendar'
        ));
    }
}

function eventslider_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];

    $id = 'slider-' . $block['id'];
    $header = get_field('header');

    $events = get_field('event_element');

    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Event Slider</div>';
        $out.= '<div class="element site-inner el-slider">';

        $out.= '<hr /></div>';

    } else {

        // EVENT SLIDER
        $out = '<div id="'.$id.'" class="element element-eventswiper element-full-width '.$cssClass.'">';
        $out .= '<div class="container">';
        if ($header) {
            $out .= '<h2>'.$header.'</h2>';
        }
        $out .= '<div class="eventswiper swiper-container-horizontal" id="eventswiper-'.$id.'">';
        $out .= '<div class="swiper-wrapper">';

        foreach ($events as $event) {
            $archive_date = $event['archive_date'];
            $day = $event['date_start'];
            $monthFull = date('F', strtotime($day));
            $shortDate = substr($monthFull, 0, 3);

            if($archive_date > date("Ymd")) {
                $out .= '<div class="swiper-slide">';
                $out .= '<div class="event-inner">';

                $out .= '<div class="date-element-wrapper">
                        <div class="date-element">
                            <span class="day">'.date('d', strtotime($day)).'</span>
                            <div class="rotate-90">
                                <span class="month">'.$shortDate.'</span>
                                <span class="year">'.date('Y', strtotime($day)).'</span>
                            </div>
                        </div>
                    </div>';

                $out .= '<div class="event-content">';
                $out .= '<div class="event-divider"></div>';
                $out .= '<div class="event-datestring">'.$event['datestring'].'</div>';
                if($event['link']) {
                    $out .= '<a href="'.$event['link'].'" class="" title="mehr erfahren">';
                }
                $out .= '<h3 class="event-title">'.$event['title'].'</h3>';
                if($event['link']) {
                    $out .= '</a>';
                }
                $out .= '<div class="event-description small">'.$event['description'].'</div>';

                $out .= '</div>';
                $out .= '</div>';
                $out .= '</div>';
            }
        }

    $out .= '</div>';
    $out .= '</div>';

        if (count($events)>1) {
            $out .= '<div class="eventswiper-navigation-wrapper"><div class="container"><div class="swiper-button-prev swiper-button-prev-event"></div><div class="swiper-button-next swiper-button-next-event"></div></div></div>';
        }
    $out .= '</div>';
    $out .= '</div>';

    }
    echo $out;
}

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
            'icon'				=> 'slides'
        ));
    }
}

function slider_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];

    $id = 'slider-' . $block['id'];
    $images = get_field('images');
    $copyright = get_field('copryright');
    $size = 'medium';
    $sliderStyle = get_field('sliderstyle');

    if($images) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Slider</div>';
            $out.= '<div class="element site-inner el-slider">';

            foreach ($images as $k => $v) {
                $image = wp_get_attachment_image($v, 'thumbnail' );
                $out .= '<div>'.$image.'</div>';
            }

            $out.= '<hr /></div>';

        } else {

            if (is_array($images)) {

                if($sliderStyle == "sponsor") {
                    // SPONSOR SLIDER
                    $out = '<div id="'.$id.'" class="element element-sponsorswiper element-full-width '.$cssClass.'">';
                    $out .= '<div class="sponsorswiper swiper-container-horizontal" id="sponsorswiper-'.$id.'">';
                    $out .= '<div class="swiper-wrapper">';

                    foreach ($images as $image) {
                        $out .= '<div class="swiper-slide"><figure>';

                        if($image['alt']) {
                            $out .= '<a href="'.$image['alt'].'" target="_blank">';
                        }
                        $out .= '
                                        <img src="'. $image['sizes']['large'] .'" alt="" />
                                        <figcaption class="mt-2 small">'.$image['caption'].''.$image['description'].'</figcaption>
                                    ';

                        if($image['alt']) {
                            $out .= '</a>';
                        }
                        $out .= '</figure></div>';
                    }

                    $out .= '</div>';
                    $out .= '</div>';

                    if (count($images)>1) {
                        $out .= '<div class="swiper-button-prev swiper-button-prev-sponsor"></div><div class="swiper-button-next swiper-button-next-sponsor"></div>';
                    }

                } else {

                    $cycle = 1;
                    // CONTENT SLIDER
                    $out = '<div id="'.$id.'" class="element element-contentswiper element-full-width '.$cssClass.'">';
                    $out .= '<div class="contentswiper swiper-container-horizontal"  id="contentswiper-'.$id.'">';
                    $out .= '<div class="swiper-wrapper">';

                    foreach ($images as $image) {
                        $out .= '<div class="swiper-slide">
                                    <img src="'. $image['sizes']['large'] .'" alt="" />
                                    <figcaption id="figcaption-'.$cycle.'" class="d-none small">'.$image['caption'].''.$image['description'].'</figcaption>
                                </div>';
                        $cycle++;
                    }


                    $out .= '</div>';

                    if($copyright) {
                        $out .= '<div class="copyright" data-copyright-text="'.$copyright.'"><span>&copy;</span>'.$copyright.'</div>';
                    }

                    $out .= '</div>';

                    if (count($images)>1) {
                        $out .= '<div class="swiper-button-prev swiper-button-prev-content"></div><div class="swiper-button-next swiper-button-next-content"></div>';
                    }
                }
                $out .= '</div>';
            }

        }
        echo $out;
    }
}


/* Pressinformation
--------------------------------------------- */

add_action('acf/init', 'pressinformation_acf_init');
function pressinformation_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'pressinformation',
            'title'				=> __('Pressebereich zu Projekt'),
            'description'		=> __(''),
            'render_callback'	=> 'pressinformation_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-comments'
        ));
    }
}

function pressinformation_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];

    $id = 'pressinformation-' . $block['id'];
    $idOfPressinformation = get_field('event');

    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Presseinformation</div>';
        $out.= '<div class="element element-pressinformation">';

        $out .= '<div>';
        $out .= '</div>';
        $out.= '<hr /></div>';

    } else {

        $out = '<div id="'.$id.'" class="element-gutenberg waypoint-marker element-pressinformation '.$cssClass.'">
					<div class="row">
                        <div class="pressinformation-right">
                            <h2>'.get_field('header').'</h2>
                            '.get_field('text').'
                        </div>';
        $out .= '</div>';

        $thePost = get_post($idOfPressinformation);
        $out .= apply_filters('the_content',$thePost->post_content);

        $out .= '</div>';

//        showPosts();

    }
    echo $out;

}


/* CONTACTBOX
--------------------------------------------- */

add_action('acf/init', 'contactbox_acf_init');
function contactbox_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'contactbox',
            'title'				=> __('Kontakt'),
            'description'		=> __(''),
            'render_callback'	=> 'contactbox_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'admin-users'
        ));
    }
}

function contactbox_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'contactbox-' . $block['id'];

    $image = get_field('contactbox-bild');

    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Kontaktbox</div>';
        $out.= '<div class="element element-contact">';

        $out .= '<div>';
        $out .= '<img style="padding: 5px;" src="'.$image['sizes']['thumbnail'].'" />';
        $out .= '</div>';
        $out.= '<hr /></div>';

    } else {

        $schedule = get_field('contactbox-sprechzeiten');
        $schedulelist = explode(PHP_EOL, $schedule);

        if (is_array($schedulelist)) {
            $plan = '<table><tbody>';
            foreach ($schedulelist as $k => $v) {
                $items = explode('|', $v);
                if (is_array($items)) {
                    $plan .= '<tr>';
                    foreach ($items as $k2 => $v2) {
                        $plan .= '<td>'.$v2.'</td>';
                    }
                    $plan .= '</tr>';
                }
            }
            $plan .= '</tbody></table>';
        }


        $out = '<div class="element-gutenberg waypoint-marker element-contact '.$cssClass.'">
					<div class="row">
                        <div class="col-lg-4 offset-lg-1 col-md-5 offset-md-0 contact-left">
                            <div class="masked-image">
                            <svg viewbox="0 0 6.7 10">
                              <defs>
                                <clipPath id="clip">
                                  <polygon points="0 1, 6.7 3, 6.7 7, 0 9" />
                                </clipPath>
                              </defs>
                              <image xlink:href="'.$image['url'].'" x="0" y="0" height="10" width="6.7" clip-path="url(#clip)"/>
                            </svg>

                                <!-- <img src="'.$image['url'].'" title="'.$image['title'].'" alt="'.$image['alt'].'" /> -->
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1 col-md-7 offset-md-0 contact-right">
                            <div class="inner">
                                <h3>'.get_field('contactbox-name').'</h3>';

        if (get_field('contactbox-schwerpunkt')) {
            $out .= '<h4>'.get_field('contactbox-schwerpunkt').'</h4>';
        }

        $out .= get_field('contactbox-text').'';

        if($schedulelist[0] != "") {
            $out .=   '<div class="opening-hours table-responsive">
                                    '.$plan.'
                                </div>';
        }
        $out .= '</div>
                        </div>
                    </div>
                </div>';




    }
    echo $out;

}


/* GALLERY
--------------------------------------------- */

add_action('acf/init', 'gallery_acf_init');
function gallery_acf_init() {


    if( function_exists('acf_register_block') ) {


        acf_register_block(array(
            'name'				=> 'gallery',
            'title'				=> __('Galerie'),
            'description'		=> __(''),
            'render_callback'	=> 'gallery_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'images-alt',
            'keywords'			=> array( 'slider'),
        ));
    }
}

function gallery_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'gallery-' . $block['id'];

    $item = get_field('galleryelement');

    if($item) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Galerie</div>';
            $out.= '<div class="element site-inner el-gallery">';


            if (is_array($item)) {
                $out .= '<div>';
                foreach ($item as $k => $v) {
                    $imgsrc = wp_get_attachment_image_url ( $v['gallery-image'], 'thumbnail' );
                    $out .= '<img style="padding: 5px;" src="'.$imgsrc.'" />';
                }
                $out .= '</div>';
            }



            $out.= '<hr /></div>';

        } else {
            if (is_array($item)) {
                $out = '<div class="element imagegallery '.$cssClass.'">';
                $out .= '<div class="row">';
                foreach ($item as $k => $v) {

                    $imgsrc = wp_get_attachment_image_url ( $v['gallery-image'], 'full' );
                    $image = wp_get_attachment_image( $v['gallery-image'], 'doering-slider' );

                    $out .= '<div class="col-md-4">
                                <a href="'.$imgsrc.'" class="fancybox">'.$image.'</a>
                                <figcaption>'.$v['gallery-text'].'</figcaption>
							</div>';
                }

                $out .= '</div>';
                $out .= '</div>';
            }
        }
        echo $out;
    }
}


/* LINEUP
--------------------------------------------- */

add_action('acf/init', 'lineup_acf_init');
function lineup_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'lineup',
            'title'				=> __('lineup'),
            'description'		=> __(''),
            'render_callback'	=> 'lineup_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'groups',
            'keywords'			=> array( 'lineup'),
        ));
    }
}

function lineup_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'lineup-' . $block['id'];

    $artists = get_field('artists');

    if($artists) {

        if (is_admin() ) {

            $out = '<h3 style="font-style: italic;">lineup</h3>';
            $out.= '<hr />';

        } else {

            if (is_array($artists)) {

                $out = '<div id="'.$id.'" class="element-gutenberg waypoint-marker element-lineup '.$cssClass.'">';

                if(get_field('header')) {
                    $out .= '<h2>'.get_field('header').'</h2>';
                    $out .= '<p>'.get_field('text').'</p>';
                }

                $out .= '<div class="row same-height-row">';
                foreach ($artists as $artist) {

                    $thePost = get_post($artist);
                    $artistGenre = get_field('artist_genre', $thePost->ID);
                    $artistCountry = get_field('artist_country', $thePost->ID);
                    $artistWebsite = get_field('artist_website', $thePost->ID);
                    $artistFacebook = get_field('artist_facebook', $thePost->ID);
                    $artistInstagram = get_field('artist_instagram', $thePost->ID);
                    $artistTwitter = get_field('artist_twitter', $thePost->ID);
                    $artistSoundcloud = get_field('artist_soundcloud', $thePost->ID);
                    $artistYoutube = get_field('artist_youtube', $thePost->ID);


                    $out .= '<div class="col-lg-4 col-md-6 col-sm-12 animate__animated" data-animation="animate__backInRight">';
                    $out .= '<div class="element el-lineup">';
                    $out .= '<div class="el-lineup-inner">';
//                    $out .= apply_filters('the_content',$thePost->post_content);
                    $out .= '<div class="lineup-image masked-image">'.get_the_post_thumbnail( $artist, 'post-thumbnail' ).'</div>';
                    $out .= '<div class="artist-further-information">';
                    $out .= '<span class="artist-name">'.$thePost->post_title.'</span>';
                    if($artistGenre) {
                        $out .= '<span class="artist-genre">'.$artistGenre.'</span>';
                    }
                    if($artistCountry) {
                        $out .= '<span class="artist-country">'.$artistCountry.'</span>';
                    }
                    if($artistFacebook || $artistSoundcloud || $artistYoutube || $artistWebsite) {
                        $out .= '<span class="artist-socialmedia">';
                        if($artistWebsite) {
                            $out .= '<a href="'.$artistWebsite.'" title="'.$thePost->post_title.' Website" target="_blank"><em class="fa-solid fa-globe"></em></a>';
                        }
                        if($artistFacebook) {
                            $out .= '<a href="'.$artistFacebook.'" title="'.$thePost->post_title.' auf Facebook" target="_blank"><em class="fab fa-facebook-f"></em></a>';
                        }
                        if($artistInstagram) {
                            $out .= '<a href="'.$artistInstagram.'" title="'.$thePost->post_title.' auf Insta" target="_blank"><em class="fab fa-instagram"></em></a>';
                        }
                        if($artistTwitter) {
                            $out .= '<a href="'.$artistTwitter.'" title="'.$thePost->post_title.' auf Insta" target="_blank"><em class="fab fa-twitter"></em></a>';
                        }
                        if($artistSoundcloud) {
                            $out .= '<a href="'.$artistSoundcloud.'"  title="'.$thePost->post_title.' auf Soundcloud" target="_blank"><em class="fa-brands fa-soundcloud"></em></a>';
                        }
                        if($artistYoutube) {
                            $out .= '<a href="'.$artistYoutube.'"  title="'.$thePost->post_title.' auf YouTube" target="_blank"><em class="fab fa-youtube"></em></a>';
                        }
                        $out .= '</span>';
                    }

                    $out .= '</div>';

                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>';

                }
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
            'icon'				=> 'welcome-view-site',
            'keywords'			=> array( 'teaser'),
        ));
    }
}

function teaser_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'teaser-' . $block['id'];

    $teaser_elemente = get_field('teaser_elemente');

    if($teaser_elemente) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Teaser</div>';
            $out.= '<div class="element site-inner el-teaser">';
            $out .= '<h4>'.get_field('teaser-titel').'</h4>';
            $out.= '<hr /></div>';

        } else {
            if (is_array($teaser_elemente)) {

                $out = '<div id="'.$id.'" class="element-gutenberg waypoint-marker element-lineup '.$cssClass.'">';

                if(get_field('header')) {
                    $out .= '<h2>'.get_field('header').'</h2>';
                    $out .= '<p>'.get_field('text').'</p>';
                }

                $out .= '<div class="row same-height-row">';
                while( have_rows('teaser_elemente') ) : the_row();

                    $teTitle = get_sub_field('te-title');
                    $teText = get_sub_field('te-text');
                    $teLink = get_sub_field('te-link');
                    $teImage = get_sub_field('te-image');

                    $url = $teImage['url'];
                    $title = $teImage['title'];
                    $alt = $teImage['alt'];
                    $caption = $teImage['caption'];
                    $size = 'large';
                    $thumb = $teImage['sizes'][ $size ];
                    $width = $teImage['sizes'][ $size . '-width' ];
                    $height = $teImage['sizes'][ $size . '-height' ];

                    $out .= '<div class="col-lg-4 col-md-6 col-sm-12 animate__animated" data-animation="animate__backInRight">';
                    $out .= '<div class="element el-lineup">';
                    if($teLink['url']) {
                        $out .= '<a href="'.$teLink['url'].'" class="el-lineup-inner" title="'.$teTitle.'">';
                    } else {
                        $out .= '<span class="el-lineup-inner" title="'.$teTitle.'">';
                    }
                    $out .= '<div class="lineup-image masked-image"><img src="'.esc_url($thumb).'" alt="'.$teTitle.'" /></div>';
                    $out .= '<div class="artist-further-information"><span class="artist-name">'.$teTitle.'</span></div>';
                    if($teLink['url']) {
                        $out .= '</a>';
                    } else {
                        $out .= '</span>';
                    }
                    $out .= '</div>';
                    $out .= '</div>';

                endwhile;
                $out .= '</div>';
                $out .= '</div>';
            }

        }
        echo $out;
    }
}


/* DOWNLOADS
--------------------------------------------- */

add_action('acf/init', 'downloads_acf_init');
function downloads_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'downloads',
            'title'				=> __('Downloads'),
            'description'		=> __(''),
            'render_callback'	=> 'downloads_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'download',
            'keywords'			=> array( 'downloads'),
        ));
    }
}

function downloads_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'teaser-' . $block['id'];


    $downloads = get_field('downloadelemente');

    if($downloads) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Downloads</div>';
            $out .= '<div class="element site-inner el-teaser">';
            $out .= '<h4>'.get_field('titel').'</h4>';

            if (is_array($downloads)) {
                $out .= '<ul>';
                foreach ($downloads as $k => $v) {
                    $link = $v['datei'];
                    $out .= '<li>'.$link['title'].'</li>';
                }
                $out .= '</ul>';
            }

            $out .= '<hr /></div>';

        } else {

            if (is_array($downloads)) {
                $out = '<div class="element-gutenberg waypoint-marker element-downloads '.$cssClass.'">';
                $out .= '<h2>'.get_field('titel').'</h2>';
                $out .= '<div class="row"><div class="col-xl-8 col-lg-10 col-md-12 offset-xl-2 offset-lg-1 offset-md-0"><div class="row">';
                foreach ($downloads as $k => $v) {
                    $link = $v['datei'];
                    $out .= '<a href="'.$link['url'].'" title="'.$link['title'].'" target="_blank" class="element el-download"><em class="bi bi-download"></em><span>'.$link['title'].'</span></a>';
                }
                $out .= '</div></div></div>';
                $out .= '</div>';
            }
        }
        echo $out;
    }
}


/* HARD FACTS
--------------------------------------------- */

add_action('acf/init', 'hardfacts_acf_init');
function hardfacts_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'hardfacts',
            'title'				=> __('Hard Facts'),
            'description'		=> __(''),
            'render_callback'	=> 'hardfacts_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'welcome-widgets-menus',
            'keywords'			=> array( 'downloads'),
        ));
    }
}

function hardfacts_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'hardfacts-' . $block['id'];

    if(get_field('text')) {

        if (is_admin()) {

            $out = '<div style="font-style: italic;">Hard Facts</div>';
            $out .= '<div class="element site-inner el-hardfacts">';
            $out .= '<h4>'. get_field('text').'</h4>';

            $out .= '<hr /></div>';

        } else {

            $img = get_field('image');
            $image = wp_get_attachment_image($img, 'large' );

            $out = '<div id="'.$id.'" class="element-gutenberg waypoint-marker element-hard-facts '.$cssClass.'">';
            $out .= '<div class="row">';

            $out .= '<div class="col-lg-4 col-md-5 col-sm-12 hard-facts-image">';
            $out .= '<div class="claim">Hard<br>Facts</div>';
            $out .= $image;
            $out .= '</div>';

            $out .= '<div class="col-lg-8 col-md-7 col-sm-12">';
            $out .= '<div class="hard-facts-text">';
            $out .= get_field('text');
            $out .= '';
            $out .= '</div>';
            $out .= '<div class="hard-facts-action">';

            if(get_field('presslink')) {
                $out .= '<a href="'.get_field('presslink').'" class="btn">Pressebereich</a>';
            }

            if(get_field('hashtag')) {
                $out .= '<span class="hashtag"><i>#</i>'.get_field('hashtag').'</span>';
            }
            $out .= '<div class="hard-facts-socialmedia">';
            if(get_field('instragram_link') != "") {
                $out .= '<a href="'.get_field('instragram_link').'" target="_blank" title="'.get_field('hashtag').' auf Instagram"><em class="fab fa-instagram"></em></a>';
            }
            if(get_field('facebook_link') != "") {
                $out .= '<a href="'.get_field('facebook_link').'" target="_blank" title="'.get_field('hashtag').' auf Facecbook"><em class="fab fa-facebook-f"></em></a>';
            }
            if(get_field('linkedin_link') != "") {
                $out .= '<a href="'.get_field('linkedin_link').'" target="_blank" title="'.get_field('hashtag').' auf LinkedIn"><em class="fab fa-linkedin-in"></em></a>';
            }
            if(get_field('twitter_link') != "") {
                $out .= '<a href="'.get_field('twitter_link').'" target="_blank" title="'.get_field('hashtag').' auf Twitter"><em class="fab fa-twitter"></em></a>';
            }
            if(get_field('youtube_link') != "") {
                $out .= '<a href="'.get_field('youtube_link').'" target="_blank" title="'.get_field('hashtag').' auf Youtube"><em class="fab fa-youtube"></em></a>';
            }
            if(get_field('website_link') != "") {
                $out .= '<a href="'.get_field('website_link').'" target="_blank" title="'.get_field('hashtag').' Website"><em class="fa-solid fa-link"></em></a>';
            }
            $out .= '</div>';

            $out .= '</div>';
            $out .= '</div>';

            $out .= '</div>';
            $out .= '</div>';
        }
        echo $out;
    }
}

/* AKKORDEON
--------------------------------------------- */

add_action('acf/init', 'accordeon_acf_init');
function accordeon_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'accordeon',
            'title'				=> __('Akkordeon'),
            'description'		=> __(''),
            'render_callback'	=> 'accordeon_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'image-flip-vertical',
            'keywords'			=> array( 'downloads'),
        ));
    }
}

function accordeon_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'accordeon-' . $block['id'];

    $accordeon = get_field('accordeonelemente');

    if($accordeon) {

        if (is_admin()) {

            $out = '<div style="font-style: italic;">Akkordeon</div>';
            $out .= '<div class="element site-inner el-accordeon">';
            $out .= '<h4>'.get_field('titel').'</h4>';

            if (is_array($accordeon)) {
                $out .= '<ul>';
                foreach ($accordeon as $k => $v) {
                    $link = $v['datei'];
                    $out .= '<li>'.$link['titel'].'</li>';
                }
                $out .= '</ul>';
            }

            $out .= '<hr /></div>';

        } else {

            if (is_array($accordeon)) {
                $iterator = "0";
                $accordeonStyle = get_field('accordeonstyle');
                $accordeonStyle = get_field('accordeonstyle');

                $out = '<div class="element-gutenberg waypoint-marker element-collapsible '.$cssClass.'">';
                $out .= '<div class="accordion accordion-style-'.$accordeonStyle.'">';

                if($accordeonStyle == 'joboffer') {

                    foreach ($accordeon as $k => $v) {

                        $title = $v['titel'];
                        $inhalte = $v['inhalte'];
                        $teasertext = $v['teasertext'];
                        $download = $v['download'];
                        if($download['title']) {
                            $downloadLabel = $download['title'];
                        } else {
                            $downloadLabel = 'Download';
                        }

                        $out .= '<div class="accordion-item">
                        <div class="accordion-header" id="heading-'.$id."-".$iterator.'">
                          <h3 class="mb-0">
                          '.$title.'
                          </h3>
                          <p> '.$teasertext.'</p>
                        </div>

                        <a class="btn collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#collapse-'.$id."-".$iterator.'" aria-expanded="false" aria-controls="collapse-'.$id."-".$iterator.'">
                         <i class="fa-solid fa-angles-down"></i><span>mehr</span>
                         <i class="fa-solid fa-angles-up"></i><span>weniger</span>
                        </a>

                        <div id="collapse-'.$id."-".$iterator.'" class="collapse collapsing-content" aria-labelledby="heading-'.$id."-".$iterator.'" data-parent="#accordion" aria-expanded="false">
                          <div class="accordion-body '.$cssClass.'"> 
                             '.$inhalte.'
                          </div>';

                          if($download) {
                              $out .= '<div class="element-linkbutton">
                                        <a href="'.$download['url'].'" class="btn" title="'.$downloadLabel.'" target="_blank">
                                        <span class="material-symbols-outlined">download</span>
                                        <span>'.$downloadLabel.'</span>
                                        </a>
                                        </div>';
                          }


                        $out .= '</div>
                        </div>';

                        $iterator ++;
                    }

                } else {

                    foreach ($accordeon as $k => $v) {
                        $show = ($iterator == "0") ? 'show' : '';
                        $ariaExpanded = ($iterator == "0") ? 'true' : 'false';
                        $collapsed = ($iterator == "0") ? '' : 'collapsed';

                        $title = $v['titel'];
                        $inhalte = $v['inhalte'];
                        $out .= '<div class="accordion-item">
                        <div class="accordion-header" id="heading-'.$id."-".$iterator.'">
                          <h3 class="mb-0">
                            <a data-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#collapse-'.$id."-".$iterator.'" aria-expanded="'.$ariaExpanded.'" aria-controls="collapse-'.$id."-".$iterator.'" class="'.$collapsed.'">
                             <i class="fa-solid fa-angles-right"></i>'.$title.'
                            </a>
                          </h3>
                        </div>

                        <div id="collapse-'.$id."-".$iterator.'" class="collapse '.$show.'" aria-labelledby="heading-'.$id."-".$iterator.'" data-parent="#accordion" aria-expanded="false">
                          <div class="accordion-body '.$cssClass.'">
                             '.$inhalte.'
                          </div>
                        </div>
                        </div>';

                        $iterator ++;
                    }
                }

                $out .= '</div>';
                $out .= '</div>';
            }
        }
        echo $out;
    }
}



/* SCHEDULE
--------------------------------------------- */

add_action('acf/init', 'schedule_acf_init');
function schedule_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'schedule',
            'title'				=> __('Schedule'),
            'description'		=> __(''),
            'render_callback'	=> 'schedule_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'image-flip-horizontal',
            'keywords'			=> array( 'downloads'),
        ));
    }
}

function schedule_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'schedule-' . $block['id'];

    $schedule = get_field('scheduleelemente');

    if($schedule) {

        if (is_admin()) {

            $out = '<div style="font-style: italic;">Schedule</div>';
            $out .= '<div class="element site-inner el-schedule">';
            $out .= '<h4>'.get_field('titel').'</h4>';

            if (is_array($schedule)) {
                $out .= '<ul>';
                foreach ($schedule as $k => $v) {
                    $out .= '<li>'.$v['day'].$v['month'].$v['year'].'</li>';
                }
                $out .= '</ul>';
            }

            $out .= '<hr /></div>';

        } else {

            if (is_array($schedule)) {
                $iterator = 0;
                $position = "relative";
                $right = 0;
                $schedulestyle = get_field('schedulestyle');

                $out = '<div class="element-gutenberg waypoint-marker element-schedule '.$cssClass.'" id="'.$id.'">';

                if($schedulestyle == "scheduletabs") {
                    $out .= '<div class="schedule-navigation">';
                    $out .= '<div class="swiper-button-prev"></div>';
                    $out .= '<div class="swiper-button-next"></div>';
                    $out .= '</div>';
                }

                $out .= '<div class="schedule '.$schedulestyle.'">';

                if($schedulestyle == "scheduletabs") {
                    foreach ($schedule as $k => $v) {

                        $activestate = ($iterator == 0) ? ' active' : '';
                        $nextclass = ($iterator == 1) ? ' next' : '';
                        $prev = $iterator-1;
                        $next = $iterator+1;
                        $day = $v['day'];
                        $content = $v['content'];
                        $monthFull = date('F', strtotime($day));
                        $shortDate = substr($monthFull, 0, 3);

                        $out .= '<div class="schedule-item'.$activestate.' '.$nextclass.'" data-schedule-right="-'.$right.'" data-schedule-left="unset" data-schedule-slide="slide-'.$iterator.'" style="right: -'.$right.'px; position:'.$position.';">
                                <div class="date-element-wrapper">
                        
                               <div class="date-element date-element-top" data-schedule-slide-prev="slide-'.$prev.'" data-schedule-slide-next="slide-'.$next.'">
                                    <span class="day">'.date('d', strtotime($day)).'</span>
                                    <div class="rotate-90">
                                        <span class="month">'.$shortDate.'</span>
                                        <span class="year">'.date('Y', strtotime($day)).'</span>
                                    </div>
                               </div>
                               
                               <div class="date-element date-element-bottom" data-schedule-slide-prev="slide-'.$prev.'" data-schedule-slide-next="slide-'.$next.'">
                                    <span class="day">'.date('d', strtotime($day)).'</span>
                                    <div class="rotate-90">
                                        <span class="month">'.$shortDate.'</span>
                                        <span class="year">'.date('Y', strtotime($day)).'</span>
                                    </div>
                               </div>

                                </div>
        
                              <div class="schedule-body">
                                 '.$content.'
                              </div>
                            </div>';

                        $iterator ++;
                        if($iterator > 1) {
                            $right = $right + 300;
                        }
                        $position = 'absolute';
                    }
                } else {
                    foreach ($schedule as $k => $v) {

                        $activestate = ($iterator == 0) ? 'active' : '';
                        $day = $v['day'];
                        $content = $v['content'];
                        $monthFull = date('F', strtotime($day));
                        $shortDate = substr($monthFull, 0, 3);

                        $out .= '<div class="schedule-item slide-'.$iterator.' '.$activestate.'">
                                <div class="date-element-wrapper">
                                    <div class="date-element">
                                        <span class="day">'.date('d', strtotime($day)).'</span>
                                        <div class="rotate-90">
                                            <span class="month">'.$shortDate.'</span>
                                            <span class="year">'.date('Y', strtotime($day)).'</span>
                                        </div>
                                    </div>
                                </div>
        
                              <div class="schedule-body">
                                 '.$content.'
                              </div>
                            </div>';

                        $iterator ++;
                    }
                }

                $out .= '</div>';
                $out .= '</div>';
            }
        }
        echo $out;
    }
}


/* COUNTER
--------------------------------------------- */

add_action('acf/init', 'counter_acf_init');
function counter_acf_init() {




    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'counter',
            'title'				=> __('Counter'),
            'description'		=> __(''),
            'render_callback'	=> 'counter_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'editor-ol-rtl',
        ));
    }
}

function counter_acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    $cssClass = $block['className'];
    $id = 'counter-' . $block['id'];

    $counter = get_field('counterelement');

    if($counter) {

        if (is_admin() ) {

            $out = '<div style="font-style: italic;">Counter</div>';
            $out.= '<div class="element site-inner el-counter">';

            if (is_array($counter)) {
                $out .= '<ul>';
                foreach ( $counter as $k => $v ) {
                    $out .= '<li>' . $v['counter-text'] . '</li>';
                }
                $out .= '</ul>';
            }
            $out.= '<hr /></div>';

        } else {

            if (is_array($counter)) {

                $out = '<div class="element-gutenberg waypoint-marker element-counter '.$cssClass.'">';
                $out .= '<div class="row same-height-row">';

                if (count($counter) == 1) {
                    $class = 'col-lg-12 col-md-12 col-sm-12';
                }
                if (count($counter) == 2) {
                    $class = 'col-lg-6 col-md-6 col-sm-6';
                }
                if (count($counter) == 3) {
                    $class = 'col-lg-4 col-md-6 col-sm-6';
                }
                if (count($counter) == 4) {
                    $class = 'col-lg-3 col-md-6 col-sm-6';
                }


                foreach ($counter as $k => $v) {

                    if ($v['counter-number-jobs'][0] == 1) {
                        $number = file_get_contents('https://doering.t3cm.com/wp-content/plugins/jw-jobs/count.txt', true);
                    } else {
                        $number = $v['counter-number'];
                    }


                    $out .= '<div class="'.$class.'">';
                    $out .= '<div class="item">';
                    $out .= '<em>'.$v['operator'].' </em><span class="counter">'.$number.'</span>';
                    $out .= '<h3>'.$v['counter-text'].'</h3>';
                    $out .= '</div>';
                    $out .= '</div>';
                }


                $out .= '</div>';
                $out .= '</div>';

            }

        }
        echo $out;
    }
}




/* ARTICLE
--------------------------------------------- */

add_action('acf/init', 'article_acf_init');
function article_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a testimonial block
        acf_register_block(array(
            'name'				=> 'article',
            'title'				=> __('Article'),
            'description'		=> __(''),
            'render_callback'	=> 'article_acf_block_render_callback',
            'category'			=> 'formatting',
            'icon'				=> 'media-document',
        ));
    }
}

function article_acf_block_render_callback( $block ) {

    $cssClass = $block['className'];
    $layout = get_field('layout');
    $linkelement = get_field('link-element');
    $img = get_field('bildbereich');


    if (is_admin() ) {

        $out = '<div style="font-style: italic;">Article</div>';
        $out .= '<div class="element site-inner el-counter">';
        $out .= wp_get_attachment_image( $img, 'thumbnail' );
        $out .= '<hr /></div>';

    } else {

        $out = '<div class="element-gutenberg waypoint-marker element-text-image element-text-'.$layout.' '.$cssClass.'">';

        $image = wp_get_attachment_image( $img, 'large' );

        if (strlen(get_field('bildunterschrift')) > 2) {
            $caption = '<caption>'.get_field('bildunterschrift').'</caption>';
        }

        if (is_array($linkelement)) {
            $link = '';
            foreach ($linkelement as $k => $v) {
                if ($v['link']['target'] == '_blank') {
                    $class = 'btn-external';
                } else {
                    $class = 'btn-primary';
                }
                if (strlen($v['link']['target']) > 1) {
                    $target = ' target="'.$v['link']['target'].'" ';
                }

                $link .= '<a class="btn '.$class.'" href="'.$v['link']['url'].'" '.$target.'>'.$v['link']['title'].'</a>';
            }
        }

        if ($layout == 'imageleft') {
            $out .= '<div class="row">
                <div class="col-md-6">'.$image.$caption.'</div>
                <div class="col-md-5 offset-md-1">
                    '.get_field('text').'
                    '.$link.'
                </div>
            </div>';
        }
        if ($layout == 'imageright') {
            $out .= '<div class="row">
                <div class="col-md-5">
                    '.get_field('text').'
                    '.$link.'
                </div>
                <div class="offset-md-1 col-md-6">'.$image.$caption.'</div>
            </div>';
        }

        $out .= '</div>';

    }
    echo $out;

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
//
//add_filter( 'body_class', 'my_body_class' );
//function my_body_class( $classes ) {
//    $classes[] = get_field('pagecolor');
//    return $classes;
//}





/*********************
 *
 * 		OPTIONS
 *
 *********************/

/*

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

*/


?>
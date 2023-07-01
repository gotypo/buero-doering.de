<?php


/**********************************
  *
  * 	ACF
  *
 ***********************************/
 
 
 /*********************
 *
 * 		GUTENBERG
 *
 *********************/

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

	if(have_rows('teaseritem')) {


		if (is_admin() ) {

			$out = '<div style="font-style: italic;">Teaser</div>';
			$out.= '<div class="element el-deals">
		             <h2><span>'.get_field('headline').'</span></h2>';
				while ( have_rows('teaseritem') ) : the_row();

					$out .= '<p>'.get_sub_field('headline').'</p>';
				endwhile;


			$out.= '<hr /></div>';

		} else {

			if (get_field('bilder') == 2) {
				$imagestyle = 'image-round';
			}

			$out .= '<div class="element el-teaser '.get_field('background').'">
                    <div class="element-inside">
                        <h2><span><b>'.get_field('headline').'</b></span></h2>
                    </div>
                    <div class="color-container">
                        <div class="element-inside">
                            <div class="teaserblock '.$imagestyle.' item-'.get_field('view').'">';


			while ( have_rows('teaseritem') ) : the_row();

				$image = get_sub_field('image');
				$link = get_sub_field('link');

				if (is_array($link)) {
					$out .= '<div class="teaseritem">
	                            <a href="'.$link['url'].'">
	                                <div class="image"><img src="'.$image['sizes']['teaser-medium'].'" /></div>
	                                <h3>'.get_sub_field('headline').'</h3>
	                                <div class="text">
	                                    <p>'.get_sub_field('text').'</p>
	                                </div>
	                                <div class="link">
	                                    <a class="button" href="#">Link</a>
	                                </div>
	                            </a>
	                        </div>';
				} else {
					$out .= '<div class="teaseritem">
                                <div class="image"><img src="'.$image['sizes']['teaser-medium'].'" /></div>
                                <h3>'.get_sub_field('headline').'</h3>
                                <div class="text">
                                    <p>'.get_sub_field('text').'</p>
                                </div>
                        </div>';
				}


			endwhile;

			$out .= '</div></div></div></div>';
		}
		echo $out;
	}
}


/* TEASER WEBSTEITEN
--------------------------------------------- */

add_action('acf/init', 'wooddeals_acf_init');
function wooddeals_acf_init() {

	// check function exists
	if( function_exists('acf_register_block') ) {

		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'wooddeals',
			'title'				=> __('Wood-Deals'),
			'description'		=> __(''),
			'render_callback'	=> 'wooddeals_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'wooddeals'),
		));
	}
}

function wooddeals_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);
	$id = 'wooddeals-' . $block['id'];

	if(have_rows('wooddealitem')) {


		if (is_admin() ) {

			$out = '<div style="font-style: italic;">Teaser - Webseiten</div>';
			$out.= '<div class="element el-deals">
		             <h2><span>'.get_field('headline').'</span></h2>';
			$out.= '</div>';

		} else {

			$out .= '<div class="element el-woodteaser">
                <div class="element-inside">
                    <h2><span>'.get_field('headline').'</span></h2>
                </div>
                <div class="wood-container">
                    <div class="element-inside">';

						$i = 1;
						while ( have_rows('wooddealitem') ) : the_row();

							$i++;
							$mod = ($i%2)+1;

                            $image = get_sub_field('bild');
							$link = get_sub_field('link');

							if (is_array($link)) {
								$url = ($link['url']);
							}
							$out .= '<div class="item item-'.$mod.'">
	                            <a href="'.$url.'"> 
	                                <div class="img"><img src="'.$image['url'].'" /></div>
	                                <div class="text">
	                                    <h4>'.get_sub_field('headline').'</h4>
	                                    <p>'.get_sub_field('description').'</p>
	                                    <div class="button">Zum Angebot</div>
	                                </div>
	                            </a>
	                        </div>';

					    endwhile;

                 $out .= '</div>
                </div>
                <div class="grass-2"></div>
           </div>';
		}
		echo $out;
	}
}


/* KEYVISUAL
--------------------------------------------- */

add_action('acf/init', 'keyvisual_acf_init');
function keyvisual_acf_init() {

	if( function_exists('acf_register_block') ) {
		acf_register_block(array(
			'name'				=> 'keyvisual',
			'title'				=> __('Keyvisual'),
			'description'		=> __(''),
			'render_callback'	=> 'keyvisual_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'keyvisual'),
		));
	}
}

function keyvisual_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);
	$id = 'keyvisual-' . $block['id'];
	$image = get_field('image');

	if (is_admin() ) {
		$out = '
			<div class="element el-keyvisual '.$id.'">
				<div style="font-style: italic;">Keyvisual</div>
				<div class="textblock">
					<div><h3>'.get_field('headline').'</h3></div>
					<div>'.get_field('text').'</div>
				</div>
		    </div> ';
	} else {
		$out = '
			<div class="element el-keyvisual '.$id.'">
				<div class="image" style="background-image: url('.$image['url'].');">
					<div class="gradient"></div>
					<div class="textblock">
						<div class="headline">'.get_field('headline').'</div>
						<div class="text">'.get_field('text').'</div>
					</div>
		            <div class="grass"></div>
		        </div>
		    </div> ';
	}

	echo ($out);
}


/* TEXT
--------------------------------------------- */

add_action('acf/init', 'text_acf_init');
function text_acf_init() {

	// check function exists
	if( function_exists('acf_register_block') ) {

		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'text',
			'title'				=> __('Textfeld'),
			'description'		=> __(''),
			'render_callback'	=> 'text_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'text'),
		));
	}
}
function text_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);
	$id = 'text-' . $block['id'];

	if (is_admin() ) {
		$out = '<div style="font-style: italic;">Text</div>';
		$out.= '<div class="element element-inside el-text corn '.$id.'">'.get_field('text').'</div>';
	} else {
		$out = '<div class="element element-inside el-text corn '.$id.'">'.get_field('text').'</div>';
	}

	echo ($out);
}


/* DEALS
--------------------------------------------- */

add_action('acf/init', 'deals_acf_init');
function deals_acf_init() {

	// check function exists
	if( function_exists('acf_register_block') ) {

		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'deals',
			'title'				=> __('Deals'),
			'description'		=> __(''),
			'render_callback'	=> 'deals_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'deals'),
		));
	}
}
function deals_acf_block_render_callback( $block ) {

	$slug = str_replace('acf/', '', $block['name']);
	$id = 'deals-' . $block['id'];

	if(have_rows('dealitem')) {


		if (is_admin() ) {

			$out = '<div style="font-style: italic;">Deals</div>';
			$out.= '<div class="element el-deals">
		             <h2><span>'.get_field('headline').'</span></h2>';
						while ( have_rows('dealitem') ) : the_row();
							$out .= '<h4>'.get_sub_field('dealheadline').'</h4>
								     <p>'.get_sub_field('dealtext').'</p> ';
					    endwhile;
			 $out.= '</div>';

		} else {

			$out .=  '<div class="element el-deals">
	            <div class="element-inside">
	                <h2><span>'.get_field('headline').'</span></h2>
	            </div>
	            <div class="wood-container">
	                <div class="element-inside">
	                    <div class="swiper-container">
	                        <div class="swiper-wrapper">';
	                           while ( have_rows('dealitem') ) : the_row();

	                                $image = get_sub_field('dealimage');

									$out .= '<div class="swiper-slide">
										<div class="deals-item">
										    <div class="text">
										        <div class="textcontainer">
										            <h4>'.get_sub_field('dealheadline').'</h4>
										            <p>'.get_sub_field('dealtext').'</p>
										            
										        </div>
										    </div>
										    <div class="img"><img src="'.$image['url'].'" /></div>
										</div>
									</div>';
							    endwhile;
	                     $out .= '</div>
	                        <div class="swiper-button-next"></div>
	                        <div class="swiper-button-prev"></div>
	                    </div>
	                </div>
	            </div>
	            <div class="grass-2"></div>
	       </div>';
		}
		echo $out;
	}
}
 
 
 
 

/*********************
 *
 * 		SLIDER
 *
 *********************/

add_action( 'genesis_before_header', 'page_slides_loop' );
function page_slides_loop() {

	if(have_rows('slide')) {

		$output = '<div class="header-swiper site-swiper"><div class="swiper-container"><div class="swiper-wrapper">';
		$i = 0;
	    while ( have_rows('slide') ) : the_row();
			$i++;
			//if ($i == 1) {
				$image = get_sub_field('image');
				$output .= '<div class="swiper-slide">';
				$output .= '<div class="swiper-slide-image" style="background-image: url('.$image['url'].');"></div>';
				$output .= '<div class="claim"><div class="claim-inside">';
		        $output .= '<div class="circle1"></div>';
		        $output .= '<div class="circle2"></div>';
		        $output .= '<div class="text1">'.get_sub_field('text_1').'</div>';
		        $output .= '<div class="text2">'.get_sub_field('text_2').'</div>';
		        $output .= '<div class="border"></div>';
		        $output .= '</div></div>';
				$output .= '</div>';
			//}
	    endwhile;

		$output .= '</div>';

		if (is_page( 17 )) {
			$output .= '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
		}
		$output .= '</div></div>';
		echo $output;
	}
}


/*********************
 *
 * 		CONTENT
 *
 *********************/

add_action( 'genesis_after_header', 'pagecontent1', 10);
function pagecontent1() {
	$contentlayout = '<div class="content-start"><div class="makotel-circle"></div></div>';
	echo $contentlayout;
}

/*********************
 *
 * 		CONTENT
 *
 *********************/

add_action( 'genesis_after_header', 'pagecontent', 20);
function pagecontent() {

	if(have_rows('inhalte')) {
		$contentlayout = '<div class="layout-content">';
		$i = 0;
		while ( have_rows( 'inhalte' ) ): the_row();
			$i++;
			if ( get_row_layout() == 'inhalt' ):
				$contentlayout .= '<div class="l-content color-' . get_sub_field( 'hintergrund' ) . ' rows-1 count-'.$i.'" id="pos-'.$i.'">';
				$contentlayout .= '<div id="site-inner" class="site-inner">';
				$contentlayout .= '<div class="c-left c-text">' . get_sub_field( 'textbild' ) . '</div>';
				$contentlayout .= '<div class="clearfix"></div>';
				$contentlayout .= '</div></div>';
			endif;

			if ( get_row_layout() == 'inhalt_mehrspaltig' ):
				$contentlayout .= '<div class="l-content color-' . get_sub_field( 'hintergrund' ) . ' rows-' . get_sub_field( 'anzahl_spalten' ) . ' count-'.$i.'" id="pos-'.$i.'">';
				$contentlayout .= '<div class="site-inner">';
				$contentlayout .= '<div class="c-left c-text">' . get_sub_field( 'textbild_links' ) . '</div>';
				if (get_sub_field( 'anzahl_spalten' ) == '3') {
					$contentlayout .= '<div class="c-center c-text">' . get_sub_field( 'textbild_mitte' ) . '</div>';
				}
				$contentlayout .= '<div class="c-right c-text">' . get_sub_field( 'textbild_rechts' ) . '</div>';
				$contentlayout .= '<div class="clearfix"></div>';
				$contentlayout .= '</div></div>';
			endif;

			if ( get_row_layout() == 'inhalt_trainer' ):
				if(get_field('trainer-text')) {

					$contentlayout .= '<div class="l-content color-white"><div class="site-inner">';
					$contentlayout .= '<div class="trainer-text">'.get_field('trainer-text').'</div>';
					$contentlayout .= '<div class="clearfix"></div>';
					if(have_rows('trainer')) {
						while ( have_rows('trainer') ) : the_row();
							$image = get_sub_field('bild');
							$contentlayout .= '<div class="trainer-row">';
							$contentlayout .= '<div class="t-image"><img src="'.$image['url'].'" /></div>';
							$contentlayout .= '<p><b>'.get_sub_field('titel').'</b></p>';
							$contentlayout .= '<p>'.get_sub_field('untertitel').'</p>';
							$contentlayout .= '</div>';
						endwhile;
					}

					$contentlayout .= '</div><div class="clearfix"></div></div>';
				}
			endif;


			if ( get_row_layout() == 'inhalt_block' ):

				/* contentblock - form1 */
				if (get_sub_field( 'auswahl' ) == 'form1') {
					if(get_field('kontakt_links', 'option') || get_field('kontakt_rechts', 'option')) {
						$contentlayout .= '<div class="l-content color-white rows-2 count-'.$i.'" id="pos-'.$i.'"><div class="site-inner">';
						$contentlayout .= '<div class="c-left c-text">'.get_field('kontakt_links', 'option').'</div>';
						$contentlayout .= '<div class="c-right c-text">'.get_field('kontakt_rechts', 'option').'</div>';
						$contentlayout .= '</div><div class="clearfix"></div></div>';
					}
				}

				/* contentblock - form2 */
				if (get_sub_field( 'auswahl' ) == 'form2') {
					if(get_field('kontakt_links2', 'option') || get_field('kontakt_rechts2', 'option')) {
						$contentlayout .= '<div class="l-content color-white rows-2 count-'.$i.'" id="pos-'.$i.'"><div class="site-inner">';
						$contentlayout .= '<div class="c-left c-text">'.get_field('kontakt_links2', 'option').'</div>';
						$contentlayout .= '<div class="c-right c-text">'.get_field('kontakt_rechts2', 'option').'</div>';
						$contentlayout .= '</div><div class="clearfix"></div></div>';
					}
				}

				/* contentblock - references */
				if (get_sub_field( 'auswahl' ) == 'references') {
					if(have_rows('c-reference', 'option')) {
						$contentlayout .= '<div class="l-content color-black l-references count-'.$i.'" id="pos-'.$i.'">';
						$contentlayout .= '<div class="l-references-icon"></div>';
						$contentlayout .= '<div class="site-inner">';
						$contentlayout .= '<div class="site-swiper"><div class="swiper-references"><div class="swiper-wrapper">';

						while ( have_rows('c-reference', 'option') ) : the_row();
							$image = get_sub_field('bild');
							$contentlayout .= '<div class="swiper-slide">';
							$contentlayout .= '<div class="title"><h3>'.get_sub_field('titel').'</h3></div>';
							$contentlayout .= '<div class="image"><img src="'.$image['url'].'" /></div>';
							$contentlayout .= '<div class="text">'.get_sub_field('text').'</div>';
							$contentlayout .= '</div>';

						endwhile;

						$contentlayout .= '</div>';
						$contentlayout .= '<div class="swiper-pagination"></div>';
						$contentlayout .= '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
						$contentlayout .= '</div></div>';
						$contentlayout .= '</div></div>';
					}
				}

				/* contentblock - clients */
				if (get_sub_field( 'auswahl' ) == 'clients') {
					if(have_rows('c-clients', 'option')) {
						$contentlayout .= '<div class="l-content color-black rows-1 count-'.$i.'" id="pos-'.$i.'"><div class="site-inner">';
						$contentlayout .= '<div class="c-left c-text"><h3>Unsere zufriedene Kunden</h3><p>';
						while ( have_rows('c-clients', 'option') ) : the_row();
							$image = get_sub_field('bild');
							$contentlayout .= '<img src="'.$image['url'].'" />';
						endwhile;
						$contentlayout .= '</p></div><div class="clearfix"></div></div></div>';
					}
				}

				/* contentblock - quote */
				if (get_sub_field( 'auswahl' ) == 'quotes') {
					if(have_rows('c-quote', 'option')) {


						$contentlayout .= '<div class="l-content color-black l-references l-quote">';
						$contentlayout .= '<div class="l-references-icon"></div>';
						$contentlayout .= '<div class="site-inner">';
						$contentlayout .= '<div class="title"><h3>Zitate unserer Mitarbeiter</h3></div>';
						$contentlayout .= '<div class="site-swiper"><div class="swiper-references quotes"><div class="swiper-wrapper">';

						while ( have_rows('c-quote', 'option') ) : the_row();
							$image = get_sub_field('bild');
							$contentlayout .= '<div class="swiper-slide">';

							$contentlayout .= '<div class="image"><img src="'.$image['url'].'" /></div>';
							$contentlayout .= '<div class="text"><h4>'.get_sub_field('titel').'</h4>'.get_sub_field('text').'</div>';
							$contentlayout .= '</div>';

						endwhile;

						$contentlayout .= '</div>';
						$contentlayout .= '<div class="swiper-pagination"></div>';
						$contentlayout .= '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
						$contentlayout .= '</div></div>';
						$contentlayout .= '</div></div>';

					}
				}

				/* contentblock - faqs */
				if (get_sub_field( 'auswahl' ) == 'faqs') {
					if(have_rows('c-faqs', 'option')) {
						$contentlayout .= '<div class="l-content color-grey">';
						$contentlayout .= '<div class="site-inner"><div class="c-faqs">';
						$contentlayout .= '<div class="title"><h2>FAQ</h2></div>';
						while ( have_rows('c-faqs', 'option') ) : the_row();
							$contentlayout .= '<div class="faqs text"><h4>'.get_sub_field('titel').'</h4><div class="container">'.get_sub_field('text').'</div></div>';
						endwhile;
						$contentlayout .= '</div></div></div>';
					}
				}



			endif;



        endwhile;
        $contentlayout .= '</div>';
    }


	echo $contentlayout;

}








/*********************
 *
 * 		SIDEBAR
 *
 *********************/

add_action( 'genesis_before_content', 'pagesidebar', 25);
function pagesidebar() {

	if(have_rows('teaserbox')) {
		$output .= '<div class="teaser-area">';
		$i = 0;
	    while ( have_rows('teaserbox') ) : the_row();
			$i++;
			//if ($i == 1) {
				$output .= '<div class="teaser-container c-'.get_sub_field('farbe').'">';
				$output .= get_sub_field('inhalte');
				$output .= '</div>';
			//}
	    endwhile;
		$output .= '</div>';
		echo $output;
	}

}



/*********************
 *
 * 		MENU ITEMS
 *
 *********************/

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {

	foreach( $items as &$item ) {
		$title2 = get_field('title_2', $item);
		if( $title2 ) {
			$item->title = '<span class="m-item-1">'.$title2.'</span><span class="m-item-2">'.$item->title.'</span>';
		}
	}
	return $items;
}


/*********************
 *
 * 		OPTIONS PAGE
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
		'page_title' 	=> 'Clients',
		'menu_title'	=> 'Clients',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'References',
		'menu_title'	=> 'References',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Quotes',
		'menu_title'	=> 'Quotes',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'FAQs',
		'menu_title'	=> 'FAQs',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contactform 1',
		'menu_title'	=> 'Contactform 1',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Contactform 2',
		'menu_title'	=> 'Contactform 2',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}







?>
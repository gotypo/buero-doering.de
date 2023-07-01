<?php
/**
 * Genesis Bootstrap
 *
 * This file adds functions to the Custom Theme.
 *
 * @package Custom
 * @author  gotypo
 * @link    https://www.gotypo.de/
 */

/*--- INCLUDE LIB --*/
add_action( 'genesis_setup', 'gb_include_lib', 15 );
function gb_include_lib() {
		foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) {
			include $file;
		}
}

/*--- MISC --*/
//include_once( get_stylesheet_directory() . '/lib/misc/theme-customizer.php' );
//include_once( get_stylesheet_directory() . '/lib/misc/featureimage.php' );

/*--- INCLUDE PLUGINS --*/
include_once( get_stylesheet_directory() . '/lib/modules/fancybox/fancybox.php' );
include_once( get_stylesheet_directory() . '/lib/modules/klaro/klaro.php' );
include_once( get_stylesheet_directory() . '/lib/modules/swiper/swiper.php' );
include_once( get_stylesheet_directory() . '/lib/modules/acf/acf.php' );

//include_once( get_stylesheet_directory() . '/lib/modules/leaflet/leaflet.php' );
//include_once( get_stylesheet_directory() . '/lib/modules/datatables/datatables.php' );
//include_once( get_stylesheet_directory() . '/lib/modules/fselect/fselect.php' );
include_once( get_stylesheet_directory() . '/lib/modules/waypoints/waypoints.php' );

// IMAGE SIZES
add_image_size( 'divider-image', 1200, 650 ); // Image for Divider
add_image_size( 'masked-image', 500, 420 ); // Image mask
add_image_size( 'cube-image', 600, 600 ); // Image Cubic

// ADD CLASSES TO PREV NEXT BUTTONS
add_filter('next_posts_link_attributes', 'posts_linkprev_attributes');
add_filter('previous_posts_link_attributes', 'posts_linknext_attributes');

function posts_linkprev_attributes() {
    return 'class="btn btn-blog btn-blog-next"';
}

function posts_linknext_attributes() {
    return 'class="btn btn-blog btn-blog-prev"';
}

// ADD CLASSES TO TINYMCE EDITOR
// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

//SVG-SUPPORT
/**
 * Add svg support
 **/
add_filter( 'wp_check_filetype_and_ext', function( $data, $file, $filename, $mimes) {
    global $wp_version;
    if( $wp_version == '4.7' || ( (float) $wp_version < 4.7 ) ) {
        return $data;
    }
    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );

function dl_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'dl_mime_types' );

function dl_fix_svg() {
    echo '<style type="text/css">.attachment-266x266, .thumbnail img { width: 100% !important; height: auto !important;} </style>';
}
add_action( 'admin_head', 'dl_fix_svg' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => '.translation',
            'block' => 'blockquote',
            'classes' => 'translation',
            'wrapper' => true,

        ),
        array(
            'title' => '⇠.rtl',
            'block' => 'blockquote',
            'classes' => 'rtl',
            'wrapper' => true,
        ),
        array(
            'title' => '.ltr⇢',
            'block' => 'blockquote',
            'classes' => 'ltr',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = wp_json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

/**
* custom Logo admin panel
*/
function my_login_logo_one() {
?>
    <style type="text/css"> body.login div#login h1 a { background-image: url('/wp-content/themes/bootstrap-doering/assets/images/logo-de.png'); padding-bottom: 30px; } </style>
 <?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo_one' );


//SET COLORSCHEME TO HTMLTAG
add_filter( 'language_attributes', 'add_color_scheme_to_html', 10, 2 );
function add_color_scheme_to_html( $output, $doctype ) {
    $colorclass = get_field('pagecolor');

    if ( 'html' !== $doctype ) {
        return $output;
    }

    $output .= ' class="'.$colorclass.'"';

    return $output;
}
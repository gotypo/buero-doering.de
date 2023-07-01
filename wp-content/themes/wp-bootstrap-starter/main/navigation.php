<?php

/**********************************
 *
 * 	CORE NAVIGATION
 *
 ***********************************/


// Renames primary and secondary navigation menus / remove certain menu
add_theme_support(
    'genesis-menus', array(
        'primary'   => __( 'Header Menu', 'genesis-sample' ),
        'secondary'   => __( 'Footer Menu', 'genesis-sample' ),
    )
);

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );


/**********************************
 *
 * 	RESPONSIVE MENU
 *
 ***********************************/


// Registers the responsive menus.
if ( function_exists( 'genesis_register_responsive_menus' ) ) {
    genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
}






/**********************************
 *
 * 	NAVIGATION
 *
 ***********************************/





/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

    if ( 'secondary' === $args['theme_location'] ) {
        $args['depth'] = 1;
    }

    return $args;

}

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );



// wrap primary navigation
/*
add_filter( 'genesis_do_nav', 'genesis_child_nav', 10, 3 );
function genesis_child_nav($nav_output, $nav, $args) {
	return '<div class="nav-primary-wrapper"><a href="'.get_home_url().'" class="dashicons-before dashicons-home"><span>Home</span></a>' . $nav_output . '</div>';
}
*/

//* Wrap .nav-secondary in a custom div
add_filter( 'genesis_do_subnav', 'genesis_child_subnav', 10, 3 );
function genesis_child_subnav($subnav_output, $subnav, $args) {

    return '<div class="nav-secondary-wrapper">' . $subnav_output . '</div>';

}


/*-------------------
	MENU
---------------------*/

/*
remove_theme_support ( 'genesis-menus' );
add_theme_support ( 'genesis-menus' , array (
	'primary' => 'Primary Navigation Menu' ,
	'secondary' => 'Second Navigation Menu' ,
	'third-menu' => 'Third Navigation Menu'
) );

add_action( 'genesis_after_header', 'genesis_do_thirdnav' );
function genesis_do_thirdnav() {
	wp_nav_menu( array( 'theme_location' => 'third-menu', 'container_class' => 'genesis-nav-menu' ) );
}
*/

/*-------------------
	BREADCRUMB
---------------------*/






/*-------------------
	SUBMENU
---------------------*/

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
    if ( isset( $args->sub_menu ) ) {
        $root_id = 0;

        // find the current menu item
        foreach ( $sorted_menu_items as $menu_item ) {
            if ( $menu_item->current ) {
                // set the root id based on whether the current menu item has a parent or not
                $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
                break;
            }
        }

        // find the top level parent
        if ( ! isset( $args->direct_parent ) ) {
            $prev_root_id = $root_id;
            while ( $prev_root_id != 0 ) {
                foreach ( $sorted_menu_items as $menu_item ) {
                    if ( $menu_item->ID == $prev_root_id ) {
                        $prev_root_id = $menu_item->menu_item_parent;
                        // don't set the root_id to 0 if we've reached the top of the menu
                        if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
                        break;
                    }
                }
            }
        }
        $menu_item_parents = array();
        foreach ( $sorted_menu_items as $key => $item ) {
            // init menu_item_parents
            if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
            if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
                // part of sub-tree: keep!
                $menu_item_parents[] = $item->ID;
            } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
                // not part of sub-tree: away with it!
                unset( $sorted_menu_items[$key] );
            }
        }

        return $sorted_menu_items;
    } else {
        return $sorted_menu_items;
    }
}

?>
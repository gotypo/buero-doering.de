<?php





/**********************************
 *
 * 	GUTENBERG
 *
 ***********************************/


function my_plugin_blacklist_blocks() {
    wp_enqueue_script( 'my-plugin-blacklist-blocks', get_stylesheet_directory_uri() . '/js/gutenberg.js', array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ));
}
add_action( 'enqueue_block_editor_assets', 'my_plugin_blacklist_blocks' );



function legit_block_editor_styles() {
    wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/css/editor-style.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );




/**********************************
 *
 * 	EDITOR - ENABLE MENUS
 *
 ***********************************/

// enable theme settings for editors
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

if (current_user_can('editor')) {
    remove_theme_support( 'custom-header' );
    remove_theme_support( 'genesis-admin-menu' );
}

add_action('admin_head', 'hide_menu');
function hide_menu() {

    if (current_user_can('editor')) {

        /*--  DESIGN --*/
        remove_submenu_page( 'themes.php', 'themes.php' );
        remove_submenu_page( 'themes.php', 'widgets.php' );

        global $submenu;
        unset($submenu['themes.php'][6]);

        /*--  NAVIGATION --*/
        remove_menu_page('tools.php');
        //remove_menu_page('edit.php');
        remove_menu_page('edit-comments.php');

    }
}






/* --------- FIND MENU ITEMS */
/*
add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );

function wpse_136058_debug_admin_menu() {

    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
}
*/



/*
 *  REGISTRIERT NEUE NUTZER ROLLEN
 *  FÜR KUNDEN / CLIENTS
 *
 *  Client Master > Kann alles vom Editor + Nutzer, Menüs, Widgets & Customzier bearbeiten
 *  Client User   > Kann alles vom Editor + Menüs & Widgets bearbeiten
 *
 *  Clients können nichts updaten oder selbst installieren
 *
 */

add_action( 'admin_init', 'user_role_clients' );

function user_role_clients() {

    // *** ROLLE: CLIENT MASTER USER ***
    // Prüfen ob "Client Master User" bereits existiert
    if ( !get_role( 'client_master_user' ) ) {
        $user_capabilities = get_role( 'editor' )->capabilities; // Basis ist die 'Editor'-Rolle
        $user_capabilities = array_merge(
            $user_capabilities,
            // Zusätzliche Optionen hier hinzufügen
            array(
                // Client Master kann jetzt Nutzer bearbeiten
                'list_users'	=> true,
                'create_users'  => true,
                'edit_users'	=> true,
                'promote_users' => true,
                'delete_users'  => true,
                'remove_users'  => true,

                'mailpoet_access_plugin_admin' => true,
                'mailpoet_manage_emails' => true,
                'mailpoet_manage_subscribers' => true,
                'mailpoet_manage_segments' => true,
                'mailpoet_manage_settings' => true,

                // Client Master kann Menüs & Widgets bearbeiten
                'edit_theme_options' => false,

                // Client Master kann in das Theme>Custumize Menü gehen
                'customize' => false,
            )
        );
        add_role( 'client_master_user', 'Client Master-User', $user_capabilities ); // Nutzer-Rolle hinzufügen
    }

    // *** ROLLE: CLIENT USER ***
    // Prüfen ob "Client  User" bereits existiert
    if ( !get_role( 'client_user' ) ) {
        $user_capabilities = get_role( 'editor' )->capabilities; // Basis ist die 'Editor'-Rolle
        $user_capabilities = array_merge(
            $user_capabilities,
            // Zusätzliche Optionen hier hinzufügen
            array(
                // Client User kann Menüs & Widgets bearbeiten
                'edit_theme_options' => true,
            )
        );
        add_role( 'client_user', 'Client User', $user_capabilities ); // Nutzer-Rolle hinzufügen
    }

}







/**********************************
 *
 * 	GRAVATAR
 *
 ***********************************/


add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

    return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

    $args['avatar_size'] = 60;
    return $args;

}

?>
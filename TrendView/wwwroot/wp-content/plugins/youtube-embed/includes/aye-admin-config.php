<?php
/**
* Admin Config Functions
*
* Various functions relating to the various administration screens
*
* @package	Artiss-YouTube-Embed
*/

/**
* Add Settings link to plugin list
*
* Add a Settings link to the options listed against this plugin
*
* @since	2.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function aye_add_settings_link( $links, $file ) {

	static $this_plugin;

	if ( !$this_plugin ) { $this_plugin = plugin_basename( __FILE__ ); }

	if ( strpos( $file, 'youtube-embed.php' ) !== false ) {
		$settings_link = '<a href="admin.php?page=aye-general-options">' . __( 'Settings' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

add_filter( 'plugin_action_links', 'aye_add_settings_link', 10, 2 );

/**
* Add meta to plugin details
*
* Add options to plugin meta line
*
* @since	2.0
*
* @param	string  $links	Current links
* @param	string  $file	File in use
* @return   string			Links, now with settings added
*/

function aye_set_plugin_meta( $links, $file ) {

	if ( strpos( $file, 'youtube-embed.php' ) !== false ) {

		$links = array_merge( $links, array( '<a href="admin.php?page=aye-display-about">' . __( 'Support' ) . '</a>' ) );

		$links = array_merge( $links, array( '<a href="http://www.artiss.co.uk/donate">' . __( 'Donate' ) . '</a>' ) );
	}

	return $links;
}

add_filter( 'plugin_row_meta', 'aye_set_plugin_meta', 10, 2 );

/**
* Admin Screen Initialisation
*
* Set up admin menu and submenu options
*
* @since	2.0
*
* @uses     aye_contextual_help_type    Work out help type
*/

function aye_menu_initialise() {

    // Depending on WordPress version and available functions decide which (if any) contextual help system to use

    $contextual_help = aye_contextual_help_type();

    // Add main admin option

	add_menu_page( __( 'Artiss YouTube Embed Settings' ), __( 'YouTube' ), 'manage_options', 'aye-general-options', 'aye_general_options', plugins_url() . '/youtube-embed/images/menu_icon.png' );

    // Add options sub-menu

    if ( $contextual_help == 'new' ) { global $aye_options_hook; }

	$aye_options_hook = add_submenu_page( 'aye-general-options', __( 'Artiss YouTube Embed Options' ),  __( 'Options' ), 'edit_posts', 'aye-general-options', 'aye_general_options' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $aye_options_hook, 'aye_add_options_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $aye_options_hook, aye_options_help() ); }

    // Add profiles sub-menu

    if ( $contextual_help == 'new' ) { global $aye_profiles_hook; }

	$aye_profiles_hook = add_submenu_page( 'aye-general-options', __( 'Artiss YouTube Embed Profiles' ), __( 'Profiles' ), 'edit_posts', 'aye-profile-options', 'aye_profile_options' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $aye_profiles_hook, 'aye_add_profiles_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $aye_profiles_hook, aye_profiles_help() ); }

    // Add lists sub-menu

    if ( $contextual_help == 'new' ) { global $aye_lists_hook; }

	$aye_lists_hook = add_submenu_page( 'aye-general-options', __( 'Artiss YouTube Embed Lists' ), __( 'Lists' ), 'edit_posts', 'aye-list-options', 'aye_list_options' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $aye_lists_hook, 'aye_add_lists_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $aye_lists_hook, aye_lists_help() ); }

    // Add readme sub-menu

    if ( function_exists( 'wp_readme_parser' ) ) {
        add_submenu_page( 'aye-general-options', __( 'Artiss YouTube Embed README' ), __( 'README' ), 'edit_posts', 'aye-support-readme', 'aye_support_readme' );
    }

    // Add about sub-menu

    if ( $contextual_help == 'new' ) { global $aye_about_hook; }

	$aye_about_hook = add_submenu_page( 'aye-general-options', __( 'About Artiss YouTube Embed' ), __( 'About' ), 'edit_posts', 'aye-support-about', 'aye_support_about' );

    if ( $contextual_help == 'new' ) { add_action( 'load-' . $aye_about_hook, 'aye_add_about_help' ); }

    if ( $contextual_help == 'old' ) { add_contextual_help( $aye_about_hook, aye_about_help() ); }

}

add_action( 'admin_menu', 'aye_menu_initialise' );

/**
* Get contextual help type
*
* Return whether this WP installation requires the new or old contextual help type, or none at all
*
* @since	2.5
*
* @return   string			Contextual help type - 'new', 'old' or false
*/

function aye_contextual_help_type() {

    global $wp_version;

    $type = false;

    if ( ( float ) $wp_version >= 3.3 ) {
        $type = 'new';
    } else {
        if ( function_exists( 'add_contextual_help' ) ) {
            $type = 'old';
        }
    }

    return $type;
}

/**
* Include general options screen
*
* XHTML options screen to prompt and update some general plugin options
*
* @since	2.0
*/

function aye_general_options() {

	include_once( WP_PLUGIN_DIR . '/youtube-embed/includes/aye-options-general.php' );

}

/**
* Include profile options screen
*
* XHTML options screen to prompt and update profile options
*
* @since	2.0
*/

function aye_profile_options() {

	include_once( WP_PLUGIN_DIR . '/youtube-embed/includes/aye-options-profiles.php' );

}

/**
* Include list options screen
*
* XHTML options screen to prompt and update list options
*
* @since	2.0
*/

function aye_list_options() {

	include_once( WP_PLUGIN_DIR . '/youtube-embed/includes/aye-options-lists.php' );

}

/**
* Include README screen
*
* Parse and display the README instructions
*
* @since	2.4
*/

function aye_support_readme() {
	include_once( WP_PLUGIN_DIR . '/youtube-embed/includes/aye-display-readme.php' );
}

/**
* Include about and support screen
*
* XHTML about screen which will, optionally, display help details as well
*
* @since	2.0
*/

function aye_support_about() {

	include_once( WP_PLUGIN_DIR . '/youtube-embed/includes/aye-display-about.php' );

}

/**
* Add Options Help
*
* Add help tab to options screen
*
* @since	2.5
*
* @uses     aye_options_help    Return help text
*/

function aye_add_options_help() {

    global $aye_options_hook;
    $screen = get_current_screen();

    if ( $screen->id != $aye_options_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'aye-options-help-tab', 'title'	=> __( 'Help' ), 'content' => aye_options_help() ) );
}

/**
* Options Help
*
* Return help text for options screen
*
* @since	2.5
*
* @return	string	Help Text
*/

function aye_options_help() {

	$help_text = '<p>' . __( 'This screen allows you to select non-specific options for the Artiss YouTube Embed plugin. For the default embedding settings, please select the <a href="admin.php?page=aye-profile-options">Profiles</a> administration option.' ) . '</p>';
	$help_text .= '<p>' . __( 'Remember to click the Save Settings button at the bottom of the screen for new settings to take effect.' ) . '</p>';
	$help_text .= '<p><strong>' . __( 'For more information:' ) . '</strong></p>';
    $help_text .= '<p><a href="http://www.artiss.co.uk/artiss-youtube-embed">' . __( 'Artiss YouTube Embed Plugin Documentation' ) . '</a></p>';
    $help_text .= '<p><a href="http://code.google.com/apis/youtube/player_parameters.html">' . __( 'YouTube Player Documentation' ) . '</a></p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.' ) . '</h4>';

	return $help_text;
}

/**
* Add Profiles Help
*
* Add help tab to profiles screen
*
* @since	2.5
*
* @uses     aye_profiles_help    Return help text
*/

function aye_add_profiles_help() {

    global $aye_profiles_hook;
    $screen = get_current_screen();

    if ( $screen->id != $aye_profiles_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'aye-profiles-help-tab', 'title'	=> __( 'Help' ), 'content' => aye_profiles_help() ) );
}

/**
* Profiles Help
*
* Return help text for profiles screen
*
* @since	2.5
*
* @return	string	Help Text
*/

function aye_profiles_help() {

	$help_text = '<p>' . __( 'This screen allows you to set the options for the default and additional profiles. If you don\'t specify a specific parameter when displaying your YouTube video then the default profile option will be used instead. Additional profiles, which you may name, can be used as well and used as required.' ) . '</p>';
	$help_text .= '<p>' . __( 'Remember to click the Save Settings button at the bottom of the screen for new settings to take effect.' ) . '</p>';
	$help_text .= '<p><strong>' . __( 'For more information:' ) . '</strong></p>';
    $help_text .= '<p><a href="http://www.artiss.co.uk/artiss-youtube-embed">' . __( 'Artiss YouTube Embed Plugin Documentation' ) . '</a></p>';
    $help_text .= '<p><a href="http://code.google.com/apis/youtube/player_parameters.html">' . __( 'YouTube Player Documentation' ) . '</a></p>';
    $help_text .= '<p><a href="http://embedplus.com/">' . __( 'EmbedPlus website' ) . '</a></p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.' ) . '</h4>';

	return $help_text;
}

/**
* Add Lists Help
*
* Add help tab to lists screen
*
* @since	2.5
*
* @uses     aye_lists_help    Return help text
*/

function aye_add_lists_help() {

    global $aye_lists_hook;
    $screen = get_current_screen();

    if ( $screen->id != $aye_lists_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'aye-lists-help-tab', 'title'	=> __( 'Help' ), 'content' => aye_lists_help() ) );
}

/**
* Profiles Help
*
* Return help text for profiles screen
*
* @since	2.5
*
* @return	string	Help Text
*/

function aye_lists_help() {

	$help_text = '<p>' . __( 'This screen allows you to create lists of YouTube videos, which may be named. These lists can then be used in preference to a single video ID.' ) . '</p>';
	$help_text .= '<p>' . __( 'Remember to click the Save Settings button at the bottom of the screen for new settings to take effect.' ) . '</p>';
	$help_text .= '<p><strong>' . __( 'For more information:' ) . '</strong></p>';
    $help_text .= '<p><a href="http://www.artiss.co.uk/artiss-youtube-embed">' . __( 'Artiss YouTube Embed Plugin Documentation' ) . '</a></p>';
    $help_text .= '<p><a href="http://code.google.com/apis/youtube/player_parameters.html">' . __( 'YouTube Player Documentation' ) . '</a></p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.' ) . '</h4>';

	return $help_text;
}

/**
* Add About Help
*
* Add help tab to about screen
*
* @since	2.5
*
* @uses     aye_about_help    Return help text
*/

function aye_add_about_help() {

    global $aye_about_hook;
    $screen = get_current_screen();

    if ( $screen->id != $aye_about_hook ) { return; }

    $screen -> add_help_tab( array( 'id' => 'aye-about-help-tab', 'title'	=> __( 'Help' ), 'content' => aye_about_help() ) );
}

/**
* About Help
*
* Return help text for about screen
*
* @since	2.5
*
* @return	string	Help Text
*/

function aye_about_help() {

	$help_text = '<p>' . __( 'This screen provides useful information about this plugin along with methods of support.' ) . '</p>';
	$help_text .= '<p><strong>' . __( 'For more information:' ) . '</strong></p>';
    $help_text .= '<p><a href="http://www.artiss.co.uk/artiss-youtube-embed">' . __( 'Artiss YouTube Embed Plugin Documentation' ) . '</a></p>';
    $help_text .= '<p><a href="http://code.google.com/apis/youtube/player_parameters.html">' . __( 'YouTube Player Documentation' ) . '</a></p>';
	$help_text .= '<h4>' . __( 'This plugin, and all support, is supplied for free, but <a title="Donate" href="http://artiss.co.uk/donate" target="_blank">donations</a> are always welcome.' ) . '</h4>';

	return $help_text;
}

/**
* Detect plugin activation
*
* Upon detection of activation set an option
*
* @since	2.4
*/

function aye_plugin_activate() {

	update_option( 'youtube_embed_activated', true );

}

register_activation_hook( WP_PLUGIN_DIR . "/youtube-embed/youtube-embed.php", 'aye_plugin_activate' );

// If plugin activated, run activation commands and delete option

global $wp_version;

if ( get_option( 'youtube_embed_activated' ) && ( ( float ) $wp_version >= 3.3 ) ) {

    add_action( 'admin_enqueue_scripts', 'aye_admin_enqueue_scripts' );

    delete_option( 'youtube_embed_activated' );
}

/**
* Enqueue Feature Pointer files
*
* Add the required feature pointer files
*
* @since	2.4
*/

function aye_admin_enqueue_scripts() {

    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );

    add_action( 'admin_print_footer_scripts', 'aye_admin_print_footer_scripts' );
}

/**
* Show Feature Pointer
*
* Display feature pointer
*
* @since	2.4
*/

function aye_admin_print_footer_scripts() {

    $pointer_content = '<h3>' . __( 'Welcome to Artiss YouTube Embed' ) . '</h3>';
    $pointer_content .= '<p style="font-style:italic;">' . __( 'Thank you for installing this plugin.' ) . '</p>';
    $pointer_content .= '<p>' . __( 'These new menu options will allow you to configure your videos to just how you want them and provide links for help and support.' ) . '</p>';
    $pointer_content .= '<p>' . __( 'Even if you do nothing else, please visit the Profiles option to check your default video values.' ) . '</p>';
?>
<script>
jQuery(function () {
	var body = jQuery(document.body),
	menu = jQuery('#toplevel_page_youtube-embed-general'),
	collapse = jQuery('#collapse-menu'),
	yembed = menu.find("a[href='admin.php?page=youtube-embed-profiles']"),
	options = {
		content: '<?php echo $pointer_content; ?>',
		position: {
			edge: 'left',
			align: 'center',
			of: menu.is('.wp-menu-open') && !menu.is('.folded *') ? yembed : menu
		},
		close: function() {
		}};

	if ( !yembed.length )
		return;

	body.pointer(options).pointer('open');
});
</script>
<?php
}
?>
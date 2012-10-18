<?php
/*
Plugin Name: Custom Meta Widget
Plugin URI: http://wikiduh.com/plugins/custom-meta-widget
Description: Clone of the standard Meta widget plus options to hide log in/out, admin, feed and WordPress/custom links.
Version: 1.3.5_a
Author: bitacre
Author URI: http://wikiduh.com/
License: GPLv2
	Copyright 2011 bitacre (plugins@wikiduh.com)
*/

class customMetaWidget extends WP_Widget {

// PLUGIN STRUCTURE
function customMetaWidget() { 
// 	as shown on the Dashboard > Appearance > Widgets page
	$widget_ops = array ( 
		'classname' => 'customMetaWidget',
		'description' => __( 'Clone of the standard Meta widget with options to show or hide log in/out, admin, feed, WordPress/custom links.', 'customMetaWidget' )
	); 

	$this->WP_Widget( 'customMetaWidget', 'Custom Meta', $widget_ops );
}

// WIDGET'S OPTIONS FORM
function form( $instance ) { 
//	set default form values 
	$instance = wp_parse_args( ( array ) $instance, array ( 
		'title' => __( 'Meta', 'customMetaWidget' ), 
		'register' => 1, 
		'login' => 1, 
		'entryrss' => 1, 
		'commentrss' => 1, 
		'wordpress' => 1, 
		'showcustom' => 0, 
		'customurl' => NULL, 
		'customtext' => NULL,
		'linklove' => 0
	) ); 

//	output HTML for the options form ?>
<!-- title -->
<p>
	<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title', 'customMetaWidget' ); ?>:</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
</p>

<!-- register -->    
<p>
	<label for="<?php echo $this->get_field_name( 'register' ); ?>"><?php _e( 'Show "Register/Admin" link?', 'customMetaWidget' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'register' ); ?>" name="<?php echo $this->get_field_name( 'register' ); ?>" type="checkbox" value="1" <?php checked( $instance['register'] ); ?> />
</p>

<!-- login -->
<p>
	<label for="<?php echo $this ->get_field_name( 'login' ); ?>"><?php _e( 'Show "Log in/out" link?', 'customMetaWidget' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'login' ); ?>" name="<?php echo $this->get_field_name( 'login' ); ?>" type="checkbox" value="1" <?php checked( $instance['login'] ); ?> />
</p>

<!-- entry RSS -->    
<p>
	<label for="<?php echo $this->get_field_name( 'entryrss' ); ?>"><?php _e( 'Show "Entries RSS" link?', 'customMetaWidget' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'entryrss' ); ?>" name="<?php echo $this->get_field_name( 'entryrss' ); ?>" type="checkbox" value="1" <?php checked( $instance['entryrss'] ); ?> />
</p>

<!-- comment RSS -->    
<p>
	<label for="<?php echo $this->get_field_name( 'commentrss' ); ?>"><?php _e( 'Show "Comments RSS" link?', 'customMetaWidget' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'commentrss' ); ?>" name="<?php echo $this->get_field_name( 'commentrss' ); ?>" type="checkbox" value="1" <?php checked( $instance['commentrss'] ); ?> />
</p>

<!-- wordpress -->
<p>
	<label for="<?php echo $this->get_field_name( 'wordpress' ); ?>"><?php _e( 'Show "Wordpress" link?', 'customMetaWidget' ); ?></label>
    <input id="<?php echo $this->get_field_id( 'wordpress' ); ?>" name="<?php echo $this->get_field_name( 'wordpress' ); ?>" type="checkbox" value="1" <?php checked( $instance['wordpress'] ); ?> />
</p>

<!-- custom -->
<p>
	<label for="<?php echo $this->get_field_name( 'showcustom' ); ?>"><?php _e( 'Show Custom link?', 'customMetaWidget'); ?>&nbsp;</label>
	<input id="<?php echo $this->get_field_id( 'showcustom' ); ?>" name="<?php echo $this->get_field_name( 'showcustom' ); ?>" type="checkbox" value="1" <?php checked( $instance['showcustom'] ); ?> />    
        	
	<div style="margin-left:20px;">
		<label for="<?php echo $this->get_field_name( 'customurl' ); ?>"><?php _e( 'URL', 'customMetaWidget' ); ?>:&nbsp;</label>
		<input id="<?php echo $this->get_field_id( 'customurl' ); ?>" name="<?php echo $this->get_field_name( 'customurl' ); ?>" type="text" value="<?php echo esc_attr( $instance['customurl'] ); ?>" />
	</div>
        
    <div style="margin-left:20px;">
		<label for="<?php echo $this->get_field_name( 'customtext' ); ?>"><?php _e( 'Text', 'customMetaWidget' ); ?>:&nbsp;&nbsp;</label>
		<input id="<?php echo $this->get_field_id( 'customtext' ); ?>" name="<?php echo $this->get_field_name( 'customtext' ); ?>" type="text" value="<?php echo esc_attr( $instance['customtext'] ); ?>" />
	</div>
</p>

<!-- linklove -->
<p>
	<label for="<?php echo $this->get_field_name( 'linklove' ); ?>"><?php _e( 'Show Plugin link?', 'customMetaWidget' ); ?>&nbsp;</label>
    <input id="<?php echo $this->get_field_id( 'linklove' ); ?>" name="<?php echo $this->get_field_name( 'linklove' ); ?>" type="checkbox" value="1" <?php checked( $instance['linklove'] ); ?> /> 
    <br />
    <small>(<?php _e( 'An awesome way to support this free plugin!', 'customMetaWidget' ); ?>)</small></p>

	<?php // check for errors
	if ( esc_attr($instance['showcustom']) ) { // IF 'showcustom' is checked, AND
			
			// 1. no link and no URL
			if( empty($instance['customtext']) && empty($instance['customurl']) ) 
				echo '<p style="color:#FF0000; font-weight:bold;" >' . __( 'You have a custom link with no URL or text!', 'customMetaWidget' ) . '</p>';
			// 2. no link
			else if ( empty($instance['customtext']) ) 
				echo '<p style="color:#FF0000; font-weight:bold;" >' . __( 'You have a custom link with no text!', 'customMetaWidget' ) . '</p>';
			
			// 3. no url
			else if ( empty($instance['customurl']) )
				echo '<p style="color:#FF0000; font-weight:bold;" >' . __( 'You have a custom link with no URL!', 'customMetaWidget' ) . '</p>';
	}
}

// SAVE WIDGET OPTIONS
function update($new_instance, $old_instance) {
	$instance = $old_instance;
	// should probably do this with a loop...
	$instance['title'] = $new_instance['title'];
	$instance['register'] = $new_instance['register'];
	$instance['login'] = $new_instance['login'];
	$instance['entryrss'] = $new_instance['entryrss'];
	$instance['commentrss'] = $new_instance['commentrss'];
	$instance['wordpress'] = $new_instance['wordpress'];
	$instance['showcustom'] = $new_instance['showcustom'];
	$instance['customurl'] = $new_instance['customurl'];
	$instance['customtext'] = $new_instance['customtext'];
	$instance['linklove'] = $new_instance['linklove'];
	return $instance;
}

// ACTUAL WIDGET OUTPUT
function widget( $args, $instance ) { 
   	extract( $args, EXTR_SKIP ); // extract arguments
	$title = empty($instance['title']) ? ' ' : apply_filters( 'widget_title', $instance['title'] ); // if no title, use default

	// insert start of widget HTML comment
	echo '
<!-- 
' . __( 'Plugin: Custom Meta Widget', 'customMetaWidget' ) . '
' . __( 'Plugin URL', 'customMetaWidget' ) . ': http://wikiduh.com/plugins/custom-meta-widget
-->
';

	// insert pre-widget code (from theme)
    echo $before_widget; 
		
    // insert widget title
	echo $before_title . esc_attr( $instance['title'] ) . $after_title; // echo title (inside theme tags)
	
	// start unordered list
	echo '
<ul>
'; 
	// ADD LINKS
	// 1. register link
	if( esc_attr( $instance['register'] ) ) wp_register( '<li>', '</li>' );
	
	// 2. login link
	if( esc_attr( $instance['login'] ) ) echo '<li>' . wp_loginout( NULL, FALSE ) . '</li>';
	
	// 3. entries RSS link
	if( esc_attr( $instance['entryrss'] ) )
		printf( __( '%1$sSyndicate this site using RSS 2.0%2$sEntries %3$sRSS%4$s', 'customMetaWidget'), '<li><a href="' . get_bloginfo( 'rss2_url' ) . '" title="', '">','<abbr title="Really Simple Syndication">','</abbr></a></li>' );
	
	// 4. comments RSS link
	if( esc_attr( $instance['commentrss'] ) ) 
		printf( __( '%1$sSyndicate this site using RSS 2.0%2$sComments %3$sRSS%4$s', 'customMetaWidget' ), '<li><a href="' . get_bloginfo( 'comments_rss2_url' ) . '" title="', '">','<abbr title="Really Simple Syndication">','</abbr></a></li>' );

	// 5. wordpress.org link
	if( esc_attr( $instance['wordpress'] ) ) echo '<li><a href="http://wordpress.org/" title="' . __( 'Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'customMetaWidget' ) . '">WordPress.org</a></li>'; 
			
	// 6. custom link
	if( esc_attr( $instance['showcustom'] ) ) { 
		// make sure link text & url are set
		if( !empty( $instance['customtext'] ) && !empty( $instance['customurl'] ) ) echo '<li><a href="' . esc_attr( $instance['customurl'] ) . '">' . esc_attr( $instance['customtext'] ) . '</a></li>';
		// otherwise insert error comment
		else echo '
<!-- ' . __( 'Error: "Show Custom Link" is checked, but either the text or URL for that link are not specified. The link was not displayed because it would be broken. Check the settings for your Custom Meta widget.', 'customMetaWidget' ) . ' -->
'; 
	}

	// 7. link love
	if( esc_attr( $instance['linklove'] ) ) {
		echo '<li><a href="http://wikiduh.com/plugins/custom-meta-widget" title="' . __( 'WordPress Plugin Homepage', 'customMetaWidget' ) . '">' . __( 'Custom Meta' ) . '</a></li>';
	}
	
	// end unordered list tag	
	echo '</ul>';
	
	// insert post-widget code (from theme)
	echo $after_widget; 
}
}

// ADD HOOKS AND FILTERS
add_action( 'widgets_init', create_function('', 'return register_widget("customMetaWidget");') );
$plugin_dir = basename(dirname(__FILE__)) . '/lang';
load_plugin_textdomain( 'customMetaWidget', null, $plugin_dir );
?>
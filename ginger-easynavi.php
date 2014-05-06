<?php
/**
 * Plugin Name: GingerGear Easy Navigation 
 * Plugin URI: http://gingergear.com/easy-navigation/
 * Version: 0.1
 * Author: Yuncheng Mao
 * Description: You can use this to easily navigate through pages and posts by using a metabox 
 * Text Domain: GingerGear
 * Domain Path: /languages
 */



/**
 * Router for adding a metabox in page and post editing area.
 */



function init_option () {
	
}

add_action( 'wp_ajax_ginger_navi', 'ginger_navi_callback' );

function ginger_navi_callback () {
	/**
	 * initialize the slim framework for handling the restAPI.
	 */
	/*
	$template = array(
		'post_url' => 'slim_url',
		'post_name' => 'slim',
    	);
	*/
	//echo json_encode($template);

	//die();
		
	require('slim-bootstrap.php');

	die(); // this is required to return a proper result
};

function load_backbone_mustache ($hook) {
	if( 'post.php' == $hook || 'post-new.php' == $hook ){
		wp_enqueue_style( 'load_bootswatch_readable', plugin_dir_url( __FILE__ ) . 'css/bootstrap.panel.css' );
		wp_enqueue_script( 'load_jquery_1_11', plugin_dir_url( __FILE__ ) . 'js/jquery-1.11.0.js' );
		wp_enqueue_script( 'load_underscore', plugin_dir_url( __FILE__ ) . 'js/underscore-min.js' );
		wp_enqueue_script( 'load_json2', plugin_dir_url( __FILE__ ) . 'js/json2.js' );
		wp_enqueue_script( 'load_backbone', plugin_dir_url( __FILE__ ) . 'js/backbone.js' );
		wp_enqueue_script( 'load_marionette', plugin_dir_url( __FILE__ ) . 'js/backbone.marionette.min.js' );
		wp_enqueue_script( 'load_mustache', plugin_dir_url( __FILE__ ) . 'js/mustache.js' );
		wp_enqueue_script( 'load_bootstrap_collapse', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js' );
		//wp_enqueue_script( 'load_app', plugin_dir_url( __FILE__ ) . 'js/app.js', array(), '', true );
		wp_enqueue_script( 'load_app', plugin_dir_url( __FILE__ ) . 'js/navigation_app.js', array(), '', true );
		wp_enqueue_script( 'load_entities', plugin_dir_url( __FILE__ ) . 'js/entities/navigation_entities.js', array(), '', true );
		wp_enqueue_script( 'load_view', plugin_dir_url( __FILE__ ) . 'js/navigations/navigation_view.js', array(), '', true );
		wp_enqueue_script( 'load_controller', plugin_dir_url( __FILE__ ) . 'js/navigations/navigation_controller.js', array(), '', true );

		// in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'load_app', 'ginger_ajax',
			array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		);

	}
}

add_action( 'admin_enqueue_scripts', 'load_backbone_mustache' );

function call_easynavi () {
/*
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);
	$output = 'names'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'

	$post_types = get_post_types( $args, $output, $operator ); 

	foreach ( $post_types  as $post_type ){
		new Ginger_easy_navigation();
	}
*/
	$screen = get_current_screen();

	$easynavi = new Ginger_easy_navigation();
	
	//$easynavi->render_meta_box_content();
}

if( is_admin() ) {
	
	add_action( 'load-post.php', 'call_easynavi' );
    add_action( 'load-post-new.php', 'call_easynavi' );

}

/**
 * Require easynavi class for handling the rest part
 */

require_once 'ginger-easynavi-class.php'

?>

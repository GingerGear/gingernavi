<?php

/** 
 * Ginger Easy Navigation Class
 */

class Ginger_easy_navigation {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
		add_meta_box(
			'ginger-navi'
			,__( 'Easy Navigation', 'GingerGear' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'side'
			,'high'
		);
	}

	/**
	 * Render Meta Box content.
	 *
	 */
	public function render_meta_box_content() {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'ginger_navi', 'ginger_navi' );
		/**
		 * This is old method to complete the navigation metabox. New method is to use backbone js.
		// Use WP_Query to retrieve all $post_id for selected $post_type.
		$post_types = array( 'post', 'page' );
		
		$args = array(
		   'public'   => true,
		   '_builtin' => false
		);
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$custom_post_types = get_post_types( $args, $output, $operator ); 
		
		foreach ( $custom_post_types as $custom_post_type ) {

			if ( 1 ) { // pick wanted custom post type
				array_push( $post_types, $custom_post_type );
			}
		}

		/**
		 * use for debug
		 */
		/**
		 * foreach ( $post_types as $debug ){
			echo $debug;
		 }*/
		/*	
		$ginger_query = new WP_Query( 
			array( 
				'post_type' => $post_types 
			) 
		);
		
		if ( $ginger_query->have_posts() ) {
			$user = wp_get_current_user();
			$uid = (int) $user->ID;
			$i = wp_nonce_tick();
			while( $ginger_query->have_posts() ) {
				
				$ginger_query->the_post();

				/**
				 * ALERT!
				 * the_ID() will echo the content
				 * if you want it return value
				 * please use the get_the_xxx() function instead
				 *
				 * $tmp_id = the_ID();
				 * $tmp_title = the_title();
				 *
				echo '<label for="myplugin_new_field">';
				echo '<a href="' . admin_url('post.php?post=') . get_the_ID() . '&action=edit">';
				if ( get_the_title() != null ) {
					echo get_the_title();
				}
				else 
					echo 'No Name';
				echo '</a><a href="' . admin_url('post.php?post=') . get_the_ID() . '&action=trash&_wpnonce=' . substr( wp_hash($i . 'trash-post_' . get_the_ID() . $uid, 'nonce' ), -12, 10 ) . '">trash';
				echo '</a></label></br>';

			}
		}

		// Display the form, using the current value.
		*/

		echo '<div id="ginger-navi-app"></div>';
		echo <<<TEMPLATE
			<script id="navi-template" text="x-tmpl-mustache">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-parent="#navi-list" href="#">+  {{post_type}}</a>
					</h4>
				</div>
				<div id="postType-{{ post_type }}" class="panel-collapse collapse" style="height: 0px;">
          			<div class="panel-body">
            			<ul>
						</ul>
					</div>
				</div>
			</script>

			<script id="list-item-template" text="x-tmpl-mustache">
				<a>{{post_url}}</a>
			</script>
TEMPLATE;
	}
}
?>

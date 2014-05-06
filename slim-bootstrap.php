<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

// GET route
$app->get(
    '/post/types',
	function () use ($app) { 
			
		$post_types = array (
			array (
				'post_type' => 'post'
			),
			array (
				'post_type' => 'page'
			),
		);

		$args = array(
			'public'   => true,
			'_builtin' => false
		);

		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'

		$custom_post_types = get_post_types( $args, $output, $operator ); 
		foreach( $custom_post_types as $post_type ){
				$post_types[] = array ( 
						'post_type' => $post_type
				);
		}

		echo json_encode( $post_types );
    }
);

$app->get(
	'/post/types/:type',
	function ( $type ) {
		$return = array();	
		$current_user = wp_get_current_user();
		$args = array (
			'author' => $current_user->ID,	
			'fields' => 'ids',
		);

		$args['post_type'] = $type;

		$query = new WP_Query( $args );
		
		while( $query->have_posts() ){
			$query->the_post();
			$return[] = array(
				'post_id' => get_the_ID(),
			);
		}
		echo json_encode( $return );
	}
);

// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);

// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);

// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});

// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();

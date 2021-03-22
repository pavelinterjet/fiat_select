<?php 
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo', array(
    'height' => 480,
    'width'  => 720,
) );
add_theme_support( 'post-thumbnails' );




function isAjax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}



/**
 * Register a custom post type called "book".
 *
 * @see get_post_type_labels() for label keys.
 */
function fiat_post_types() {
    $labels_models = array(
        'name'                  => _x( 'Car Models', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Model', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Models', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Models', 'Add New on Toolbar', 'textdomain' ),
    );
 
    $args_models = array(
        'labels'             => $labels_models,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'models' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', ),
    );
    register_post_type( 'models', $args_models );



    $labels_sub_models = array(
        'name'                  => _x( 'Car Sub Models', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Sub Model', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Sub Models', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Sub Models', 'Add New on Toolbar', 'textdomain' ),
    );
 
    $args_sub_model = array(
        'labels'             => $labels_sub_models,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'sub-models' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', ),
    );
    register_post_type( 'sub-models', $args_sub_model );



    $labels_colors = array(
        'name'                  => _x( 'Car Color', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Car Color', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Car Colors', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Car Color', 'Add New on Toolbar', 'textdomain' ),
    );
 
    $args_colors = array(
        'labels'             => $labels_colors,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'colors' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', ),
    );
    register_post_type( 'colors', $args_colors );



    $labels_car_gal = array(
        'name'                  => _x( 'Car Gallery', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Car Gallery', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Car Galleries', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Car Gallery', 'Add New on Toolbar', 'textdomain' ),
    );
 
    $args_car_gal = array(
        'labels'             => $labels_car_gal,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'car-gallery' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', ),
    );
    register_post_type( 'car_gallery', $args_car_gal );

}
add_action( 'init', 'fiat_post_types' );



// add_action('wp_ajax_my_user_vote' , 'my_user_vote');
// add_action('wp_ajax_nopriv_my_user_vote' , 'my_user_vote');

// function my_user_vote() {

//     print_r( $_POST );

//     wp_die();
// }
















?>
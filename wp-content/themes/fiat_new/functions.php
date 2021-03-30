<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);


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

function get_available_models() {
    $args_gal = [
        'post_type' => 'car_gallery',
        'fields'    => 'ids',
    ];

    $galz = new WP_Query($args_gal);

    $availabel_submodels = [];

    while ( $galz->have_posts() ) { $galz->the_post();

        if( get_field('model_filter' , get_the_ID() ) ) {
            $availabel_submodels[] = get_field('model_filter' , get_the_ID() );
        }

    } wp_reset_postdata();

    if( $availabel_submodels ) {
        $flat = call_user_func_array('array_merge', $availabel_submodels);
    }
    return $flat;
}


function get_available_submodels($field,$ids) {




    $meta_query['relation'] = 'OR';
    foreach ( array_unique($ids) as $id ) {

        $meta_query[] = [

            [
                'key' => 'model_filter',
                'value' => '"'.$id.'"',
                'compare' => 'LIKE'
            ]

        ];

    }

 
    $argz = [
        'posts_per_page' => -1,
        'post_type' => 'car_gallery',
        'fields'    => 'ids',
        // 'meta_query' => $meta_query
    ];

    $galz = new WP_Query($argz);


    // print_r($galz->posts);

    $availabel_submodels = [];
    while ( $galz->have_posts() ) { $galz->the_post();


        if( get_field( 'model_filter' , get_the_ID() ) ) {
            $availabel_submodels[] = get_field('submodel_filter' , get_the_ID());
        }


    } wp_reset_postdata();


    if( $availabel_submodels && is_array( $availabel_submodels ) ) {
        $flat = call_user_func_array('array_merge', $availabel_submodels);
    }

    // print_r( array_unique($flat) );

    return  array_unique($flat);
}



function get_available_colors($field,$ids) {

    $meta_query['relation'] = 'OR';

    foreach (array_unique($ids) as $id) {
        $meta_query[] = [
            [
                'key' => $field.'_filter',
                'value' => '"'.$id.'"',
                'compare' => 'LIKE'
            ]
        ];
    }
    $argz = [
        'posts_per_page' => -1,
        'post_type' => 'car_gallery',
        // 'meta_query' => $meta_query
    ];

    $galz = new WP_Query($argz);
    $availabel_colors = [];
    while ( $galz->have_posts() ) { $galz->the_post();
        if( get_field( 'model_filter' , get_the_ID() ) ) {
            $availabel_colors[] = get_field('colors_filter' , get_the_ID());
        }
    } wp_reset_postdata();
    if( $availabel_colors && is_array( $availabel_colors ) ) {
        $flat = call_user_func_array('array_merge', $availabel_colors);
    }

    return  array_unique($flat);
}




function check_availability($filter,  $id) {

    $argz = [
        'post_type' => 'car_gallery',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => $filter.'_filter',
                'value' => '"'. $id . '"',
                'compare' => 'LIKE'
            ],
        ]
    ];
    $galz = new WP_Query($argz);
    $big_arr = [];
        foreach ($galz->posts as $key => $gal) {

            if( $filter == 'model' ) { 
                $big_arr['submodel'][$key] = get_field('submodel_filter' , $gal->ID);
                $big_arr['colors'][$key] = get_field('colors_filter' , $gal->ID);
            } else if( $filter == 'submodel' ) { 
                $big_arr['model'][$key] = get_field('model_filter' , $gal->ID);
                $big_arr['colors'][$key] = get_field('colors_filter' , $gal->ID);
            } else if( $filter == 'colors'  ) {
                $big_arr['model'][$key] = get_field('model_filter' , $gal->ID);
                $big_arr['submodel'][$key] = get_field('submodel_filter' , $gal->ID);
            } 


            

        }

        $big_arr[$filter][][] = $id; 

        
    return $big_arr;
}



















?>
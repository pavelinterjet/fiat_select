<?php 
/*
* Template Name: Home
*/


if( isAjax() ) {


    // print_r( $_POST );


    $available = [];


    if( isset( $_POST['car_models'] ) ) {
        $car_model = str_replace('filter_' , '' , $_POST['car_models']);
    }
    if( isset( $_POST['submodels'] ) ) {
        $submodels = str_replace('filter_' , '' , $_POST['submodels']);
    }
    if( isset( $_POST['car_colors'] ) ) {
        $car_colors = str_replace('filter_' , '' , $_POST['car_colors']);
    }

    if( isset( $_POST['filter_type'] ) ) {
        $filter_type = $_POST['filter_type'];
    }
    if( isset( $_POST['current_filter'] ) ) {
        $current_filter = str_replace('filter_' , '' , $_POST['current_filter'] );
    }

    $args = [
        'post_type' => 'car_gallery',
        'posts_per_page' => -1,
        'meta_query' => [

        ]
    ];
    $args['meta_query']['relation'] = 'AND';


    if ( $filter_type == 'model' ) {
        
        $submodels = array_unique( get_submodels( $car_model ) );


        if( !isset( $submodels[0] ) ) {
            exit; 
        }
        $colors = get_colors(  $submodels[0],$car_model  );

        // foreach ($submodels[0] as $submodel) {
            $args['meta_query'][] = [
                'key' => 'submodel_filter',
                'value' => '"' .$submodels[0]. '"',
                'compare' => 'LIKE'
            ];
        // }

        // foreach ($colors as $color) {
            $args['meta_query'][] = [
                'key' => 'colors_filter',
                'value' => '"' .$colors[0]. '"',
                'compare' => 'LIKE'
            ];
        // }





    } else if( $filter_type == 'submodel' ) {


        $submodels = array_unique( get_submodels( $car_model ) );
        $colors = get_colors(  $current_filter,$car_model  );


        // print_r($current_filter);
        // print_r($car_model);
        // print_r($colors);

        $args['meta_query'][] = [
            'key' => 'model_filter',
            'value' => '"' .$car_model. '"',
            'compare' => 'LIKE'
        ];

        $args['meta_query'][] = [
            'key' => 'submodel_filter',
            'value' => '"' .$current_filter. '"',
            'compare' => 'LIKE'
        ];
    // }

    // foreach ($colors as $color) {
        $args['meta_query'][] = [
            'key' => 'colors_filter',
            'value' => '"' .$colors[0]. '"',
            'compare' => 'LIKE'
        ];



    } else if( $filter_type == 'colors' ) {

        $submodels = array_unique( get_submodels( $car_model ) );
        $colors = get_colors(  $submodels,$car_model  );

        $args['meta_query'][] = [
            'key' => 'model_filter',
            'value' => '"' .$car_model. '"',
            'compare' => 'LIKE'
        ];
        $args['meta_query'][] = [
            'key' => 'submodel_filter',
            'value' => '"' .$submodels. '"',
            'compare' => 'LIKE'
        ];
        $args['meta_query'][] = [
            'key' => 'colors_filter',
            'value' => '"' .$current_filter. '"',
            'compare' => 'LIKE'
        ];
        
    }


    // print_r( $colors );

   
    if ( isset( $colors ) ) {

        if ( is_array( $colors ) ) {
            $available['colors'] = $colors;
            // $available['sub_models'] = $submodels;
        } else {
            $available['colors'] = [$colors];
        }

    }


    if( isset( $submodels ) ) {

        if ( is_array($submodels)  ) {
            // $available['colors'] = $colors;
            $available['sub_models'] = $submodels;
        } else {
            $available['sub_models'] = [$submodels];
        }
        
    } 


    // print_r($available);
    // print_r($args);
    $galz = new WP_Query($args);
    // print_r($galz->posts);




    if( $galz->post_count > 0 ) {
        ob_start();
        get_template_part('elements/car_features' , 'car_features' , $galz->posts);
        $clean = ob_get_contents();
        ob_end_clean();

        ob_start();
        get_template_part('elements/slide' , 'slide' , ['field' => get_field('bottom_gallery', $galz->posts[0]->ID ) ] );
        $bottom_gal = ob_get_contents();
        ob_end_clean();
    }
    echo json_encode( ['content' => $clean??'', 'bottom_gal' => $bottom_gal??'', 'available' => $available ] , true );




die;
}



$args_models = [
    'post_type' => 'models',
    'posts_per_page' => -1
];
$models = new WP_Query($args_models);




$args_sub = [
    'post_type' => 'sub-models',
    'posts_per_page' => -1
];
$sub_m_q = new WP_Query($args_sub);



$args_colors = [
    'post_type' => 'colors',
    'posts_per_page' => -1
];
$color_q = new WP_Query($args_colors);



get_header();



?>





<section class="wrapper">
    <div class="head-strip">
        <div class="flex_container flex__just_center flex__align_center">
            <div class="head-title is_desktop">SELECT YOUR NEW</div>
            <div class="head-logo is_desktop">
                <img src="<?php echo $templ_path; ?>/assets/img/Image7.png" alt="">
            </div>
        </div>
    </div>
    <section class="car_filter">
        <div class="container">
            <div class="flex_container flex_reverse_row flex__space_between">
                <div class="left">


                <?php
                    // get_template_part('elements/car_features' , 'car_features' , $gals->posts);                    
                ?>


                </div>
                <div class="right">

    <div class="preloader"> <img src="<?php echo $templ_path;?>/assets/img/Infinity-1.5s-224px.gif" alt=""> </div>

                    <div class="car_models filter_lvl">
                        <div class="flex_container flex__space_between">
                            <?php $mcc = 0; 
                            while ($models->have_posts()) {
                                $models->the_post();
                                $mcc++;
                                $level_one_args = [
                                    'counter'   => $mcc,
                                    'max'       => $models->post_count,
                                    'p_id'      => get_the_ID(),
                                    // 'available' => $available_models
                                ];
                                echo get_template_part('elements/car_model', 'car_model' , $level_one_args );
                            } wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <div class="car_submodels filter_lvl">
                            <div class="flex_container flex__space_between flex_no_wrap__d">
                                <?php $s_mcc = 0; 
                                while ($sub_m_q->have_posts()) {
                                    $sub_m_q->the_post();
                                    $s_mcc++;
                                    $level_two_args = [
                                        'counter'   => $s_mcc,
                                        'max'       => $sub_m_q->post_count,
                                        'sp_id'     => get_the_ID(),
                                        // 'available' => $sub_models
                                    ];
                                    echo get_template_part('elements/car_submodel', 'car_submodel' , $level_two_args );
                                } wp_reset_postdata(); ?>
                            </div>
                    </div>
                    <div class="car_colors filter_lvl">
                        <div class="flex_container flex__just_right ">
                            <?php 
                            $colorcc = 0; 
                                while ($color_q->have_posts()) {
                                    $color_q->the_post();
                                    $colorcc++;
                                    $level_three_args = [
                                        'counter' => $colorcc,
                                        'max'     => $color_q->post_count,
                                        'sp_id'    => get_the_ID(),
                                        // 'available' => $colors
                                    ];
                                    echo get_template_part('elements/car_colors', 'car_colors' , $level_three_args );
                            } wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="big_button">
                        <a href="">
                            <span>למפרט המלא</span>
                            <span> ולהזמנה online לחצ/י כאן </span>
                        </a>
                    </div>
                    <div class="is_mobile">
                        <div class="mobile_filter_content">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- <div class="blue_title">CABRIO / LA PRIMA / OCEAN GREEN</div>
    <div class="car_features ">
        <ul class="flex_container flex__space_between flex_no_wrap__d">
            <?php
                // while($gals->have_posts()) {
                //     $gals->the_post();
                //     echo get_template_part('elements/car_features' , 'features', ['gal_id' => get_the_ID()] );
                // }
                // wp_reset_postdata();
            ?>
        </ul>
    </div> -->

    <section class="big_slider" dir='rtl'>
        <?php 
            // get_template_part('elements/slide' , 'slide' , ['field' => get_field('bottom_gallery', $gals->posts[0]->ID ) ] );
        ?>
    </section>

</section>




<?php get_footer(); ?>
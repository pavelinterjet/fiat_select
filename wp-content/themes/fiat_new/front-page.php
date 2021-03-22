<?php


$templ_path = get_stylesheet_directory_uri(); 

$flds = get_fields();



if( isAjax() ) {

    $cmodel = $_POST['car_models'];
    $sub_model = $_POST['submodels'];
    $colors = $_POST['car_colors'];

    $argz = [
        'post_type' => 'car_gallery',
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'model_filter',
                'value' => $cmodel,
                'compare' => 'LIKE'
            ],
            [
                'key' => 'sub_model_filter',
                'value' => $sub_model,
                'compare' => 'LIKE'
            ],
            [
                'key' => 'color_filter',
                'value' => $colors,
                'compare' => 'LIKE'
            ],
        ]
    ];
    $galz = new WP_Query($argz);


    // print_r($galz->posts);

    echo get_template_part('elements/car_features' , 'car_features' , $galz->posts);

    
    die();
}

$m_args = [
    'post_type' => ['models']
];
$m_q = new WP_Query($m_args);

$subm_args = [
    'post_type' => ['sub-models']
];
$sub_m_q = new WP_Query($subm_args);

$color_args = [
    'post_type' => ['colors']
];
$color_q = new WP_Query($color_args);

$args = [
    'post_type' => 'car_gallery',
];
$gals = new WP_Query($args);

?>

<?php get_header(); ?>


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

                </div>
                <div class="right">
                    <div class="car_models filter_lvl">
                        <div class="flex_container flex__space_between flex_reverse_row">
                            <?php $mcc = 0; 
                            while ($m_q->have_posts()) {
                                $m_q->the_post();
                                $mcc++;
                                $level_one_args = [
                                    'counter' => $mcc,
                                    'max'     => $m_q->post_count,
                                    'p_id'    => get_the_ID()
                                ];
                                echo get_template_part('elements/car_model', 'car_model' , $level_one_args );
                            } wp_reset_postdata();?>
                            <?php  ?>
                        </div>
                    </div>
                    <div class="car_submodels filter_lvl">
                            <div class="flex_container flex__space_between flex_reverse_row">
                                <?php $s_mcc = 0; 
                                while ($sub_m_q->have_posts()) {
                                    $sub_m_q->the_post();
                                    $s_mcc++;
                                    $level_two_args = [
                                        'counter' => $s_mcc,
                                        'max'     => $sub_m_q->post_count,
                                        'sp_id'    => get_the_ID()
                                    ];
                                    echo get_template_part('elements/car_submodel', 'car_submodel' , $level_two_args );
                                } wp_reset_postdata(); ?>
                            </div>
                    </div>
                    <div class="colors filter_lvl">
                        <div class="flex_container flex__space_between flex_reverse_row">
                            <?php 
                            $colorcc = 0; 
                                while ($color_q->have_posts()) {
                                    $color_q->the_post();
                                    $colorcc++;
                                    $level_three_args = [
                                        'counter' => $colorcc,
                                        'max'     => $color_q->post_count,
                                        'sp_id'    => get_the_ID()
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

    <section class="big_slider">

    <?php 
    if ($flds['slides']) {
        foreach( $flds['slides'] as $sld ) {
            echo get_template_part('elements/slide' , 'slide' , ['field' => $sld] );
        }
    }
    ?>

    </section>









    

</section>




<?php get_footer(); ?>
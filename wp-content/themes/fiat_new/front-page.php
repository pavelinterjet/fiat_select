<?php



// $plaintext = "message to be encrypted";
// $cipher = "aes-128-gcm";
// if (in_array($cipher, openssl_get_cipher_methods()))
// {
//     $ivlen = openssl_cipher_iv_length($cipher);
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
//     //store $cipher, $iv, and $tag for decryption later
//     $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
//     echo $ciphertext."\n";
// }



$templ_path = get_stylesheet_directory_uri(); 


$available_models = get_available_models();
$available_submodels = get_available_submodels('model',$available_models);
$available_colors = get_available_colors('model', $available_models);


if( isAjax() ) {
    $cmodel = '';
    $sub_model = '';
    $colors ='';

    if( isset($_POST['car_models']) ) {
        $cmodel = str_replace('filter_','', $_POST['car_models']);
        check_availability( 'model',  $cmodel );
    }

    if( isset($_POST['submodels']) ) {
        $sub_model = str_replace('filter_','', $_POST['submodels']);
        check_availability( 'submodel',  $sub_model );
    }
    if( isset($_POST['car_colors']) ) {
        $colors = str_replace('filter_','', $_POST['car_colors']);
        check_availability( 'colors',  $colors );
    }


    if( isset($_POST['filter_type']) ) {
        $filter_type = $_POST['filter_type'];
    }
    if( isset($_POST['current_filter']) ) {
        $current_filter = str_replace('filter_','', $_POST['current_filter']);
    }
    $available = check_availability($filter_type, $current_filter);

    // print_r($available);

    $meta_query['relation'] = 'AND';
    foreach ($available as $key => $av_item) {
        

        $meta_query[] = [
            'key' => $key.'_filter',
            'value' => '"'. $av_item[0][0] .'"',
            'compare' => 'LIKE'
        ];



    }


    // print_r($meta_query);

    $argz = [
        'post_type' => 'car_gallery',
        'meta_query' => $meta_query
    ];

    // print_r($argz);

    
    $galz = new WP_Query($argz);
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
        echo json_encode( ['content' => $clean??'', 'bottom_gal' => $bottom_gal??'', 'available' =>  $available ] , true );

    die();
}

$m_args = [
    'post_type' => 'models',
    'posts_per_page' => -1,
];
$m_q = new WP_Query($m_args);
$subm_args = [
    'post_type' => 'sub-models',
    'posts_per_page' => -1
];
$sub_m_q = new WP_Query($subm_args);
$color_args = [
    'post_type' => 'colors',
    'posts_per_page' => -1
];
$color_q = new WP_Query($color_args);
$args = [
    'post_type' => 'car_gallery',
    'posts_per_page' => -1,
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

    <div class="preloader"> <img src="<?php echo $templ_path;?>/assets/img/Infinity-1.5s-224px.gif" alt=""> </div>

                    <div class="car_models filter_lvl">
                        <div class="flex_container flex__space_between">
                            <?php $mcc = 0; 
                            while ($m_q->have_posts()) {
                                $m_q->the_post();
                                $mcc++;
                                $level_one_args = [
                                    'counter'   => $mcc,
                                    'max'       => $m_q->post_count,
                                    'p_id'      => get_the_ID(),
                                    'available' => $available_models
                                ];
                                echo get_template_part('elements/car_model', 'car_model' , $level_one_args );
                            } wp_reset_postdata();
                            
                            ?>

                            <?php  ?>
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
                                        'available' => $available_submodels
                                    ];
                                    echo get_template_part('elements/car_submodel', 'car_submodel' , $level_two_args );
                                } wp_reset_postdata(); ?>
                            </div>
                    </div>
                    <div class="car_colors filter_lvl">
                        <div class="flex_container flex__space_between ">
                            <?php 
                            $colorcc = 0; 
                                while ($color_q->have_posts()) {
                                    $color_q->the_post();
                                    $colorcc++;
                                    $level_three_args = [
                                        'counter' => $colorcc,
                                        'max'     => $color_q->post_count,
                                        'sp_id'    => get_the_ID(),
                                        'available' => $available_colors
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
            echo get_template_part('elements/slide' , 'slide' , ['field' => get_field('bottom_gallery', 10)] );
        ?>
    </section>

</section>




<?php get_footer(); ?>





<?php



// header('Content-Type:application/json');
// $url = "http://interjet.co.il/demos/smlt/new_fiat/";

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// $res = curl_exec($ch);

// curl_close($ch);



// $dom = new DomDocument();
// @ $dom->loadHTML($res);

// print_r($dom);

// $table = $dom->getElementById('tablepress-3'); //DOMElement
// $child_elements = $table->getElementsByTagName('tr'); //DOMNodeList
// $row_count = $child_elements->length - 1;


?>
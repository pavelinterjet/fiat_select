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


if( isAjax() ) {
    

    $car_model = '';
    $submodels = '';
    $car_colors = '';
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


    $sub_models_in = get_submodels( $car_model );
    $colors_in = get_colors( $submodels,$car_model ); 

    // print_r($colors_in);
    
    $argz = [
        'post_type' => 'car_gallery',
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'model_filter',
                'value' => '"'.$car_model.'"',
                'compare' => 'LIKE'
            ]
        ]
    ];


    // print_r($sub_models_in);
    // [
    //     'key' => 'submodel_filter',
    //     'value' => '"'.$sub_models_in.'"',
    //     'compare' => 'LIKE'
    // ]
    // $sub_models_in


    foreach( $sub_models_in as $sub_col ) {
        $argz['meta_query'][] = 
        [
            'key' => 'submodel_filter',
            'value' => '"'.$sub_col.'"',
            'compare' => 'LIKE'
        ];
    }


    foreach( $colors_in as $s_col ) {
        $argz['meta_query'][] = 
        [
            'key' => 'colors_filter',
            'value' => '"'.$s_col.'"',
            'compare' => 'LIKE'
        ];
    }
    

    // print_r($argz);

    $available['colors'] = $colors_in;
    $available['submodels'] = $sub_models_in;

    // print_r($_POST);
    // print_r($argz);

    $galz = new WP_Query($argz);


    // print_r( $galz->posts );

    
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
} else {


    $available_models = get_available_models();
    $sub_models = get_submodels( $available_models[0] );
    $colors = get_colors( $sub_models[0],$available_models[0] ); 

    
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
    'meta_query' => [
        'relation' => 'AND',
        [
            'key' => 'model_filter',
            'value' => '"'.$available_models[0].'"',
            'compare' => 'LIKE'
        ],
        [
            'key' => 'submodel_filter',
            'value' => '"'.$sub_models[0].'"',
            'compare' => 'LIKE'
        ],
        [
            'key' => 'colors_filter',
            'value' => '"'.$colors[0].'"',
            'compare' => 'LIKE'
        ],
    ]
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


                <?php
                    get_template_part('elements/car_features' , 'car_features' , $gals->posts);                    
                ?>


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
                                        'available' => $sub_models
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
                                        'available' => $colors
                                    ];
                                    echo get_template_part('elements/car_colors', 'car_colors' , $level_three_args );
                            } wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="big_button">
                        <a href="">
                            <span>?????????? ????????</span>
                            <span> ?????????????? online ??????/?? ?????? </span>
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
            get_template_part('elements/slide' , 'slide' , ['field' => get_field('bottom_gallery', $gals->posts[0]->ID ) ] );
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
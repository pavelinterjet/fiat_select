<?php get_header(); ?>

<?php $templ_path = get_stylesheet_directory_uri(); 

$flds = get_fields();

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
                    <div class="filtered_carousel">
                        <div class="car_img">
                            <img src="<?php echo $templ_path;?>/assets/img/3.png" alt="">
                        </div>
                        <div class="car_img">
                            <img src="<?php echo $templ_path;?>/assets/img/1.png" alt="">
                        </div>
                    </div>
                    <div class="is_desktop">
                        <div class="blue_title">CABRIO / LA PRIMA / OCEAN GREEN</div>
                        <div class="car_features ">
                            <ul class="flex_container flex__space_between flex_no_wrap__d">
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right">



                            <?php foreach ($flds as $key => $lvl_one_arr) { ?>

                                <div class="car_models filter_lvl">
                                    <div class="flex_container flex__space_between flex_reverse_row">
                                    <?php foreach($lvl_one_arr as $k => $lvl_one): ?>
                                        <?php $level_one_args = [
                                            'title' => $lvl_one['car_title'],
                                            'max' => max($lvl_one_arr),
                                            'counter' => $k,
                                            'temp_path' => $templ_path,
                                            'img_arr' => $lvl_one['car_img']
                                        ]; ?>
                                        <?php echo get_template_part('elements/car_model', 'car_model' , $level_one_args ); ?>
                                    <?php endforeach; ?>
                                    </div>
                                </div>

                                <?php 
                                // print_r($lvl_one['level_two']);
                                // die;
                                ?>

                                <div class="car_submodels filter_lvl">
                                    <div class="submodels_block" data-submodel='<?php echo $k;?>'>

                                        <?php foreach($lvl_one[$key]['level_two'] as $key => $lvl_two):
                                            
                                            print_r($lvl_one['level_two'][$key]['logo']);

                                            ?>

                                            <div class="flex_container flex__space_between flex_reverse_row">

                                                <?php $level_two_args = [
                                                    'max' => max($lvl_one['level_two']),
                                                    'counter' => $k,
                                                    'temp_path' => $templ_path,
                                                    'img_arr' => $lvl_two['logo']
                                                ]; ?>

                                                <?php echo get_template_part('elements/car_submodel', 'car_submodel' , $level_two_args ); ?>

                                            </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>

                                <div class="colors filter_lvl">
                                    <div class="flex_container flex__space_between flex_reverse_row">
                                        <?php echo get_template_part('elements/car_colors', 'car_colors' , ['max' => 3,'counter' => 0, 'temp_path' => $templ_path ] ); ?>
                                        <?php echo get_template_part('elements/car_colors', 'car_colors' , ['max' => 3,'counter' => 1, 'temp_path' => $templ_path ] ); ?>
                                        <?php echo get_template_part('elements/car_colors', 'car_colors' , ['max' => 3,'counter' => 2, 'temp_path' => $templ_path ] ); ?>
                                        <?php echo get_template_part('elements/car_colors', 'car_colors' , ['max' => 3,'counter' => 3, 'temp_path' => $templ_path ] ); ?>
                                    </div>
                                </div>


                            <?php } ?>


                    <!-- <div class="car_submodels filter_lvl">



                    </div> -->



                    <div class="big_button">
                        <a href="">
                            <span>למפרט המלא</span>
                            <span> ולהזמנה online לחצ/י כאן </span>
                        </a>
                    </div>

                    <div class="is_mobile">
                        <div class="blue_title">CABRIO / LA PRIMA / OCEAN GREEN</div>
                        <div class="car_features ">
                            <ul class="flex_container flex__space_between flex_no_wrap__d">
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                                <?php echo get_template_part('elements/car_features' , 'features' , ['חישוקי סגסוגת 17”' , 'תאורת LED']) ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="big_slider">


        <?php echo get_template_part('elements/slide' , 'slide' , ['temp_path' => $templ_path] );  ?>
        <?php echo get_template_part('elements/slide' , 'slide' , ['temp_path' => $templ_path] );  ?>
        <?php echo get_template_part('elements/slide' , 'slide' , ['temp_path' => $templ_path] );  ?>
        <?php echo get_template_part('elements/slide' , 'slide' , ['temp_path' => $templ_path] );  ?>


    </section>









    

</section>




<?php get_footer(); ?>
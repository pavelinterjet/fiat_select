<?php get_header(); ?>

<?php $templ_path = get_stylesheet_directory_uri(); ?>








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
                    <div class="car_models filter_lvl">
                        <div class="flex_container flex__space_between flex_reverse_row">
                            <?php echo get_template_part('elements/car_model', 'car_model' , ['max' => 2,'counter' => 0, 'temp_path' => $templ_path ] ); ?>
                            <?php echo get_template_part('elements/car_model', 'car_model' , ['max' => 2, 'counter' => 1, 'temp_path' => $templ_path ] ); ?>
                            <?php echo get_template_part('elements/car_model', 'car_model' , ['max' => 2,'counter' => 2, 'temp_path' => $templ_path ] ); ?>
                        </div>
                    </div>
                    <div class="car_submodels filter_lvl">
                        <div class="flex_container flex__space_between flex_reverse_row">
                            <?php echo get_template_part('elements/car_submodel', 'car_submodel' , ['max' => 3,'counter' => 0, 'temp_path' => $templ_path ] ); ?>
                            <?php echo get_template_part('elements/car_submodel', 'car_submodel' , ['max' => 3,'counter' => 1, 'temp_path' => $templ_path ] ); ?>
                            <?php echo get_template_part('elements/car_submodel', 'car_submodel' , ['max' => 3,'counter' => 2, 'temp_path' => $templ_path ] ); ?>
                            <?php echo get_template_part('elements/car_submodel', 'car_submodel' , ['max' => 3,'counter' => 3, 'temp_path' => $templ_path ] ); ?>
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
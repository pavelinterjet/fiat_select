<?php 

if( $args ) {
    $pid = $args[0]->ID; 
    $img_gal = get_field('gallery' , $pid);
    $features = get_field('car_features' , $pid);
?>
    <div class="filtered_carousel ">
        <?php 
        if($img_gal){
        foreach( $img_gal as $ig ) { ?>
        <div class="car_img">
            <img src="<?php echo $ig['image']?>" alt="">
        </div>
        <?php }
        } ?>
    </div>

    <div class="secret_link" style="display: none;">
        <a href="<?php echo get_field('specs_link' , $pid); ?>"><span>למפרט המלא</span><span> ולהזמנה online לחצ/י כאן </span></a>
    </div>

    <div class="is_desktop">
            <div class="blue_title"> <?php echo get_the_title($pid);?> </div>
            <div class="car_features ">
                <ul class="flex_container flex__space_between flex_no_wrap__d">
                    <?php 
            if($features) {
                foreach ( $features as $feature ) { ?>
                <li>
                    <span> <?php echo $feature['first_line']; ?> </span>
                    <span> <?php echo $feature['second_line']; ?> </span>
                </li>
                <?php } } ?>
            </ul>
        </div>
    </div>
<?php } ?>
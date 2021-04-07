<?php 
if( $args ) {
    $pid = $args[0]->ID; 
    $img_gal = get_field('left_gallery' , $pid);
    if ( $img_gal ) {
        $features = $img_gal[0]['features'];
    } else {
        $features = NULL;
    }
?>
    <div class="filtered_carousel" data-pd='<?php echo $pid; ?>' dir='rtl'>
        <?php 
            if( $img_gal && $img_gal[0]['images']){
            foreach( $img_gal[0]['images'] as $ig ) { ?>
                <div class="car_img">
                    <img src="<?php echo $ig['image']['url']?>" alt="">
                </div>
        <?php }
        } ?>
    </div>

    <div class="secret_link" style="display: none;">
        <a href="<?php echo get_field('specs_link' , $pid); ?>"><span>למפרט המלא</span><span> ולהזמנה online לחצ/י כאן </span></a>
    </div>

    <div class="is_desktop">
    <?php 
        if ( $img_gal ) {
    ?>
        <div class="blue_title"> <?php echo $img_gal[0]['title'];?> </div>
    <?php } ?>
            <div class="car_features ">
                <ul class="flex_container flex__space_center flex_no_wrap__d">
                <?php
                if($features) {
                    foreach ( $features as $feature ) { ?>
                    <li>
                        <span> <?php echo $feature['feature']; ?> </span>
                        <span> <?php echo $feature['feature_line_2']; ?> </span>
                    </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
<?php } ?>
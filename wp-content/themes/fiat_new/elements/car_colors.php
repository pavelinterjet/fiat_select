<?php
if( isset($args['available']) && in_array($args['sp_id'] , $args['available']) ){

    
    $faded_class = 'bright';
} else {
    $faded_class = '';
}

    // $faded_class = '';

?>
<div class="car_m <?php echo $faded_class;?> <?php echo $args['counter'] == 1?'active':'';?>" data-filter_type='colors' data-count='<?php echo $args['counter']; ?>' data-filter='filter_<?php echo $args['sp_id']; ?>'>
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($args['sp_id']); ?>" alt="">
    </div>
</div>
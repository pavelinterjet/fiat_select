<?php
if( in_array($args['p_id'] , $args['available']) ){
    $faded_class = 'bright';
} else {
    $faded_class = '';
}
?>
<div class="car_m <?php echo $faded_class; ?> <?php echo $args['counter'] == $args['max']?'active':'';?>" data-filter_type='model' data-count='<?php echo $args['counter']; ?>' data-filter='filter_<?php echo $args['p_id']; ?>'>
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($args['p_id']); ?>" alt="<?php echo get_the_title($args['p_id']) ?>">
    </div>
    <div class="title">
        <?php echo get_the_title($args['p_id']) ?>
    </div>
</div>
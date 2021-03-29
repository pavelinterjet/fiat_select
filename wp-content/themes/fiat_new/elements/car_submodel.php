<?php
if( in_array($args['sp_id'] , $args['available']) ){
    $faded_class = 'bright';
} else {
    $faded_class = '';
}
?>

<div class="car_m <?php echo $faded_class; ?> <?php echo $args['counter'] == $args['max']?'active':'';?>" data-filter_type='submodel' data-count='<?php echo $args['counter']; ?>' data-filter='filter_<?php echo $args['sp_id']; ?>'>
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($args['sp_id']); ?>" alt="<?php echo get_the_title($args['sp_id']) ?>">
    </div>
</div>
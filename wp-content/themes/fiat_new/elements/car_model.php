<div class="car_m <?php echo $args['counter'] == $args['max']?'active':'';?>" data-filter='<?php echo $args['p_id']; ?>'>
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($args['p_id']); ?>" alt="<?php echo get_the_title($args['p_id']) ?>">
    </div>
    <div class="title">
        <?php echo get_the_title($args['p_id']) ?>
    </div>
</div>
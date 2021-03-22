<div class="car_m <?php echo $args['counter'] == $args['max']?'active':'';?>" data-filter='<?php echo $args['sp_id']; ?>'>
    <div class="thumb">
        <img src="<?php echo get_the_post_thumbnail_url($args['sp_id']); ?>" alt="<?php echo get_the_title($args['sp_id']) ?>">
    </div>
</div>
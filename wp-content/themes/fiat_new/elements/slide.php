<?php 

// print_r($args['field']);

if( $args['field'] ) {
    foreach( $args['field'] as $fld ) {
?>
    <div class="slide">
        <div class="thumb">
            <img src="<?php echo $fld['images']['url'] ?>" alt="">
        </div>
        <div class="big_title"> <?php echo $fld['title']; ?> </div>
        <div class="small_title"> <?php echo $fld['text']; ?> </div>
    </div>
<?php } 
} ?>
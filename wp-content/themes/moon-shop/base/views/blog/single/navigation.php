<div class="prev-next-post fix">
	<?php if( get_previous_post_link( '%link' ) ) { ?>
    <div class="prev-post float-left text-left">
        <span><?php esc_html_e( 'Previous Post' , 'moon-shop' ); ?></span>
        <?php previous_post_link( '%link' ); ?>
    </div>
	<?php } ?>
	
	<?php if( get_next_post_link( '%link' ) ) { ?>
    <div class="next-post float-right text-right">
        <span><?php esc_html_e( 'Next Post' , 'moon-shop' ); ?></span>
        <?php next_post_link( '%link' ); ?>
    </div>
	<?php }	?>
</div>
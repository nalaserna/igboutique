<div class="row blog-sidebar-col-2">
    <div class="col-sm-12">
        <h4 class="text-uppercase wl-color4">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>
        <?php $moon_shop_archive_year = get_the_time( 'Y' );
        $moon_shop_archive_month = get_the_time( 'm' );
        $moon_shop_archive_day = get_the_time( 'd' ); ?>
        <p>
            <?php echo the_time( 'F j, Y' ); ?>
        </p>
    </div>
</div>
<hr/>
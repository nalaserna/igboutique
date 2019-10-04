<?php

$moon_shop_optionsValue = get_option( 'moon_shop' );

$moon_shop_post_meta = '';

if( is_archive() ) {

    $moon_shop_post_meta = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-enable-disable' ] ) : '';

}

$moon_shop_post_meta = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-enable-disable' ] ) : '';

?>

<div class="sin-blog">

    <?php if( has_post_thumbnail() ) { ?>

        <div class="blog-image">

            <?php the_post_thumbnail( 'moon_shop_image_970x350' ); ?>

            <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading' , 'moon-shop' ); ?></a>

        </div>

    <?php } ?>

    <div class="blog-details">

        <div class="top fix">

            <span class="blog-cat float-left"><?php the_category( ', ' , get_the_ID() ); ?></span>

			<span class="top-meta float-right">

				<a href="<?php comments_link(); ?> "><?php comments_number( __('No Comment', 'moon-shop') , __('1 Comment', 'moon-shop') , __('% Comments', 'moon-shop') ); ?></a>

			</span>

        </div>

        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <?php if( $moon_shop_post_meta != '0' ) { ?>

            <div class="blog-meta">

                <?php esc_html_e( 'By' , 'moon-shop' ); ?> <a
                    href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
                | <a href="<?php the_permalink(); ?>"><?php echo the_time( 'M j, Y' ); ?></a>

            </div>

        <?php } ?>

        <?php the_excerpt(); ?>

    </div>

</div>
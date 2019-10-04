<?php
global $post;
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_post_meta = '';
$moon_shop_category = '';
if( is_archive() ) {
    $moon_shop_post_meta = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-enable-disable' ] ) : '';
    $moon_shop_category = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-category-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-category-enable-disable' ] ) : '';
} else {
    $moon_shop_post_meta = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-enable-disable' ] ) : '';
    $moon_shop_category = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-category-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-category-enable-disable' ] ) : '';
}
?>
<div class="sin-blog">
    <?php if( has_post_thumbnail() ) { ?>
        <div class="blog-image">
            <?php the_post_thumbnail( 'moon_shop_image_970x350' ); ?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading' , 'moon-shop' ); ?></a>
        </div>
    <?php } ?>
    <div class="blog-details sin-blog-wapper">
        <?php echo is_sticky( $post->ID ) ? '<div class="sticky"><span class="blog-sticky">sticky</span></div>' : ''; ?>
        <?php if( $moon_shop_category != '0' ) { ?>
            <div class="top fix">
			<span class="float-left">
                <?php
                $moon_shop_categories = get_the_category();
                $moon_shop_cat = '';
                foreach( $moon_shop_categories as $moon_shop_category ) {
                    echo '<a class="blog-cat margin-right-10" href="' . get_category_link( $moon_shop_category->cat_ID ) . '">' . esc_attr( $moon_shop_category->cat_name ) . '</a>';
                } ?>			
			</span>
			<span class="top-meta float-right">
				<a href="<?php comments_link(); ?> "><?php comments_number( __('No Comment', 'moon-shop') , __('1 Comment', 'moon-shop') , __('% Comments', 'moon-shop') ); ?></a>
			</span>
            </div>
        <?php } ?>
        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php if( $moon_shop_post_meta != '0' ) { ?>
            <div class="blog-meta">
                <span><?php esc_html_e( 'By' , 'moon-shop' ); ?> </span>
                <span><strong>
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
                </strong></span>
                <span>| </span>
                <a href="<?php the_permalink(); ?>"><?php echo the_time( 'M j, Y' ); ?></a>
            </div>
        <?php } ?>
        <?php the_excerpt(); ?>
    </div>
</div>
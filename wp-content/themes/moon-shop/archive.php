<?php
get_header();

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//blog archive banner on / off
$moon_shop_blog_title_enable = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-enable-disable' ] ) : '';
//select sidebar position
$moon_shop_blog_index_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-blog-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-sidebar-position' ] ) : '';
$moon_shop_col = '';
if( $moon_shop_blog_index_sidebar != '' && $moon_shop_blog_index_sidebar != 'no_sidebar' ) {
    $moon_shop_col = 'col-sm-8';
} else {
    $moon_shop_col = 'col-md-10 col-md-offset-1 without-sidebar';
}
?>
    <!-- Blog Page Banner -->
<?php if( $moon_shop_blog_title_enable != '0' ) {
    get_template_part( 'base/views/blog/archive-banner' );
} ?>

    <!-- Blog Page Container -->
    <div class="blog-page pages moon-shop-archive-content">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                <?php if( $moon_shop_blog_index_sidebar == 'left_sidebar' ) {
                    get_sidebar();
                } ?>
                <?php if( have_posts() ) { ?>
                    <div class="<?php echo esc_attr( $moon_shop_col ); ?>">
                        <?php
                        while( have_posts() ) : the_post();
                            get_template_part( 'base/views/post/content' , get_post_format() );
                        endwhile;
                        ?>
                        <span id="addMore"></span>
                        <!-- load more -->
                        <?php
                        $moon_shop_posts = wp_count_posts( 'post' , '' );
                        $moon_shop_posts->publish;
                        $moon_shop_post_limit = get_query_var( 'posts_per_page' );
                        if( $moon_shop_posts->publish > $moon_shop_post_limit ) {
                            get_template_part( 'base/views/load-more' );
                        }
                        ?>
                    </div>
                <?php } ?>
                <!-- Right Sidebar -->
                <?php if( $moon_shop_blog_index_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } ?>
            </div>
        </div>
    </div>

<?php get_footer();
<?php
get_header();
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//single meta option
$moon_shop_single_meta = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-meta-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-meta-enable-disable' ] ) : '';

//single navigation
$moon_shop_single_nav = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-nav-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-nav-enable-disable' ] ) : '';

//single category
$moon_shop_single_cat = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-cat-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-cat-enable-disable' ] ) : '';

//select sidebar position
$moon_shop_blog_single_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar' ] ) : '';
$moon_shop_col = '';
if( $moon_shop_blog_single_sidebar != '' && $moon_shop_blog_single_sidebar != 'no_sidebar' ) {
    $moon_shop_col = 'col-sm-8 with-sidebar';
} else {
    $moon_shop_col = 'col-sm-10 col-sm-offset-1 without-sidebar';
}

?>

<?php if( have_posts() ) {
    while( have_posts() ) : the_post(); ?>
        <!-- Blog single Page Container -->
        <div <?php post_class( 'blog-page single-blog pages' ); ?>>
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar -->
                    <?php if( $moon_shop_blog_single_sidebar == 'left_sidebar' ) {
                        get_sidebar();
                    } ?>

                    <div class="<?php echo esc_attr( $moon_shop_col ); ?>">
                        <?php if( has_post_thumbnail() ) { ?>
                            <div class="blog-image">
                                <?php the_post_thumbnail( 'full' ); ?>
                            </div>
                        <?php } ?>
                        <div class="sin-blog-wapper">
                            <div class="sin-blog-post">
                                <div class="blog-details">
                                    <?php if( $moon_shop_single_cat != '0' ) { ?>
                                        <div class="top fix blog-categories">
                                            <?php
                                            $moon_shop_categories = get_the_category();
                                            $moon_shop_cat = '';
                                            foreach( $moon_shop_categories as $moon_shop_category ) {

                                                echo '<a class="blog-cat" href="' . get_category_link( $moon_shop_category->cat_ID ) . '">' . esc_attr( $moon_shop_category->cat_name ) . '</a>';
                                            } ?>
                                        </div>
                                    <?php } ?>
                                    <h1 class="title"><?php the_title(); ?></h1>
                                    <?php if( $moon_shop_single_meta != '0' ) { ?>
                                        <div class="blog-meta">
                                            <?php
                                            $moon_shop_archive_year = get_the_time( 'Y' );
                                            $moon_shop_archive_month = get_the_time( 'm' );
                                            $moon_shop_archive_day = get_the_time( 'd' );
                                            ?>
                                            <span><?php esc_html_e( 'By' , 'moon-shop' ); ?> </span>
                                            <span>
                                                <strong><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) , get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></strong>
                                            </span>
                                            <span>| </span>
                                            <a href="<?php echo get_day_link( $moon_shop_archive_year , $moon_shop_archive_month , $moon_shop_archive_day ); ?>"><?php echo the_time( 'M j, Y' ); ?></a>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    the_content();
                                    $moon_shop_defaults = array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:' , 'moon-shop' ) . '</span>' , 'after' => '</div>' , 'link_before' => '<span>' , 'link_after' => '</span>' , 'pagelink' => '<span class="screen-reader-text">' . esc_html__( ' ' , 'moon-shop' ) . ' </span>%' , 'separator' => '<span class="screen-reader-text"> </span>' , );
                                    wp_link_pages( $moon_shop_defaults );
                                    ?>
                                    <!-- blog single tag share -->
                                    <?php get_template_part( 'base/views/blog/single/tag-share' ); ?>
                                </div>
                            </div>

                            <!-- blog single navigation -->
                            <?php
                            if( $moon_shop_single_nav != '0' ) {
                                get_template_part( 'base/views/blog/single/navigation' );
                            }
                            ?>

                            <div class="blog-comments fix">
                                <?php if( comments_open() || get_comments_number() ) { ?>

                                <?php
                                }
                                // If comments are open or we have at least one comment, load up the comment template.
                                if( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Right Sidebar -->
                    <?php if( $moon_shop_blog_single_sidebar == 'right_sidebar' ) {
                        get_sidebar();
                    } ?>
                </div>
            </div>
        </div>
    <?php endwhile;
} ?>

<?php get_footer();
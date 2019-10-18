<?php
/**
 * Clients shortcode
 */
extract( shortcode_atts( array( 
    'post_to_show' => '',
    'category_slug' => '',
    'blog_style' => '',
    'is_meta_info' => '',
    'order' => '',
    'order_by' => ''

    ) , $atts ) 
);

?>
<?php 
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $post_to_show,
        /*    'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_slug,
                ),
            ),
            'category' => 'category',*/
            'order' => $order ,
            'orderby' => $order_by
        );
    
    $slider = new WP_Query( $args );

    if( $slider->have_posts() ) {
        if($blog_style == 'slider') { ?>
            <div class="blog-slider home1-blog-slider">
        <?php } ?>
        <?php while( $slider->have_posts() ) : $slider->the_post();
                if($blog_style == 'slider') { ?>
                    <div class="blog-item">
                    <!-- Blog Image -->
                        <div class="blog-image col-lg-6 col-sm-5">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'moon_shop_image_270x267' ); ?></a>
                        </div>
                        <!-- Blog Content -->
                        <div class="blog-content col-lg-6 col-sm-7">
                            <?php if($is_meta_info !== 'yes'){?>
                            <span class="blog-date"><?php echo the_time('M j, Y'); ?></span>
                             <?php }?>
                            <h2>
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo the_title(); ?>
                                </a>
                            </h2>
                            <?php echo the_excerpt(); ?>
                            <?php if($is_meta_info !== 'yes'){?>
                                <span>By</span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="blog-author"> <?php the_author(); ?></a>
                             <?php }?>
                        </div>
                       
                    </div>
               <?php } else { ?>
                <div class="sin-blog">
                    <?php if( has_post_thumbnail() ) { ?>
                        <div class="blog-image">
                            <?php the_post_thumbnail( 'moon_shop_image_970x350' ); ?>
                            <a href="<?php the_permalink(); ?>">Continue Reading</a>
                        </div>
                    <?php }?>
                    <div class="blog-details">
                        <div class="top fix">
                            <span class="blog-cat float-left"><?php the_category( ', ', get_the_ID() ); ?></span>
                            <?php if($is_meta_info !== 'yes'){?>
                            <span class="top-meta float-right">
                                <a href="<?php comments_link(); ?> "><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?></a> | 10 Shares
                            </span>
                            <?php }?>
                        </div>
                        <h2 class="title">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo the_title(); ?>
                            </a>
                        </h2>
                        <?php if($is_meta_info !== 'yes'){?>
                        <div class="blog-meta">
                            <?php esc_html_e( 'By', 'moon-wl' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> | <a href="<?php the_permalink(); ?>"><?php echo the_time('M j, Y'); ?></a>
                        </div>
                          <?php }?>
                    <?php echo the_excerpt(); ?>
                     </div>
                </div>  

           <?php } endwhile; wp_reset_postdata(); ?> 
           <?php if($blog_style == 'slider'){?>
   </div>
    <?php }?>
<?php
}?>

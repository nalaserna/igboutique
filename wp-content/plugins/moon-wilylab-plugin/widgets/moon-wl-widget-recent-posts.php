<?php
/**
 * Widget API: Moon_WL_Recent_Posts class
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 * @since 2.8.0
 * @see WP_Widget
 */
class Moon_Shop_Recent_Posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_recent_entries' , 
            'description' => __( 'Your site&#8217;s most recent Posts.' , 'moon-shop' ) , 
            'customize_selective_refresh' => true , 
        );
        parent::__construct( 'recent-posts' , __( 'Moon Recent Posts' , 'moon-shop' ) , $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     * @since 2.8.0
     * @access public
     * @param array $args Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args , $instance ) {
        if( !isset( $args[ 'widget_id' ] ) ) {
            $args[ 'widget_id' ] = $this->id;
        }

        $title = ( !empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'Recent Posts' , 'moon-shop' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title' , $title , $instance , $this->id_base );

        $number = ( !empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 5;
        if( !$number ) $number = 5;
        $show_date = isset( $instance[ 'show_date' ] ) ? $instance[ 'show_date' ] : false;

        /**
         * Filters the arguments for the Recent Posts widget.
         * @since 3.4.0
         * @see WP_Query::get_posts()
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args' , array( 'posts_per_page' => $number , 'no_found_rows' => true , 'post_status' => 'publish' , 'ignore_sticky_posts' => true ) ) );

        if( $r->have_posts() ) :
            ?>
            <?php echo( $args[ 'before_widget' ] ); ?>
            <?php if( $title ) {
            echo( $args[ 'before_title' ] . $title . $args[ 'after_title' ] );
        } ?>

            <?php while( $r->have_posts() ) : $r->the_post(); ?>
            <div class="single-recent-post">
                <div class="recent-post-thumb">
                    <?php the_post_thumbnail( '' ); ?>
                </div>
                <div class="recent-post-text">
                    <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                    <?php if( $show_date ) : ?>
                        <p><?php esc_html_e( 'By' , 'moon-shop' ); ?><a class="recent-cate"
                                                                        href="#"> <?php echo get_the_author(); ?> </a>|
                            <?php echo get_the_date(); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>

            <?php echo( $args[ 'after_widget' ] ); ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     * @since 2.8.0
     * @access public
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance , $old_instance ) {
        $instance = $old_instance;
        $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'number' ] = (int)$new_instance[ 'number' ];
        $instance[ 'show_date' ] = isset( $new_instance[ 'show_date' ] ) ? (bool)$new_instance[ 'show_date' ] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     * @since 2.8.0
     * @access public
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
        $number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 5;
        $show_date = isset( $instance[ 'show_date' ] ) ? (bool)$instance[ 'show_date' ] : false;
        ?>
        <p><label
                for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' , 'moon-shop' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/></p>

        <p><label
                for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:' , 'moon-shop' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
                   value="<?php echo esc_attr( $number ); ?>" size="3"/></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?>
                  id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"/>
            <label
                for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php _e( 'Display post date?' , 'moon-shop' ); ?></label>
        </p>
    <?php
    }
}

function moon_shop_Recent_Posts_register() {
    register_widget( 'Moon_Shop_Recent_Posts' );
}

add_action( 'widgets_init' , 'moon_shop_Recent_Posts_register' );

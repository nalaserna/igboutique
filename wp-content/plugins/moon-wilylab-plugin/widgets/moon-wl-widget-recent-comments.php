<?php
/**
 * Widget API: Moon_WL_Recent_Comments class
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Comments widget.
 * @since 2.8.0
 * @see WP_Widget
 */
class Moon_Shop_Recent_Comments extends WP_Widget {

    /**
     * Sets up a new Recent Comments widget instance.
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array( 'classname' => 'widget_recent_comments' , 'description' => __( 'Your site&#8217;s most recent comments.' , 'moon-shop' ) , 'customize_selective_refresh' => true , );
        parent::__construct( 'recent-comments' , __( 'Moon Recent Comments' , 'moon-shop' ) , $widget_ops );
        $this->alt_option_name = 'widget_recent_comments';
    }

    /**
     * Outputs the default styles for the Recent Comments widget.
     * @since 2.8.0
     * @access public
     */
    public function recent_comments_style() {
        /**
         * Filters the Recent Comments default widget styles.
         * @since 3.1.0
         * @param bool $active Whether the widget is active. Default true.
         * @param string $id_base The widget ID.
         */
        if( !current_theme_supports( 'widgets' ) // Temp hack #14876
            || !apply_filters( 'show_recent_comments_widget_style' , true , $this->id_base )
        ) return;

        //enqueue inline style css
        wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
        $moon_shop_custom_inline_style = '';

        $moon_shop_custom_inline_style = '.recentcomments a{ display:inline !important;padding:0 !important;margin:0 !important;}';
        wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );
    }

    /**
     * Outputs the content for the current Recent Comments widget instance.
     * @since 2.8.0
     * @access public
     * @param array $args Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Comments widget instance.
     */
    public function widget( $args , $instance ) {
        if( !isset( $args[ 'widget_id' ] ) ) $args[ 'widget_id' ] = $this->id;

        $output = '';

        $title = ( !empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : __( 'Recent Comments' , 'moon-shop' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title' , $title , $instance , $this->id_base );

        $number = ( !empty( $instance[ 'number' ] ) ) ? absint( $instance[ 'number' ] ) : 5;
        if( !$number ) $number = 5;

        /**
         * Filters the arguments for the Recent Comments widget.
         * @since 3.4.0
         * @see WP_Comment_Query::query() for information on accepted arguments.
         * @param array $comment_args An array of arguments used to retrieve the recent comments.
         */
        $comments = get_comments( apply_filters( 'widget_comments_args' , array( 'number' => $number , 'status' => 'approve' , 'post_status' => 'publish' ) ) );

        $output .= $args[ 'before_widget' ];
        if( $title ) {
            $output .= $args[ 'before_title' ] . $title . $args[ 'after_title' ];
        }

        $output .= '<div class="recent-com">';
        $output .= '<ul>';
        if( is_array( $comments ) && $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments , 'comment_post_ID' ) );
            _prime_post_caches( $post_ids , strpos( get_option( 'permalink_structure' ) , '%category%' ) , false );

            foreach( (array)$comments as $comment ) {
                $output .= '<li class="recentcomments">';
                /* translators: comments widget: 1: comment author, 2: post link */
                $output .= sprintf( _x( '%1$s on %2$s' , 'widgets' , 'moon-shop' ) , '<b>' . get_comment_author_link( $comment ) . '</b>' , '<a href="' . esc_url( get_comment_link( $comment ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>' );
                $output .= '</li>';
            }
        }
        $output .= '</ul>';
        $output .= '</div>';
        $output .= $args[ 'after_widget' ];

        echo( $output );
    }

    /**
     * Handles updating settings for the current Recent Comments widget instance.
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
        $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Comments widget.
     * @since 2.8.0
     * @access public
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $number = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 5;
        ?>
        <p><label
                for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' , 'moon-shop' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/></p>

        <p><label
                for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of comments to show:' , 'moon-shop' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1"
                   value="<?php echo esc_attr( $number ); ?>" size="3"/></p>
    <?php
    }
}

function moon_shop_Widget_comments_register() {
    register_widget( 'Moon_Shop_Recent_Comments' );
}

add_action( 'widgets_init' , 'moon_shop_Widget_comments_register' );
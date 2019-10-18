<?php
/**
 * Widget API: Moon_Shop_Widget_Archives class
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Archives widget.
 * @since 2.8.0
 * @see WP_Widget
 */
class Moon_Shop_Widget_Archives extends WP_Widget {

    /**
     * Sets up a new Archives widget instance.
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array( 'classname' => 'widget_archive' , 'description' => esc_html__( 'A monthly archive of your site&#8217;s Posts.' , 'moon-shop' ) , 'customize_selective_refresh' => true , );
        parent::__construct( 'archives' , esc_html__( 'Moon Archives' , 'moon-shop' ) , $widget_ops );
    }

    /**
     * Outputs the content for the current Archives widget instance.
     * @since 2.8.0
     * @access public
     * @param array $args Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Archives widget instance.
     */
    public function widget( $args , $instance ) {
        $c = !empty( $instance[ 'count' ] ) ? '1' : '0';
        $d = !empty( $instance[ 'dropdown' ] ) ? '1' : '0';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title' , empty( $instance[ 'title' ] ) ? esc_html__( 'Archives' , 'moon-shop' ) : $instance[ 'title' ] , $instance , $this->id_base );

        echo( $args[ 'before_widget' ] );
        if( $title ) {
            echo( $args[ 'before_title' ] . $title . $args[ 'after_title' ] );
        }

        if( $d ) {
            $dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
            ?>
            <label class="screen-reader-text"
                   for="<?php echo esc_attr( $dropdown_id ); ?>"><?php echo esc_attr( $title ); ?></label>
            <div class="able-option">
                <select id="<?php echo esc_attr( $dropdown_id ); ?>" name="archive-dropdown"
                        onchange='document.location.href=this.options[this.selectedIndex].value;'>
                    <?php
                    /**
                     * Filters the arguments for the Archives widget drop-down.
                     * @since 2.8.0
                     * @see wp_get_archives()
                     * @param array $args An array of Archives widget drop-down arguments.
                     */
                    $dropdown_args = apply_filters( 'widget_archives_dropdown_args' , array( 'type' => 'monthly' , 'format' => 'option' , 'show_post_count' => $c ) );

                    switch( $dropdown_args[ 'type' ] ) {
                        case 'yearly':
                            $label = esc_html__( 'Select Year' , 'moon-shop' );
                            break;
                        case 'monthly':
                            $label = esc_html__( 'Select Month' , 'moon-shop' );
                            break;
                        case 'daily':
                            $label = esc_html__( 'Select Day' , 'moon-shop' );
                            break;
                        case 'weekly':
                            $label = esc_html__( 'Select Week' , 'moon-shop' );
                            break;
                        default:
                            $label = esc_html__( 'Select Post' , 'moon-shop' );
                            break;
                    }
                    ?>

                    <option value=""><?php echo esc_attr( $label ); ?></option>
                    <?php wp_get_archives( $dropdown_args ); ?>

                </select>
            </div>
        <?php } else { ?>
            <div class="blog-cat">
                <ul>
                    <?php
                    /**
                     * Filters the arguments for the Archives widget.
                     * @since 2.8.0
                     * @see wp_get_archives()
                     * @param array $args An array of Archives option arguments.
                     */
                    wp_get_archives( apply_filters( 'widget_archives_args' , array( 'type' => 'monthly' , 'show_post_count' => $c ) ) );
                    ?>
                </ul>
            </div>
        <?php
        }

        echo( $args[ 'after_widget' ] );
    }

    /**
     * Handles updating settings for the current Archives widget instance.
     * @since 2.8.0
     * @access public
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget_Archives::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance , $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array)$new_instance , array( 'title' => '' , 'count' => 0 , 'dropdown' => '' ) );
        $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'count' ] = $new_instance[ 'count' ] ? 1 : 0;
        $instance[ 'dropdown' ] = $new_instance[ 'dropdown' ] ? 1 : 0;

        return $instance;
    }

    /**
     * Outputs the settings form for the Archives widget.
     * @since 2.8.0
     * @access public
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $instance = wp_parse_args( (array)$instance , array( 'title' => '' , 'count' => 0 , 'dropdown' => '' ) );
        $title = sanitize_text_field( $instance[ 'title' ] );
        ?>
        <p><label
                for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' , 'moon-shop' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/></p>
        <p>
            <input class="checkbox" type="checkbox"<?php checked( $instance[ 'dropdown' ] ); ?>
                   id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>"/> <label
                for="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"><?php esc_html_e( 'Display as dropdown' , 'moon-shop' ); ?></label>
            <br/>
            <input class="checkbox" type="checkbox"<?php checked( $instance[ 'count' ] ); ?>
                   id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"/> <label
                for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show post counts' , 'moon-shop' ); ?></label>
        </p>
    <?php
    }
}

function moon_shop_Widget_archive_register() {
    register_widget( 'Moon_Shop_Widget_Archives' );
}

add_action( 'widgets_init' , 'moon_shop_Widget_archive_register' );

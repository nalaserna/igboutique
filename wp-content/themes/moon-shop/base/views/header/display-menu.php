<?php
Class moon_shop_Walker extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     * @see Walker::start_lvl()
     * @since 3.0.0
     * @param string $moon_shop_output Passed by reference. Used to append additional content.
     * @param int $moon_shop_depth Depth of menu item. Used for padding.
     * @param array $moon_shop_args An array of arguments. @see wp_nav_menu()
     */

    public function start_lvl( &$moon_shop_output , $moon_shop_depth = 0 , $moon_shop_args = array() ) {
        $moon_shop_indent = str_repeat( "\t" , $moon_shop_depth );
        $moon_shop_output .= "\n$moon_shop_indent<ul class=\"sub-menu\">\n";
    }

    /**
     * Ends the list of after the elements are added.
     * @see Walker::end_lvl()
     * @since 3.0.0
     * @param string $moon_shop_output Passed by reference. Used to append additional content.
     * @param int $moon_shop_depth Depth of menu item. Used for padding.
     * @param array $moon_shop_args An array of arguments. @see wp_nav_menu()
     */

    public function end_lvl( &$moon_shop_output , $moon_shop_depth = 0 , $moon_shop_args = array() ) {
        $moon_shop_indent = str_repeat( "\t" , $moon_shop_depth );
        $moon_shop_output .= "$moon_shop_indent</ul>\n";
    }

    /**
     * Start the element output.
     * @see Walker::start_el()
     * @since 3.0.0
     * @since 4.4.0 'nav_menu_item_args' filter was added.
     * @param string $moon_shop_output Passed by reference. Used to append additional content.
     * @param object $moon_shop_item Menu item data object.
     * @param int $moon_shop_depth Depth of menu item. Used for padding.
     * @param array $moon_shop_args An array of arguments. @see wp_nav_menu()
     * @param int $moon_shop_id Current item ID.
     */

    public function start_el( &$moon_shop_output , $moon_shop_item , $moon_shop_depth = 0 , $moon_shop_args = array() , $moon_shop_id = 0 ) {
        $moon_shop_indent = ( $moon_shop_depth ) ? str_repeat( "\t" , $moon_shop_depth ) : '';
        $moon_shop_classes = empty( $moon_shop_item->classes ) ? array() : (array)$moon_shop_item->classes;
        $moon_shop_classes[ ] = 'menu-item-' . $moon_shop_item->ID;
        while( have_posts() ):
            the_post();
            global $post;
            $moon_shop_onePage = esc_attr( get_post_meta( $post->ID , 'w-is-one-page' , true ) );
            if( 'on' == $moon_shop_onePage ) {
                $moon_shop_permalink = get_the_permalink();
            }
        endwhile;

        /**
         * Filter the arguments for a single nav menu item.
         * @since 4.4.0
         * @param array $moon_shop_args An array of arguments.
         * @param object $moon_shop_item Menu item data object.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         */

        $moon_shop_args = apply_filters( 'nav_menu_item_args' , $moon_shop_args , $moon_shop_item , $moon_shop_depth );

        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         * @since 3.0.0
         * @since 4.1.0 The `$moon_shop_depth` parameter was added.
         * @param array $moon_shop_classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $moon_shop_item The current menu item.
         * @param array $moon_shop_args An array of {@see wp_nav_menu()} arguments.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         */

        $moon_shop_class_names = join( ' ' , apply_filters( 'nav_menu_css_class' , array_filter( $moon_shop_classes ) , $moon_shop_item , $moon_shop_args , $moon_shop_depth ) );

        //enqueue inline style css
        wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
        $moon_shop_custom_inline_style = '';

        //add mega menu class in parent class li 
        if( $moon_shop_depth == 0 ) {
            $moon_shop_megaMenu = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-mega-menu' , true ) );
            $moon_shop_megaMenuColumn = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-mega-menu-column' , true ) );
            if( $moon_shop_megaMenu == 1 ) {
                $moon_shop_class_names .= ' mega-menu mega-menu' . $moon_shop_item->ID;
            }
            if( $moon_shop_megaMenuColumn != '' && $moon_shop_megaMenuColumn == 2 ) {
                $moon_shop_custom_inline_style .= '.mega-menu' . $moon_shop_item->ID . ' > .sub-menu li { width: 47%; margin-right: 3%; }';
            } else if( $moon_shop_megaMenuColumn != '' && $moon_shop_megaMenuColumn == 3 ) {
                $moon_shop_custom_inline_style .= '.mega-menu' . $moon_shop_item->ID . ' > .sub-menu li { width: 31%; margin-right: 2%; }';
            } else if( $moon_shop_megaMenuColumn != '' && $moon_shop_megaMenuColumn == 4 ) {
                $moon_shop_custom_inline_style .= '.mega-menu' . $moon_shop_item->ID . ' > .sub-menu li { width: 23%; margin-right: 2%; }';
            } else if( $moon_shop_megaMenuColumn != '' && $moon_shop_megaMenuColumn == 5 ) {
                $moon_shop_custom_inline_style .= '.mega-menu' . $moon_shop_item->ID . ' > .sub-menu li { width: 18.5%; margin-right: 1.5%; }';
            }
        }

        if( $moon_shop_depth == 1 ) {
            $moon_shop_navImage = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-mega-menu-img' , true ) );
            if( $moon_shop_navImage != '' ) {
                $moon_shop_class_names .= ' mega-menu-add-image';
                //$moon_shop_custom_inline_style .= '.mega-menu-add-image span { background: url(' . $moon_shop_navImage . ') no-repeat; background-size: 100% 100% !important; height: 150px; border-bottom: none; width: 100%; }';
            }
        }

        $moon_shop_class_names = $moon_shop_class_names ? ' class="' . esc_attr( $moon_shop_class_names ) . '"' : '';

        /**
         * Filter the ID applied to a menu item's list item element.
         * @since 3.0.1
         * @since 4.1.0 The `$moon_shop_depth` parameter was added.
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $moon_shop_item The current menu item.
         * @param array $moon_shop_args An array of {@see wp_nav_menu()} arguments.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         */

        $moon_shop_id = apply_filters( 'nav_menu_item_id' , 'menu-item-' . $moon_shop_item->ID , $moon_shop_item , $moon_shop_args , $moon_shop_depth );

        $moon_shop_id = $moon_shop_id ? ' id="' . esc_attr( $moon_shop_id ) . '"' : '';

        $moon_shop_badge = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-badge-color' , true ) );

        $moon_shop_custom_inline_style .= '#menu-item-' . $moon_shop_item->ID . ' span.moon-menu-badge { background-color: '.$moon_shop_badge.'; } #menu-item-' . $moon_shop_item->ID . ' span.moon-menu-badge:before {border-color: '.$moon_shop_badge.';}';

        wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );

        $moon_shop_output .= $moon_shop_indent . '<li' . $moon_shop_id . $moon_shop_class_names . '>';

        $atts = array();
        $atts[ 'title' ] = !empty( $moon_shop_item->attr_title ) ? $moon_shop_item->attr_title : '';
        $atts[ 'target' ] = !empty( $moon_shop_item->target ) ? $moon_shop_item->target : '';
        $atts[ 'rel' ] = !empty( $moon_shop_item->xfn ) ? $moon_shop_item->xfn : '';
        $atts[ 'href' ] = !empty( $moon_shop_item->url ) ? $moon_shop_item->url : '';

        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         * @since 3.6.0
         * @since 4.1.0 The `$moon_shop_depth` parameter was added.
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         * @type string $moon_shop_title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         * @param object $moon_shop_item The current menu item.
         * @param array $moon_shop_args An array of {@see wp_nav_menu()} arguments.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         */

        $atts = apply_filters( 'nav_menu_link_attributes' , $atts , $moon_shop_item , $moon_shop_args , $moon_shop_depth );

        $attributes = '';
        foreach( $atts as $attr => $value ) {
            if( !empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                if( $moon_shop_depth == 1 ) {
                    if( 'href' === $attr ) {
                        $moon_shop_parent = $moon_shop_item->menu_item_parent;
                        $moon_shop_isParentMegaMenu = esc_attr( get_post_meta( $moon_shop_parent , 'w-mega-menu' , true ) );
                        if( !$moon_shop_isParentMegaMenu ) {
                            $attributes .= ' ' . $attr . '="' . $value . '"';
                        }
                    }
                } else {
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $moon_shop_title = apply_filters( 'the_title' , $moon_shop_item->title , $moon_shop_item->ID );

        /**
         * Filter a menu item's title.
         * @since 4.4.0
         * @param string $moon_shop_title The menu item's title.
         * @param object $moon_shop_item The current menu item.
         * @param array $moon_shop_args An array of {@see wp_nav_menu()} arguments.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         */

        $moon_shop_title = apply_filters( 'nav_menu_item_title' , $moon_shop_title , $moon_shop_item , $moon_shop_args , $moon_shop_depth );
        $moon_shop_item_output = '';
        // If this is depth 1 and under mega menu do this
        if( $moon_shop_depth == 1 ) {
            $moon_shop_parent = $moon_shop_item->menu_item_parent;
            $moon_shop_isParentMegaMenu = esc_attr( get_post_meta( $moon_shop_parent , 'w-mega-menu' , true ) );

            if( $moon_shop_isParentMegaMenu ) {
                $moon_shop_hide_title = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-mega-menu-hide-title' , true ) );
                $moon_shop_navImage = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-mega-menu-img' , true ) );
                $moon_shop_item_output = $moon_shop_args->before;
                if( $moon_shop_hide_title == 1 ) {
                    $moon_shop_item_output .= '<span class="mega-title-hide-title mega-title"' . $attributes . '>'.$moon_shop_args->link_before . $moon_shop_title . $moon_shop_args->link_after.'</span>';
                } else {
                    $moon_shop_item_output .= '<span class="mega-title"' . $attributes . '>'.$moon_shop_args->link_before . $moon_shop_title . $moon_shop_args->link_after.'</span>';
                }
                if( $moon_shop_navImage != '' ) {
                    $moon_shop_item_output .= '<img src="' . $moon_shop_navImage . '" alt="'.esc_html__( 'Mega Menu' , 'moon-shop' ).'" />';
                } 
                // if( $moon_shop_navImage == '' ) {
                //     $moon_shop_item_output .= $moon_shop_args->link_before . $moon_shop_title . $moon_shop_args->link_after;
                //     $moon_shop_item_output .= '</span>';
                // }
                $moon_shop_item_output .= $moon_shop_args->after;
            } else {
                if( isset( $moon_shop_args->before ) ) $moon_shop_item_output = $moon_shop_args->before;
                $moon_shop_item_output .= '<a' . $attributes . '>';
                if( isset( $moon_shop_args->link_before ) && isset( $moon_shop_args->link_after ) ) $moon_shop_item_output .= $moon_shop_args->link_before . $moon_shop_title . $moon_shop_args->link_after;
                $moon_shop_badge = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-badge-label' , true ) );

                if (!empty($moon_shop_badge)) {
                    $moon_shop_item_output .= '<span class="moon-menu-badge">'.$moon_shop_badge.'</span>';
                }
                $moon_shop_item_output .= '</a>';
                if( isset( $moon_shop_args->after ) ) $moon_shop_item_output .= $moon_shop_args->after;
            }
        } else {
            if( isset( $moon_shop_args->before ) ) $moon_shop_item_output = $moon_shop_args->before;
            $moon_shop_item_output .= '<a' . $attributes . '>';
            if( isset( $moon_shop_args->link_before ) && isset( $moon_shop_args->link_after ) ) $moon_shop_item_output .= $moon_shop_args->link_before . $moon_shop_title . $moon_shop_args->link_after;
            $moon_shop_badge = esc_attr( get_post_meta( $moon_shop_item->ID , 'w-badge-label' , true ) );

            if (!empty($moon_shop_badge)) {
                $moon_shop_item_output .= '<span class="moon-menu-badge">'.$moon_shop_badge.'</span>';
            }
            $moon_shop_item_output .= '</a>';
            if( isset( $moon_shop_args->after ) ) $moon_shop_item_output .= $moon_shop_args->after;
        }

        /**
         * Filter a menu item's starting output.
         * The menu item's starting output only includes `$moon_shop_args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$moon_shop_args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         * @since 3.0.0
         * @param string $moon_shop_item_output The menu item's starting HTML output.
         * @param object $moon_shop_item Menu item data object.
         * @param int $moon_shop_depth Depth of menu item. Used for padding.
         * @param array $moon_shop_args An array of {@see wp_nav_menu()} arguments.
         */
        $moon_shop_output .= apply_filters( 'walker_nav_menu_start_el' , $moon_shop_item_output , $moon_shop_item , $moon_shop_depth , $moon_shop_args );
    }

    /**
     * Ends the element output, if needed.
     * @see Walker::end_el()
     * @since 3.0.0
     * @param string $moon_shop_output Passed by reference. Used to append additional content.
     * @param object $moon_shop_item Page data object. Not used.
     * @param int $moon_shop_depth Depth of page. Not Used.
     * @param array $moon_shop_args An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$moon_shop_output , $moon_shop_item , $moon_shop_depth = 0 , $moon_shop_args = array() ) {
        $moon_shop_output .= "</li>\n";
    }
}
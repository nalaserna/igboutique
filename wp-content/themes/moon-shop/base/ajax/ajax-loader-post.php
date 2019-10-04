<?php
add_action( 'wp_ajax_nopriv_moon_shop_ajax_loadmore_post' , 'moon_shop_ajax_loadmore_post' );
add_action( 'wp_ajax_moon_shop_ajax_loadmore_post' , 'moon_shop_ajax_loadmore_post' );

function moon_shop_ajax_loadmore_post() {
    $moon_shop_postType = esc_attr( $_POST[ 'postType' ] );
    $moon_shop_postPerPage = esc_attr( $_POST[ 'postsPerPage' ] );
    $moon_shop_pageNumber = esc_attr( $_POST[ 'pageNumber' ] );
    $moon_shop_terms = esc_attr( $_POST[ 'terms' ] );
    $moon_shop_archive = esc_attr( $_POST[ 'archive' ] );
    $moon_shop_author = esc_attr( $_POST[ 'author' ] );
    $moon_shop_data = array();
    $moon_shop_data[ 'post' ] = moon_shop_post_query( $moon_shop_postType , $moon_shop_postPerPage , $moon_shop_pageNumber , $moon_shop_terms , $moon_shop_archive , $moon_shop_author );
    $moon_shop_post_count = moon_shop_post_count( $moon_shop_postType , $moon_shop_postPerPage , $moon_shop_pageNumber , $moon_shop_terms , $moon_shop_archive , $moon_shop_author );
	$moon_shop_data[ 'count' ] = count($moon_shop_post_count->posts);
    echo json_encode( $moon_shop_data );
    wp_die();
}

function moon_shop_post_count( $moon_shop_postType , $moon_shop_postPerPage , $moon_shop_pageNumber , $moon_shop_terms , $moon_shop_archive , $moon_shop_author ) {
    if( $moon_shop_terms != '' ) {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category' ,
                    'field' => 'name' ,
                    'terms' => $moon_shop_terms ,
                ) ,
            ) ,
        );
    } else if( $moon_shop_archive != '' ) {
        $my = explode( '*' , $moon_shop_archive );
        $moon_shop_month = '';
        if( $my[ 1 ] == 'January' ) {
            $moon_shop_month = 1;
        } else if( $my[ 1 ] == 'February' ) {
            $moon_shop_month = 2;
        } else if( $my[ 1 ] == 'March' ) {
            $moon_shop_month = 3;
        } else if( $my[ 1 ] == 'April' ) {
            $moon_shop_month = 4;
        } else if( $my[ 1 ] == 'May' ) {
            $moon_shop_month = 5;
        } else if( $my[ 1 ] == 'June' ) {
            $moon_shop_month = 6;
        } else if( $my[ 1 ] == 'July' ) {
            $moon_shop_month = 7;
        } else if( $my[ 1 ] == 'August' ) {
            $moon_shop_month = 8;
        } else if( $my[ 1 ] == 'September' ) {
            $moon_shop_month = 9;
        } else if( $my[ 1 ] == 'October' ) {
            $moon_shop_month = 10;
        } else if( $my[ 1 ] == 'November' ) {
            $moon_shop_month = 11;
        } else if( $my[ 1 ] == 'December' ) {
            $moon_shop_month = 12;
        }
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'year' => $my[ 2 ] ,
            'monthnum' => $moon_shop_month
        );
    } else if( $moon_shop_author != '' ) {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'who' => $moon_shop_author
        );
    } else {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber
        );
    }
    $moon_shop_post = new WP_Query( $moon_shop_args );
    return $moon_shop_post;
}

function moon_shop_post_query( $moon_shop_postType , $moon_shop_postPerPage , $moon_shop_pageNumber , $moon_shop_terms , $moon_shop_archive , $moon_shop_author ) {
    if( $moon_shop_terms != '' ) {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category' ,
                    'field' => 'name' ,
                    'terms' => $moon_shop_terms ,
                ) ,
            ) ,
        );
    } else if( $moon_shop_archive != '' ) {
        $my = explode( '*' , $moon_shop_archive );
        $moon_shop_month = '';
        if( $my[ 1 ] == 'January' ) {
            $moon_shop_month = 1;
        } else if( $my[ 1 ] == 'February' ) {
            $moon_shop_month = 2;
        } else if( $my[ 1 ] == 'March' ) {
            $moon_shop_month = 3;
        } else if( $my[ 1 ] == 'April' ) {
            $moon_shop_month = 4;
        } else if( $my[ 1 ] == 'May' ) {
            $moon_shop_month = 5;
        } else if( $my[ 1 ] == 'June' ) {
            $moon_shop_month = 6;
        } else if( $my[ 1 ] == 'July' ) {
            $moon_shop_month = 7;
        } else if( $my[ 1 ] == 'August' ) {
            $moon_shop_month = 8;
        } else if( $my[ 1 ] == 'September' ) {
            $moon_shop_month = 9;
        } else if( $my[ 1 ] == 'October' ) {
            $moon_shop_month = 10;
        } else if( $my[ 1 ] == 'November' ) {
            $moon_shop_month = 11;
        } else if( $my[ 1 ] == 'December' ) {
            $moon_shop_month = 12;
        }
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'year' => $my[ 2 ] ,
            'monthnum' => $moon_shop_month
        );
    } else if( $moon_shop_author != '' ) {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber ,
            'who' => $moon_shop_author
        );
    } else {
        $moon_shop_args = array(
            'post_type' => $moon_shop_postType ,
            'posts_per_page' => $moon_shop_postPerPage ,
            'offset' => $moon_shop_postPerPage * $moon_shop_pageNumber
        );
    }
    $moon_shop_post = new WP_Query( $moon_shop_args );
    if( $moon_shop_post->have_posts() ) {
        ob_start();
        while( $moon_shop_post->have_posts() ) : $moon_shop_post->the_post();
            get_template_part( 'base/views/post/content' , get_post_format() );
        endwhile;
        wp_reset_postdata();
        return ob_get_clean();
    }
}
<?php
function moon_shop_theme_comments($comment , $args , $depth) {

$GLOBALS[ 'comment' ] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="sin-comment">
        <div
            class="image float-left"><?php echo get_avatar( $comment , 70 , null , null , array( 'class' => array( 'img-responsive' , 'img-circle' ) ) ); ?></div>
        <div class="comment-details fix">
            <h3><?php comment_author(); ?></h3>
            <span
                class="date date-comments float-right"><?php echo get_comment_date() . esc_html__( ' at ' , 'moon-shop' ) . get_comment_time( $d = '' , $gmt = true , $translate = true ); ?></span>
            <?php edit_comment_link( '' , '' , '' ) ?>

            <?php comment_text() ?>

            <?php if( $comment->comment_approved == '0' ) : ?>
                <span
                    class="unapproved"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'moon-shop' ); ?></span>
            <?php endif; ?>

            <div class="bottom fix">

                <?php
                $moon_shop_class = 'reply float-left';
                echo preg_replace( '/comment-reply-link/' , 'comment-reply-link ' . $moon_shop_class , get_comment_reply_link( array_merge( $args , array( 'add_below' => '' , 'depth' => $depth , 'max_depth' => $args[ 'max_depth' ] ) ) ) , 1 );
                ?>

            </div>
        </div>
    </div>
    <?php
    }

    function moon_shop_list_pings($comment , $args , $depth) {

    $GLOBALS[ 'comment' ] = $comment;

    ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment-wrap comments-pings">
        <div class="comment-content">
            <div class="comment-meta">
                <span class="wl-ping-text-left"><?php esc_html_e( 'Pings: ' , 'moon-shop' ); ?></span>
                <?php printf( '<span class="comment_author">%s</span>' , get_comment_author_link() ); ?>
            </div>
            <div class="clearboth"></div>
        </div>
        <?php } ?>
        <div class="wl-blog-comments wl-full-width">
            <?php if (post_password_required()) : ?>
            <p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.' , 'moon-shop' ); ?></p>
        </div>
        <!-- #comments -->

    <?php
    return;

    endif;

    if (have_comments()) :

    function moon_shop_count_pings( $post_id = NULL ) {

        $pings = 0;

        $comments = FALSE;

        if( NULL !== $post_id ) {
            $comments = get_comments( array( 'post_id' => $post_id , # Note: post_ID will not work!
                    'status' => 'approve' ) );
        } elseif( !empty ( $GLOBALS[ 'wp_query' ]->comments ) ) {
            $comments = $GLOBALS[ 'wp_query' ]->comments;
        }

        if( !$comments ) return 0;

        foreach( $comments as $c ) if( in_array( $c->comment_type , array( 'pingback' , 'trackback' ) ) ) $pings += 1;
        return $pings;
    }

    $moon_shop_pings_count = moon_shop_count_pings();

    ?>

        <?php if ($moon_shop_pings_count != 0) { ?>

        <div class="wl-section-heading">
            <h2 class="wl-color4"><?php esc_html_e( 'Pingbacks / Trackbacks' , 'moon-shop' ); ?></h2>
        </div>
    </div>
    <ul class="comments-container">
        <?php wp_list_comments( 'callback=moon_shop_list_pings&type=pings' ); ?>
    </ul>
    <?php
    the_comments_pagination( array( 'prev_text' => '<span class="screen-reader-text"><i class="fa fa-arrow-left" aria-hidden="true"></i>' . __( 'Previous' , 'moon-shop' ) . '</span>' , 'next_text' => '<span class="screen-reader-text">' . __( 'Next' , 'moon-shop' ) . '<i class="fa fa-arrow-right" aria-hidden="true"></i></span>' , ) );
    ?>

    <?php } ?>

    <h2><?php comments_number( __('0 Comment', 'moon-shop') , __('1 Comment', 'moon-shop') , __('% Comments', 'moon-shop') ); ?></h2>
    <ul class="comments-container">
        <?php
        wp_list_comments( array( 'style' => 'ul' , 'short_ping' => false , 'avatar_size' => 42 , 'callback' => 'moon_shop_theme_comments' , 'type' => 'comment' ) );
        ?>
    </ul>

    <?php else :
        if( !comments_open() ) :
        endif;
    endif;
    ?>

    <?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav class="comments-navigation">
            <div class="comments-previous"><?php previous_comments_link(); ?></div>
            <div class="comments-next"><?php next_comments_link(); ?></div>
        </nav>
    <?php endif;
    $fields = array( 'author' => '<div class="input-box input-box-2 margin-right-2"><input type="text" name="author" id="author" tabindex="54" placeholder="' . esc_html__( 'Name' , 'moon-shop' ) . '"  /></div>' , 'email' => '<div class="input-box input-box-2 margin-right-2"><input type="text" name="email" id="email" tabindex="55" placeholder="' . esc_html__( 'Email' , 'moon-shop' ) . '" /></div>' , 'url' => '<div class="input-box input-box-2"><input type="text" name="url" id="url" tabindex="56" placeholder="' . esc_html__( 'Website' , 'moon-shop' ) . '"></div>' );
    //Comment Form Args
    $comments_args = array( 'fields' => $fields , 'title_reply' => esc_html__( 'Leave your comment' , 'moon-shop' ) , 'comment_field' => '<div class="input-box"><textarea placeholder="' . esc_html__( 'Message' , 'moon-shop' ) . '" id="rev-message" name="comment" rows="5" tabindex="58"></textarea></div>' , 'comment_notes_before' => '' , 'comment_notes_after' => '' , 'label_submit' => '' );
    ob_start();
    comment_form( $comments_args );
    echo str_replace( 'class="comment-form"' , 'class="moon-form"' , ob_get_clean() );
    ?>
    </div>
<?php get_header(); ?>

    <!-- 404 -->
    <div class="error-page pages">
        <div class="container">
            <div class="row">
                <div class="error-404 col-sm-12 text-center">
                    <img src="<?php echo MOON_SHOP_THEME_ASSETS_IMAGE . '/404.png'; ?>" alt="404"/>

                    <h2><?php esc_html__( 'PAGE NOT FOUND' , 'moon-shop' ); ?>
                        <br/><?php esc_html_e( 'It looks like you\'re lost...' , 'moon-shop' ); ?></h2>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Take me out of here' , 'moon-shop' ); ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Area -->
<?php get_footer();
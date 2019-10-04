<!-- Search Banner -->
<div class="search-banner relative text-center">
    <div class="display-table absolute overlay">
        <div class="vertical-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>
                            <?php printf( esc_html__( 'Search Results for: %s' , 'moon-shop' ) , '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
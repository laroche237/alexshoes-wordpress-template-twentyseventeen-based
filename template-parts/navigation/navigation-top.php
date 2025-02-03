<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>
<!--div class="menutop"-->
<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">

<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) );
		echo twentyseventeen_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'twentyseventeen' );
		?>
	</button>

	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'top',
			'menu_id'        => 'top-menu',
		)
	);
	?>


<?php if ( get_theme_mod( 'show_menu_icons', true ) ) : ?>
    <div class="menu-icons">
        <a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>" class="menu-icon search-icon">
            <span class="screen-reader-text"><?php esc_html_e( 'Search', 'twentyseventeen' ); ?></span>
            <i class="fas fa-search"></i>
        </a>
        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="menu-icon account-icon">
            <span class="screen-reader-text"><?php esc_html_e( 'Account', 'twentyseventeen' ); ?></span>
            <i class="fas fa-user"></i>
        </a>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="menu-icon cart-icon">
            <span class="screen-reader-text"><?php esc_html_e( 'Cart', 'twentyseventeen' ); ?></span>
            <i class="fas fa-shopping-bag"></i>
        </a>
    </div>
    
<?php endif; ?>

</nav><!-- #site-navigation -->
<!--/div-->
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer">
			<!--div class="wrap"-->
			<?php
/*
	get_template_part( 'template-parts/footer/footer', 'widgets' );

	if ( has_nav_menu( 'social' ) ) :
		?>
		<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
					)
				);
			?>
		</nav><!-- .social-navigation -->
		<?php
	endif;

	get_template_part( 'template-parts/footer/site', 'info' );
*/
?>

<footer class="custom-footer">
    <div class="container">
        <div class="footer-section">
            <h2><?php echo get_theme_mod('footer_logo_text', 'ALEX SHOES'); ?></h2>
            <p>2024 © <?php echo get_theme_mod('footer_copyright_text', 'ALEX SHOES'); ?></p>
            <p>All Rights Reserved.</p>
            <div class="footer-flags">
                <span>CM</span>
                <span>FR</span>
            </div>
        </div>

        <div class="footer-section">
            <h3>FOLLOW US</h3>
            <a href="<?php echo get_theme_mod('footer_instagram', '#'); ?>">Instagram</a>
            <a href="<?php echo get_theme_mod('footer_tiktok', '#'); ?>">Tiktok</a>
        </div>

        <div class="footer-section">
            <h3>USEFUL LINKS</h3>
			<?php
    $links = array(
        'Privacy Policy' => get_theme_mod('useful_link_0', '#'),
        'Terms and Condition' => get_theme_mod('useful_link_1', '#'),
        'General Condition' => get_theme_mod('useful_link_2', '#'),
        'Cookie Policy' => get_theme_mod('useful_link_3', '#'),
        'Download Modules' => get_theme_mod('useful_link_4', '#'),
    );

    foreach ($links as $name => $url) {
        echo '<a href="' . esc_url($url) . '">' . esc_html($name) . '</a>';
    }
    ?>
        </div>

        <div class="footer-section">
            <h3>SUBSCRIBE</h3>
            <form action="#" method="POST">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="surname" placeholder="Surname">
                <input type="email" name="email" placeholder="Email">
                <label><input type="checkbox"> J'accepte l'informativa sulla privacy</label>
                <button type="submit">SEND</button>
            </form>
        </div>
    </div>
</footer>



			<!--/div--><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>

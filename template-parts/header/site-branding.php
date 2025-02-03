<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>
<div class="site-branding">
	<div class="wrapped">
<div class="logotop">
		
		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

	</div>
 </div> 

	
	<?php if ( has_nav_menu( 'top' ) ) : ?>
		<div class="menutop">
		<!--div class="navigation-top"-->
	<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
 <!--/div--><!-- .navigation-top -->
 </div>

	<?php endif; ?>



	</div><!-- .wrapped -->
</div><!-- .site-branding -->

<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?>

<section class="features">
    <div class="boxes">
<?php
for ($i = 1; $i <= 5; $i++) {
    $image_url = esc_url(get_theme_mod("custom_image_$i", ''));
    echo " <div class='box'>
    <img src='$image_url' alt='Image $i'> </div>";
}
?>
</div>

<div class="button_shop">

<!-- Bouton Shop Now en dehors des div -->
    <?php
    $shop_button_text = get_theme_mod("shop_button_text", "Shop Now");
    $shop_button_link = esc_url(get_theme_mod("shop_button_link", "#"));
    $shop_button_color =get_theme_mod("shop_button_color", "#7e1212"); // Couleur par défaut

    echo "<a href='$shop_button_link' class='shop-btn' style='background-color: $shop_button_color;'>$shop_button_text</a>";
    ?>
    </div>

</section>

<section class='about'>
  
    <div class="about-image-box">
<?php
   
    $about_image = esc_url(get_theme_mod("about_image", "")); 
    echo " <div class='about_image_section'>
    <img src='$about_image' alt='Image section about'> </div>";
    ?>
</div>



<div class="about-box">
  <div class="about-box-texte"> 
<?php
   
   $about_box_text = get_theme_mod("about_box_text", "Shop Now");
    echo " <p class='about_text_section'>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet bibendum ipsum. Fusce auctor erat euismod velit consectetur, vel tempus leo vulputate. Vivamus tincidunt vitae ligula eu volutpat. Sed malesuada ante sit amet nulla tempor, et dignissim magna lobortis. Nunc in lectus ut sapien feugiat tincidunt. Integer vel sem eu risus pharetra facilisis. Curabitur convallis libero et libero cursus, at tristique purus convallis.
     </p>";
    ?>
    </div>

 <div class="about-btn-section">
    <?php
    $about_button_text =  get_theme_mod("about_button_text", "Discover More");
    $about_button_link = esc_url(get_theme_mod("about_button_link", "#"));
    $about_button_color = get_theme_mod("about_button_color", "#7e1212"); // Couleur par défaut

    echo "<a href='$about_button_link' class='about-btn' style='background-color: $about_button_color;'>$about_button_text</a>";
    ?></div>
</div>
    </div>
</section>

<section class="discovers">
<div class="disc1">
<?php
   
   $disc_1_image = esc_url(get_theme_mod("disc_1_image", "")); 
   echo " 
   <img src='$disc_1_image' alt='Image discovers'>";
   ?>

<div class="disc1-btn-section">
    <?php
    $disc1_button_text = get_theme_mod("disc1_button_text", "Discover More");
    $disc1_button_link = esc_url(get_theme_mod("disc1_button_link", "#"));
    $disc1_button_color = get_theme_mod("disc1_button_color", "#7e1212"); // Couleur par défaut

    echo "<a href='$disc1_button_link' class='disc1-btn' style='background-color: $disc1_button_color;'>$disc1_button_text</a>";
    ?></div>

</div>
<div class="disc2">
<?php
   
   $disc_2_image = esc_url(get_theme_mod("disc_2_image", "")); 
   echo " 
   <img src='$disc_2_image' alt='Image discovers'>";
   ?>
   <div class="disc2-btn-section">
    <?php
    $disc2_button_text = get_theme_mod("disc2_button_text", "ALL SHOES");
    $disc2_button_link = esc_url(get_theme_mod("disc2_button_link", "#"));
    $disc2_button_color = get_theme_mod("disc2_button_color", "#7e1212"); // Couleur par défaut
    echo "<a href='$disc2_button_link' class='disc2-btn' style='background-color: $disc2_button_color;'>$disc2_button_text</a>";
    ?></div>
 
</div>
</section>



<section class="best_products">
<h3>Best Products</h3>
<div class="best_products_boxes">
<?php
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 6,  // Nombre de produits affichés
    'meta_key'       => 'total_sales',
    'orderby'        => 'meta_value_num',
    'order'          => 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<ul class="best-selling-products">';
    while ($query->have_posts()) : $query->the_post();
        wc_get_template_part('content', 'product'); // Utilise le template WooCommerce par défaut
    endwhile;
    echo '</ul>';
    wp_reset_postdata();
else :
    echo '<p>Aucun produit trouvé.</p>';
endif;
?>

</div>
</section>

<section class="press">
<?php
   
   $press_image = esc_url(get_theme_mod("press_image", "")); 
   echo " 
   <img src='$press_image' alt='Image discovers'>";
   ?>
</section>
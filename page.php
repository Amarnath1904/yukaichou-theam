<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage yukaichou_Theme
 * @since yukaichou Theme 1.0
 */

get_header();
?>


<div class="page-container">

    <div class="page-content">
        <?php
            while ( have_posts() ) :  
                the_post();
                the_content();
            endwhile;
        ?>
    </div>
</div>

<?php
get_footer();
?>

<?php
/**
 * Template Name: Framework Pages
 * Description: A custom template for framework-specific pages.
 *
 * @package WordPress
 * @subpackage yukaichou_Theme
 * @since yukaichou Theme 1.0
 */

get_header();
?>

<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

<!-- Link to template-framework.css -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/template-framework.css">

<main class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article class="single-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div id="title-banner">
            <div id="title">
                <h1><?php the_title(); ?></h1>
                <div id="author">
                    <?php
                    $author_id = get_the_author_meta('ID');
                    ?>
                    <div class="author-avatar">
                        <?php echo get_avatar($author_id, 96); ?>
                    </div>
                    <div class="author-name">
                        <?php the_author(); ?>
                    </div>
                    <div id="author_bio">
                        Yu-kai Chou, world-renowned designer and keynote speaker, created the Octalysis Framework, impacting 1.5B+ lives through gamification and behavioral design.
                    </div>
                </div>
            </div>
            <div id="featured_image">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full');
                }
                ?>
            </div>
        </div>

        <div id="blog-container">
            <div class="wp-block-group blog-post">
                <div class="wp-block-group blog-content">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </div>
    </article>
    <?php endwhile; endif; ?>
</main>

<div id="image-modal" class="image-modal">
    <span id="close-modal" class="close-modal">&times;</span>
    <img class="modal-content" id="modal-image">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('image-modal');
        const modalImg = document.getElementById('modal-image');
        const closeModal = document.getElementById('close-modal');

        // Select images in #featured_image and .blog-content
        document.querySelectorAll('#featured_image img, .blog-content img').forEach(img => {
            img.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default behavior
                modal.style.display = 'block';
                modalImg.src = this.src;
            });
        });

        closeModal.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>

<?php
// Load footer
get_footer();
?>
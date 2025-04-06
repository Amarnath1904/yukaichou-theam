<?php

function setup_theme_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

function enqueue_theme_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'enqueue_theme_styles');
add_action('after_setup_theme', 'setup_theme_features');

function yukaichou_add_editor_styles() {
    // For the classic editor
    add_editor_style('editor-style.css');
}

function yukaichou_enqueue_block_editor_styles() {
    // For the block editor (Gutenberg)
    wp_enqueue_style('block-editor-styles', get_template_directory_uri() . '/editor-style.css', array(), '1.0', 'all');
}

add_action('admin_init', 'yukaichou_add_editor_styles');
add_action('enqueue_block_editor_assets', 'yukaichou_enqueue_block_editor_styles');

function load_more_posts() {
    $paged = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 12,
        'paged' => $paged,
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="blog-item">
                <a href="<?php the_permalink(); ?>">
                    <div class="blog-image">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } ?>
                    </div>
                    <div class="blog-title">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </a>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    endif;

    wp_die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

add_action('wp_ajax_search_posts', 'search_posts');
add_action('wp_ajax_nopriv_search_posts', 'search_posts');

function search_posts() {
    $search_query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        's' => $search_query,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="blog-item">
                <a href="<?php the_permalink(); ?>">
                    <div class="blog-image">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } ?>
                    </div>
                    <div class="blog-title">
                        <h3><?php the_title(); ?></h3>
                    </div>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<p>No results found.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
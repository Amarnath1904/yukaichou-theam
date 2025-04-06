<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<?php if (is_user_logged_in()) : ?>
    <?php wp_body_open(); ?>
<?php endif; ?>

<nav class="site-header">
    <div class="container">
        <!-- Site Logo (WordPress Block) -->
        <div class="site-logo">
            <?php 
            if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Site Logo" width="64">
                </a>
            <?php } ?>
        </div>

        <!-- Hamburger Menu Icon -->
        <div class="hamburger-menu" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-menu">
            <?php
            wp_nav_menu(array(
                'menu' => 'Menu by Amarnath 03-11-2024',
                'container' => false,
                'menu_class' => 'menu',
            ));
            ?>
            <!-- Contact Button (moved inside hamburger menu) -->
            <div class="contact-btn mobile_btn">
                <a href="/contact-gamification-expert/" class="btn">Contact Chou</a>
            </div>
        </nav>
            <div class="contact-btn desktop_btn">
                <a href="/contact-gamification-expert/" class="btn">Contact Chou</a>
            </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.querySelector('.main-menu');

        menu.classList.toggle('active');

    }
</script>

<body>



<?php
/**
 * The template for displaying Frameworks page
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
<style>

    a{
        color: rgb(96, 224, 255);
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    a:hover {
        color: rgb(255, 255, 255);
        text-decoration: underline;
    }

    .page-content {
        width: 60%;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
        font-style: normal;
        font-weight: 400;
        color: rgb(255, 255, 255);
        font-size: 18px;
        line-height: 30px;
    }
    .page-container {
        margin-top: 50px;
        display: flex;
        justify-content: center;
        align-items: center;

        p{
            margin-top: 25px;

            a{
                color: rgb(96, 224, 255);
            }
        }
    }
    li {
        font-family: 'Roboto', sans-serif;
        font-style: normal;
        font-weight: 500;
        color: rgb(96, 224, 255);
        font-size: 18px;
        line-height: 30px;
    }
    h1 {
        margin: 25px 0px;
        font-family: 'Roboto', sans-serif;
        color: rgb(255, 255, 255);
        

        a{
            color: rgb(255, 255, 255);
            font-size: 30px;
            line-height: 50px;
            font-style: normal;
            font-weight: 600;
            text-decoration: none;
        }

        a:hover{
            text-decoration: underline;
        }
        
    }
</style>

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

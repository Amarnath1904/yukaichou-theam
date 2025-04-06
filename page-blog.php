<?php
/* Template Name: Blog Page */
get_header();
?>

<style>

    /* Blog Page Styles */
.blog-page {
    padding: 20px;
    color: #fff;

    display: flex;
    flex-direction: column;
    align-items: center;
    
    
}

.search-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 10vh;
    margin-top: 10vh;
    width: 100%;
}

.search-bar input {
    width: 60%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
}

.search-bar button {
    padding: 10px 20px;
    background-color: #4a4aff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    width: 80%;
}

.blog-item {
    border-radius: 10px;
    overflow: hidden;
    text-align: center;
}

.blog-item a {
    text-decoration: none;
}

.blog-image {
    width: 262.5px;
    height: 147px;
    overflow: hidden;
    margin: 0 auto;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.blog-title {
    padding: 10px;
    max-width: 262.5px; /* Match the image width */
    margin: 0 auto; /* Center align the title */
}

.blog-title h3 {
    font-size: 18px;
    color: #fff;
}

/* Remove styles related to categories */
.categories-bar,
.browse-categories {
    display: none;
}
</style>

<div class="blog-page">
    
    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" placeholder="Search Yu-kai's brain...." />
        <button>Search</button>
    </div>
    
    <!-- Blog Posts Grid -->
    <div class="blog-grid" id="blog-grid">
        <?php
        $query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 14));
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
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
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </div>

    <!-- Loader -->
    <div id="loader" style="text-align: center; display: none;">
        <p>Loading more posts...</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let page = 2; // Start from the second page
    let loading = false;

    // Infinite Scroll
    window.addEventListener('scroll', function () {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && !loading) {
            loading = true;
            document.getElementById('loader').style.display = 'block';

            fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=load_more_posts&page=${page}`)
                .then(response => response.text())
                .then(data => {
                    if (data.trim() !== '') {
                        document.getElementById('blog-grid').insertAdjacentHTML('beforeend', data);
                        page++;
                        loading = false;
                        document.getElementById('loader').style.display = 'none';
                    } else {
                        document.getElementById('loader').innerHTML = '<p>No more posts to load.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});
</script>

<?php get_footer(); ?>

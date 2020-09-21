<?php get_header(); ?>
<div class="container">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_title();
            the_post_thumbnail();
            the_content();
        }
    }
    ?>
</div>
<?php get_footer(); ?>
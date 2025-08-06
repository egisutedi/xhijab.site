<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <h2><?php the_title(); ?></h2>
        <div class="video-content">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>

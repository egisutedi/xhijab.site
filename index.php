<?php get_header(); ?>

<div class="post-grid">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            } else {
                echo '<img src="https://via.placeholder.com/300x200?text=No+Image">';
            } ?>
        </a>
        <div class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>
    </div>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

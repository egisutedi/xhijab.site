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

        <!-- Views & Likes -->
<div style="font-size:13px; color:#666; margin-top:5px;">
    👁 <?php echo function_exists('xhijab_get_post_views') ? xhijab_get_post_views(get_the_ID()) : 0; ?> views
    &nbsp; | &nbsp;
    ❤️ <?php echo function_exists('xhijab_get_likes') ? xhijab_get_likes(get_the_ID()) : 0; ?> likes
</div>

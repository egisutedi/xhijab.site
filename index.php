<?php get_header(); ?>

<div class="post-grid">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <a href="<?php the_permalink(); ?>">
            <?php 
            if (has_post_thumbnail()) {
                // Kalau ada featured image, tampilkan
                the_post_thumbnail('medium');
            } else {
                // Ambil isi posting
                $content = get_the_content();

                // 1. Kalau ada langsung link gambar doodcdn
                if (preg_match('/https?:\/\/(?:img\.)?doodcdn\.co\/splash\/([a-zA-Z0-9]+)\.jpg/', $content, $match)) {
                    echo '<img src="'.$match[0].'" alt="Video Thumbnail">';
                
                // 2. Kalau cuma ada link video doodstream, buat thumbnail URL-nya
                } elseif (preg_match('/https?:\/\/(?:dood\.(?:to|so|watch|wf|pm|re)|doodstream\.com)\/(?:e|d)\/([a-zA-Z0-9]+)/', $content, $matches)) {
                    echo '<img src="https://img.doodcdn.co/splash/'.$matches[1].'.jpg" alt="Video Thumbnail">';
                
                // 3. Kalau tidak ada, tampilkan placeholder
                } else {
                    echo '<img src="https://via.placeholder.com/300x200?text=No+Image">';
                }
            }
            ?>
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
    </div>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

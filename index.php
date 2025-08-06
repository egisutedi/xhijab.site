<?php get_header(); ?>

<div class="post-grid">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <!-- Thumbnail -->
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            } else {
                echo '<img src="https://via.placeholder.com/300x200?text=No+Image">';
            } ?>
        </a>

        <!-- Judul -->
        <div class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div>

        <!-- Video player kecil -->
        <div class="video-preview" style="margin-top:10px;">
            <?php
            // Ambil konten post (hanya embed video pertama)
            $content = apply_filters('the_content', get_the_content());
            preg_match('/<iframe.*?src=["\'](.*?)["\'].*?>/i', $content, $matches);
            if (!empty($matches[0])) {
                // tampilkan iframe dengan ukuran kecil
                echo preg_replace('/width="\d+" height="\d+"/', 'width="100%" height="180"', $matches[0]);
            } else {
                echo "<p style='font-size:14px;color:#666;'>Video tidak ditemukan</p>";
            }
            ?>
        </div>
    </div>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>

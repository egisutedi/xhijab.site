<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
        <h2><?php the_title(); ?></h2>

        <div style="margin:10px 0; font-size:14px; color:#666;">
            👁 <?php echo xhijab_get_post_views(get_the_ID()); ?> views
            &nbsp; | &nbsp;
            ❤️ <span id="like-count"><?php echo xhijab_get_likes(get_the_ID()); ?></span> likes
            &nbsp; <button id="like-btn" style="padding:5px 10px;cursor:pointer;">Like</button>
        </div>

        <div class="video-content">
            <?php
            $content = apply_filters('the_content', get_the_content());
            $content = preg_replace(
                '/<iframe.*?<\/iframe>/is',
                '<div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;">$0</div>',
                $content
            );
            echo $content;
            ?>
        </div>
    </div>

    <script>
    document.getElementById("like-btn").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", xhijab_ajax.url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            document.getElementById("like-count").innerText = this.responseText;
        };
        xhr.send("action=xhijab_like&post_id=<?php echo get_the_ID(); ?>");
    });
    </script>

<?php endwhile; endif; ?>

<?php get_footer(); ?>

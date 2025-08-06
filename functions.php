<?php
function xhijab_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'xhijab_theme_setup');

function xhijab_scripts() {
    wp_enqueue_style('xhijab-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'xhijab_scripts');

/* ===== VIEW COUNTER ===== */
if (!function_exists('xhijab_get_post_views')) {
    function xhijab_set_post_views($postID) {
        $count_key = 'xhijab_post_views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 0;
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    function xhijab_get_post_views($postID) {
        $count_key = 'xhijab_post_views';
        $count = get_post_meta($postID, $count_key, true);
        return $count ? $count : 0;
    }
    add_action('wp_head', function() {
        if (is_single()) {
            global $post;
            if ($post) xhijab_set_post_views($post->ID);
        }
    });
}

/* ===== LIKE SYSTEM ===== */
if (!function_exists('xhijab_get_likes')) {
    function xhijab_add_like($post_id) {
        $like_key = 'xhijab_post_likes';
        $likes = get_post_meta($post_id, $like_key, true);
        $likes = $likes ? $likes + 1 : 1;
        update_post_meta($post_id, $like_key, $likes);
    }
    function xhijab_get_likes($post_id) {
        $like_key = 'xhijab_post_likes';
        $likes = get_post_meta($post_id, $like_key, true);
        return $likes ? $likes : 0;
    }
    add_action('wp_ajax_xhijab_like', function() {
        if (isset($_POST['post_id'])) {
            $post_id = intval($_POST['post_id']);
            xhijab_add_like($post_id);
            echo xhijab_get_likes($post_id);
        }
        wp_die();
    });
    add_action('wp_ajax_nopriv_xhijab_like', function() {
        if (isset($_POST['post_id'])) {
            $post_id = intval($_POST['post_id']);
            xhijab_add_like($post_id);
            echo xhijab_get_likes($post_id);
        }
        wp_die();
    });
    add_action('wp_enqueue_scripts', function() {
        wp_localize_script('xhijab-style', 'xhijab_ajax', array(
            'url' => admin_url('admin-ajax.php')
        ));
    });
}
/* ===== AUTO THUMBNAIL DOODSTREAM ===== */
function xhijab_auto_thumbnail_doodstream($post_id) {
    // Jangan jalan kalau autosave/revisi
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) return;

    // Kalau sudah punya thumbnail, skip
    if (has_post_thumbnail($post_id)) return;

    $post = get_post($post_id);
    $content = $post->post_content;

    // Cari link doodstream
    if (preg_match('/https?:\/\/(?:dood\.(?:to|so|watch|wf|pm|re)|doodstream\.com)\/(?:e|d)\/([a-zA-Z0-9]+)/', $content, $matches)) {
        $video_id = $matches[1];
        $thumb_url = "https://img.doodcdn.co/splash/{$video_id}.jpg";

        // Download gambar dan set featured image
        $image_id = media_sideload_image($thumb_url, $post_id, null, 'id');
        if (!is_wp_error($image_id)) {
            set_post_thumbnail($post_id, $image_id);
        }
    }
}
add_action('save_post', 'xhijab_auto_thumbnail_doodstream');

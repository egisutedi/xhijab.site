<?php
// ===== THEME SETUP =====
function xhijab_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'xhijab_theme_setup');

function xhijab_scripts() {
    wp_enqueue_style('xhijab-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'xhijab_scripts');

// ===== VIEW COUNTER =====
if (!function_exists('xhijab_get_post_views')) {
    function xhijab_set_post_views($postID) {
        $count_key = 'xhijab_post_views';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            add_post_meta($postID, $count_key, 0);
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    function xhijab_get_post_views($postID) {
        $count = get_post_meta($postID, 'xhijab_post_views', true);
        return $count ? $count : 0;
    }
    add_action('wp_head', function() {
        if (is_single()) {
            global $post;
            if ($post) xhijab_set_post_views($post->ID);
        }
    });
}

// ===== LIKE SYSTEM =====
if (!function_exists('xhijab_get_likes')) {
    function xhijab_add_like($post_id) {
        $like_key = 'xhijab_post_likes';
        $likes = get_post_meta($post_id, $like_key, true);
        $likes = $likes ? $likes + 1 : 1;
        update_post_meta($post_id, $like_key, $likes);
    }
    function xhijab_get_likes($post_id) {
        return get_post_meta($post_id, 'xhijab_post_likes', true) ?: 0;
    }
    add_action('wp_ajax_xhijab_like', function() {
        if (isset($_POST_

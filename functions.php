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

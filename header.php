<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container" style="text-align:center;">
        <a href="<?php echo home_url(); ?>" style="color:white; text-decoration:none; font-size:24px; font-weight:bold;">
            <?php bloginfo('name'); ?>
        </a>
        
        <!-- Search Bar -->
<div class="xhijab-search-bar" style="text-align:center; margin:20px auto;">
    <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" style="max-width:500px; margin:auto; position:relative;">
        <input type="text" placeholder="🔍 Cari video..." value="<?php echo get_search_query(); ?>" name="s" 
               style="width:100%; padding:12px 45px 12px 15px; border:2px solid #ff0055; border-radius:30px; font-size:16px; outline:none;">
        <button type="submit" 
                style="position:absolute; right:5px; top:5px; bottom:5px; background:#ff0055; border:none; padding:0 20px; border-radius:25px; color:#fff; font-weight:bold; cursor:pointer;">
            Cari
        </button>
    </form>
</div>


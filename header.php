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
        
        <!-- Form Pencarian -->
        <div style="margin-top:10px;">
            <?php get_search_form(); ?>
        </div>
    </div>
</header>
<div class="container">

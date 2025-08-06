<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container">
        <a href="<?php echo home_url(); ?>" style="color:white; text-decoration:none;">
            <?php bloginfo('name'); ?>
        </a>
    </div>
</header>
<div class="container">

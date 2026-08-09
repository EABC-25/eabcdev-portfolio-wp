<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="layout">
    <header>
        <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'fallback_cb' => false,
                // 'container'=>false,
                'walker' => new EABCDEV_Portfolio_Primary_Menu_Walker()
            ]);
        ?>
    </header>


<main class="site-main">

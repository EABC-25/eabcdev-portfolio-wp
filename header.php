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
        <h1>
            <a href="<?php echo esc_url(home_url('/'));?>">
                <?php echo apply_filters('eabcdev_portfolio_site_title', get_bloginfo('name')); ?>
            </a>
        </h1>

        <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'fallback_cb' => false,
            ]);
        ?>
    </header>


<main class="site-main center-y">

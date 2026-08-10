<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/lib/icons/icon.php';
require_once get_template_directory() . '/lib/menu/primary_menu_walker.php';
require_once get_template_directory() . '/lib/project/project.php';

/**
 * THEME SETUP
 */
function eabcdev_portfolio_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');
    add_theme_support('html5', [
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');

    add_editor_style('assets/css/editor.css');

    register_nav_menus([
        'primary' => __('Primary Menu', 'eabcdev-portfolio'),
    ]);
}

add_action('after_setup_theme', 'eabcdev_portfolio_setup');

/**
 * Enqueue Theme Assets
 */
function eabcdev_portfolio_enqueue_assets(): void
{
    $version = wp_get_theme()->get('Version');
    // style.css?ver=1.0 if its Version: 1.0 in style.css

    wp_enqueue_style(
        'eabcdev-portfolio-style',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $version
    );

    wp_enqueue_script(
        'eabcdev-portfolio-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $version,
        // true
        [
            'strategy' => 'defer',
            'in_footer' => true,
        ]
    );
}

add_action('wp_enqueue_scripts', 'eabcdev_portfolio_enqueue_assets');
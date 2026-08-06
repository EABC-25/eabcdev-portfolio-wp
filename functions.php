<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/lib/icons.php';

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
 * REGISTER POST TYPES
 */
function eabcdev_portfolio_register_post_types() {
    register_post_type('project', [
        'labels'=>[
            'name'=>__('Projects', 'eabcdev-portfolio'),
            'singular_name'=>__('Project', 'eabcdev-portfolio')
        ],
        'public'=>true,
        'has_archive'=>true,
        'rewrite'=>[
            'slug'=>'projects',
        ],
        'menu_icon'=>'dashicons-portfolio',
        'supports'=>[
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ]
    ]);
}

add_action('init', 'eabcdev_portfolio_register_post_types');

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

/**
 * Custom Hooks
 */
function eabcdev_portfolio_primary_menu_icons(
    $item_output,
    $item,
    $depth,
    $args
) {
    if ($args->theme_location !== 'primary') {
        return $item_output;
    }

    $icon = sanitize_key($item->post_name);

    $svg = eabcdev_portfolio_icon($icon);

    return str_replace(
        $item->title,
        $svg,
        $item_output
    );
}

add_filter(
    'walker_nav_menu_start_el',
    'eabcdev_portfolio_primary_menu_icons',
    10,
    4
);
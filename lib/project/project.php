<?php 

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Register post type: project
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
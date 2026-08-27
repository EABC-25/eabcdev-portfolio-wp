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

/**
 * Register custom taxonomies
 */
function eabcdev_register_taxonomies() {
    // hierarchical true for all because I want them to appear as checkbox list in wp-admin UI
    register_taxonomy(
        'project_type', // machine name
        ['project'], // attach to custom post types in array('project')
        [
            'labels'=> [
                'name'=>__('Project Types', 'eabcdev-portfolio'),
                'singular_name'=>__('Project Type', 'eabcdev-portfolio'),
                'menu name'=>__('Project Types', 'eabcdev-portfolio')
            ],
            'public'=> true,
            'show_ui'=> true,
            'show_admin_column'=> true,
            'sjow_in_rest'=> true,
            'hierarchical'=> true, // true = behaves like categories (parent/child relationships); false = behaves like tags (flat list)
            'rewrite'=> [
                'slug'=>'project-type'
            ],
        ]
    );

    register_taxonomy(
        'project_language', // machine name
        ['project'], // attach to custom post types in array('project')
        [
            'labels'=> [
                'name'=>__('Project Languages', 'eabcdev-portfolio'),
                'singular_name'=>__('Project Language', 'eabcdev-portfolio'),
                'menu name'=>__('Project Languages', 'eabcdev-portfolio')
            ],
            'public'=> true,
            'show_ui'=> true,
            'show_admin_column'=> true,
            'sjow_in_rest'=> true,
            'hierarchical'=> true, // true = behaves like categories (parent/child relationships); false = behaves like tags (flat list)
            'rewrite'=> [
                'slug'=>'project-language'
            ],
        ]
    );

    register_taxonomy(
        'project_technology', // machine name
        ['project'], // attach to custom post types in array('project')
        [
            'labels'=> [
                'name'=>__('Project Technologies', 'eabcdev-portfolio'),
                'singular_name'=>__('Project Technology', 'eabcdev-portfolio'),
                'menu name'=>__('Project Technologies', 'eabcdev-portfolio')
            ],
            'public'=> true,
            'show_ui'=> true,
            'show_admin_column'=> true,
            'sjow_in_rest'=> true,
            'hierarchical'=> true, // true = behaves like categories (parent/child relationships); false = behaves like tags (flat list)
            'rewrite'=> [
                'slug'=>'project-technology'
            ],
        ]
    );

    register_taxonomy(
        'project_status', // machine name
        ['project'], // attach to custom post types in array('project')
        [
            'labels'=> [
                'name'=>__('Project Status', 'eabcdev-portfolio'),
                'singular_name'=>__('Project Status', 'eabcdev-portfolio'),
                'menu name'=>__('Project Status', 'eabcdev-portfolio')
            ],
            'public'=> true,
            'show_ui'=> true,
            'show_admin_column'=> true,
            'sjow_in_rest'=> true,
            'hierarchical'=> true, // true = behaves like categories (parent/child relationships); false = behaves like tags (flat list)
            'rewrite'=> [
                'slug'=>'project-status'
            ],
        ]
    );
}

add_action('init', 'eabcdev_register_taxonomies');

/**
 * project taxonomies getter function
 */

function eabcdev_portfolio_get_project_taxonomies($project_id) {
    return [
        'type' => get_the_terms($project_id, 'project_type'),
        'languages' => get_the_terms($project_id, 'project_language'),
        'technologies' => get_the_terms($project_id, 'project_technology'),
        'status' => get_the_terms($project_id, 'project_status'),
    ];
}


/**
 * project_image getter function
 */
function eabcdev_portfolio_get_project_images($project_id) {
    if(get_post_type($project_id) !== 'project') {
        return null;
    }
    $images_json = get_post_meta(
        $project_id,
        'project_images',
        true
    );

    if(!$images_json) {
        return null;
    }

    $images = json_decode(
        $images_json,
        true
    );

    if(!is_array($images) || !$images) {
        return null;
    }

    return $images;
}
function eabcdev_portfolio_get_project_image($project_id, $image_slug) {
    if (get_post_type($project_id) !== 'project') {
        return null;
    }
    $images_json = get_post_meta(
        $project_id,
        'project_images',
        true
    );

    if(!$images_json) {
        return null;
    }

    $images = json_decode(
        $images_json,
        true
    );

    if(!is_array($images)) {
        return null;
    }

    $image_slug = sanitize_title($image_slug);

    foreach ($images as $image) {
        if (
            isset($image['slug']) &&
            $image['slug'] === $image_slug
        ) {
            return $image;
        }
    }

    return null;
}

function eabcdev_portfolio_get_project_image_url($project_id, $image_slug) {
    $project = get_post($project_id);

    if(!$project || $project->post_type !== 'project') {
        return '';
    }

    $image = eabcdev_portfolio_get_project_image($project_id, $image_slug);

    if (!$image) {
        return '';
    }

    $url = trailingslashit(get_permalink($project_id)) . "images/";

    return add_query_arg('image', $image['slug'], $url);
}

function eabcdev_portfolio_get_project_url($project_id) {
    $project = get_post($project_id);

    if(!$project || $project->post_type !== 'project') {
        return '';
    }

    $url = trailingslashit(get_permalink($project_id));

    // use site's configured permalink structure rather than hardcoding '/' at the end
    return user_trailingslashit($url);
}
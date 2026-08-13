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

    $url = trailingslashit(get_permalink($project_id)) . $image['slug'];

    // use site's configured permalink structure rather than hardcoding '/' at the end
    return user_trailingslashit($url);
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
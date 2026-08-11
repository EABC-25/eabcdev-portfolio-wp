<?php 

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Register project meta: project_images
 */
function eabcdev_portfolio_register_project_meta() {
  register_post_meta('project', 'project_images', [
    'type'=>'string',
    'single'=>true,
    'sanitize_callback'=>'eabcdev_portfolio_sanitize_project_images',
    'show_in_rest'=>true,
  ]); 
}

add_action('init', 'eabcdev_portfolio_register_project_meta');

/**
 * Add project_images metabox to wp-admin->project
 */
function eabcdev_portfolio_add_project_images_metabox() {
    add_meta_box(
        'eabcdev_project_images',
        'Project Images',
        'eabcdev_portfolio_render_project_images_metabox',
        'project',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'eabcdev_portfolio_add_project_images_metabox');

/**
 * project_images post meta's sanitize callback function
 */
function eabcdev_portfolio_sanitize_project_images($value) {
    if (!is_string($value)) {
        return '';
    }

    $decoded = json_decode($value, true);

    if (!is_array($decoded)) {
        return '';
    }

    return wp_json_encode($decoded);
}

/**
 * Render meta box hook for project_images
 * -> preps $project_images object to be consumed by wordpress
 */
function eabcdev_portfolio_render_project_images_metabox($post) {
    wp_nonce_field(
        'eabcdev_portfolio_project_images',
        'eabcdev_portfolio_project_images_nonce'
    );

    $project_images = get_post_meta(
        $post->ID,
        'project_images',
        true
    );

    $project_images = $project_images ? json_decode($project_images, true) : [];

    ?>
    <div id="eabcdev-project-images">
        <div id="eabcdev-project-images-list"></div>
        <button
            type="button"
            class="button"
            id="eabcdev-add-project-image"
        >
            Add Project Image
        </button>
    </div>
    <?php
}

/**
 * project_images admin assets
 * -> preps $project_images object to be consumed by javascript handler
 */
function eabcdev_portfolio_project_images_admin_assets($hook) {
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }

    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'project') {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script(
        'eabcdev-project-images',
        get_template_directory_uri() . '/assets/js/project-images.js',
        [],
        '1.0',
        true
    );

    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;

    $project_images = get_post_meta($post_id, 'project_images', true);

    $project_images = $project_images ? json_decode($project_images, true) : [];

    $project_images = array_map(
        function ($image) {
            $image_id = absint($image['image_id'] ?? 0);

            return [
                'image_id'=> $image_id,
                'slug' => $image['slug'] ?? '',
                'caption' => $image['caption'] ?? '',
                'url' => $image_id ? wp_get_attachment_image_url($image_id, 'medium') : '',
            ];
        },
        $project_images
    );

    wp_localize_script(
        'eabcdev-project-images',
        'eabcdevProjectImages',
        [
            'images'=>$project_images,
        ]
    );
}

add_action('admin_enqueue_scripts', 'eabcdev_portfolio_project_images_admin_assets');

/**
 * project_images save hook
 * -> preps and checks project images to be saved as json in the db
 */
function eabcdev_portfolio_save_project_images($post_id) {
    if (!isset($_POST['eabcdev_portfolio_project_images_nonce'])) {
        return;
    }

    if (!wp_verify_nonce(
        $_POST['eabcdev_portfolio_project_images_nonce'], 'eabcdev_portfolio_project_images'
    )) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (get_post_type($post_id) !== 'project') {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Process the submitted images
    if (
        !isset($_POST['project_images']) ||
        !is_array($_POST['project_images'])
    ) {
        delete_post_meta($post_id, 'project_images');
        return;
    }

    $submitted_images = $_POST['project_images'];

    $images = [];
    $existing_slugs = [];

    foreach ($submitted_images as $image) {
        if (!is_array($image)) {
            continue;
        }

        $image_id = isset($image['image_id']) ? absint($image['image_id']) : 0;

        // what if admin forgot to put in slug???
        // maybe we can improve on this next time
        $slug = isset($image['slug']) ? sanitize_title($image['slug']) : '';

        $caption = isset($image['caption']) ? sanitize_text_field($image['caption']) : '';

        // I feel like we can atleast make some random text for the slug or maybe enforce slug input
        if (!$image_id || !$slug ) {
            continue;
        }

        if (!get_post($image_id) || get_post_type($image_id) !== 'attachment') {
            continue;
        }

        if (in_array($slug, $existing_slugs, true)) {
            continue;
        }

        $existing_slugs[] = $slug;

        $images[] = [
            'image_id' => $image_id,
            'slug' => $slug,
            'caption' => $caption,
        ];
    }

    update_post_meta(
        $post_id,
        'project_images',
        wp_json_encode($images)
    );
}

add_action('save_post_project', 'eabcdev_portfolio_save_project_images');
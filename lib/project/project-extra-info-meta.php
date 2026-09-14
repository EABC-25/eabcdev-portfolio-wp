<?php 

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Register project meta: project_extra_info
 */
function eabcdev_portfolio_register_project_extra_info_meta() {
  register_post_meta('project', 'project_extra_info', [
    'type'=>'string',
    'single'=>true,
    'sanitize_callback'=>'eabcdev_portfolio_sanitize_project_extra_info',
    'show_in_rest'=>true,
  ]); 
}

add_action('init', 'eabcdev_portfolio_register_project_extra_info_meta');

/**
 * Add project_extra_info metabox to wp-admin->project
 */
function eabcdev_portfolio_add_project_extra_info_metabox() {
    add_meta_box(
        'eabcdev_project_extra_info',
        'Project Extra Info',
        'eabcdev_portfolio_render_project_extra_info_metabox',
        'project',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'eabcdev_portfolio_add_project_extra_info_metabox');

/**
 * project_extra_info post meta's sanitize callback function
 */
function eabcdev_portfolio_sanitize_project_extra_info($value) {
    if (!is_string($value)) {
        return '';
    }

    $decoded = json_decode($value, true);

    if (!is_array($decoded)) {
        return '';
    }

    $clean_extra_info = [];

    foreach ($decoded as $text) {
      if (!is_string($text)) {
        continue;
      }

      $text = sanitize_text_field($text);

      if($text = '') {
        continue;
      }

      $clean_extra_info[] = $text;
    }

    return wp_json_encode($clean_extra_info);
}

/**
 * Render meta box hook for project_extra_info
 * -> preps $project_extra_info object to be consumed by wordpress
 */
function eabcdev_portfolio_render_project_extra_info_metabox($post) {
    wp_nonce_field(
        'eabcdev_portfolio_project_extra_info',
        'eabcdev_portfolio_project_extra_info_nonce'
    );

    $project_extra_info = get_post_meta(
        $post->ID,
        'project_extra_info',
        true
    );

    $project_extra_info = $project_extra_info ? json_decode($project_extra_info, true) : [];

    ?>
    <div id="eabcdev-project-extra-info">
        <div id="eabcdev-project-extra-info-list"></div>
        <div id="eabcdev-project-extra-info-input">
            <p>
                <label>
                    Enter Extra Info:
                    <input
                    type="text"
                    class="widefat"
                    name="extraInfoInput"
                    value=""
                    >
                 </label>
            </p>
            <button
            type="button"
            class="button eabcdev-save-project-extra-info"
            >Save</button>
        </div>
    </div>
    <?php
}

/**
 * project_extra_info admin assets
 * -> preps $project_extra_info object to be consumed by javascript handler
 */
function eabcdev_portfolio_project_extra_info_admin_assets($hook) {
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }

    $screen = get_current_screen();

    if (!$screen || $screen->post_type !== 'project') {
        return;
    }

    wp_enqueue_script(
        'eabcdev-project-extra-info',
        get_template_directory_uri() . '/assets/js/project-extra-info.js',
        [],
        '1.0',
        true
    );

    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;

    $project_extra_info = get_post_meta($post_id, 'project_extra_info', true);

    $project_extra_info = $project_extra_info ? json_decode($project_extra_info, true) : [];

    wp_localize_script(
        'eabcdev-project-extra-info',
        'eabcdevProjectExtraInfo',
        [
            'extraInfo'=>$project_extra_info,
        ]
    );
}

add_action('admin_enqueue_scripts', 'eabcdev_portfolio_project_extra_info_admin_assets');

/**
 * project_extra_info save hook
 * -> preps and checks project extra info to be saved as json in the db
 */
function eabcdev_portfolio_save_project_extra_info($post_id) {
    if (!isset($_POST['eabcdev_portfolio_project_extra_info_nonce'])) {
        return;
    }

    if (!wp_verify_nonce(
        $_POST['eabcdev_portfolio_project_extra_info_nonce'], 'eabcdev_portfolio_project_extra_info'
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

    if (
        !isset($_POST['project_extra_info']) ||
        !is_array($_POST['project_extra_info'])
    ) {
        delete_post_meta($post_id, 'project_extra_info');
        return;
    }

    $submitted_extra_info = $_POST['project_extra_info'];

    $clean_extra_info = [];

    foreach ($submitted_extra_info as $text) {
        if (!is_string($text)) {
            continue;
        }


        $text = sanitize_text_field($text);

        if ($text === '') {
            continue;
        }

        $clean_extra_info[] = $text;
    }

    if (empty($clean_extra_info)) {
      delete_post_meta($post_id, 'project_extra_info');
      return;
    }

    update_post_meta(
        $post_id,
        'project_extra_info',
        wp_json_encode($clean_extra_info)
    );
}

add_action('save_post_project', 'eabcdev_portfolio_save_project_extra_info');
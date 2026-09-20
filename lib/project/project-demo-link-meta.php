<?php 

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_add_project_demo_link_metabox() {
    add_meta_box(
        'eabcdev_project_demo_link',
        'Project Demo Link',
        'eabcdev_portfolio_render_project_demo_link_metabox',
        'project',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'eabcdev_portfolio_add_project_demo_link_metabox');

function eabcdev_portfolio_render_project_demo_link_metabox($post) {
    wp_nonce_field(
        'eabcdev_portfolio_project_demo_link',
        'eabcdev_portfolio_project_demo_link_nonce'
    );

    $demoLink = get_post_meta(
        $post->ID,
        'project_demo_link',
        true
    );

    ?>
      <div>
        <p>
          <label>
            Enter Demo Link:
            <input
              type="url"
              class="widefat"
              name="project_demo_link"
              value="<?php echo esc_attr($demoLink); ?>"
            >
          </label>
        </p>
      </div>
    <?php
}

function eabcdev_portfolio_save_project_demo_link($post_id) {
    if(!isset($_POST['eabcdev_portfolio_project_demo_link_nonce'])) {
        return;
    }

    if(!wp_verify_nonce($_POST['eabcdev_portfolio_project_demo_link_nonce'], 'eabcdev_portfolio_project_demo_link')) {
        return;
    }

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (get_post_type($post_id) !== 'project') {
        return;
    }

    if(!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['project_demo_link'])) {
        update_post_meta(
            $post_id,
            'project_demo_link',
            sanitize_text_field(
                $_POST['project_demo_link']
            )
        );
    }
}

add_action(
    'save_post_project',
    'eabcdev_portfolio_save_project_demo_link'
);

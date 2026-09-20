<?php 

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_add_project_github_link_metabox() {
    add_meta_box(
        'eabcdev_project_github_link',
        'Project Github Link',
        'eabcdev_portfolio_render_project_github_link_metabox',
        'project',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'eabcdev_portfolio_add_project_github_link_metabox');

function eabcdev_portfolio_render_project_github_link_metabox($post) {
    wp_nonce_field(
        'eabcdev_portfolio_project_github_link',
        'eabcdev_portfolio_project_github_link_nonce'
    );

    $githubLink = get_post_meta(
        $post->ID,
        'project_github_link',
        true
    );

    ?>
      <div>
        <p>
          <label>
            Enter Github Link:
            <input
              type="url"
              class="widefat"
              name="project_github_link"
              value="<?php echo esc_attr($githubLink); ?>"
            >
          </label>
        </p>
      </div>
    <?php
}

function eabcdev_portfolio_save_project_github_link($post_id) {
    if(!isset($_POST['eabcdev_portfolio_project_github_link_nonce'])) {
        return;
    }

    if(!wp_verify_nonce($_POST['eabcdev_portfolio_project_github_link_nonce'], 'eabcdev_portfolio_project_github_link')) {
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

    if (isset($_POST['project_github_link'])) {
        update_post_meta(
            $post_id,
            'project_github_link',
            sanitize_text_field(
                $_POST['project_github_link']
            )
        );
    }
}

add_action(
    'save_post_project',
    'eabcdev_portfolio_save_project_github_link'
);

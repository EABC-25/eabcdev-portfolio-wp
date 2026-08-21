<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $post_type = get_post_type();
  $post_slug = get_post_type_object($post_type)->rewrite['slug'];
  $projects = get_posts([
    'post_type'=>'project',
    'posts_per_page'=> -1,
    'orderby'=>'menu_order'
  ]);
  $colored = $args['colored']
?>
<section 
  class="window-tab <?php echo $colored ? "colored" : "" ?>" 
  id="first-column"
>
  <div class="window-tab-header">
    <h1>
      <?php echo esc_html(ucfirst($post_slug))?>
    </h1>
  </div>
  <section class="window-content">
    <ul class="projects-list">
    <?php foreach ($projects as $project) : ?>
      <li>
        <a 
          href="<?php echo get_permalink($project); ?>"
        >
          <?php echo esc_html($project->post_title); ?>
        </a>
      </li>
    <?php endforeach; ?>
    </ul>
  </section>
</section>
  


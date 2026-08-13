<?php
  if (!defined('ABSPATH')) {
    exit;
  }

  $projects = get_posts([
    'post_type'=>'project',
    'posts_per_page'=> -1,
    'orderby'=>'menu_order'
  ]);
?>
  <div class="window-header">
    <div class="window-title">
       <!-- TODO: sanitize h1 ?-->
      <h1>Projects</h1>
      <a href="<?php echo esc_url(home_url('/'));?>">x</a>
    </div>
  </div>
  
  <section class="window-contents">
    <ul class="projects-list">
    <?php foreach ($projects as $project) : ?>
      <li>
        <a 
          href="<?= get_permalink($project); ?>"
        >
          <?= esc_html($project->post_title); ?>
        </a>
      </li>
    <?php endforeach; ?>
    </ul>
  </section>
  


<?php
  $projects = get_posts([
    'post_type'=>'project',
    'posts_per_page'=> -1,
    'orderby'=>'menu_order'
  ]);
?>

<nav>
  <h1>Projects</h1>

  <?php foreach ($projects as $project) : ?>
    <a 
      href="<?= get_permalink($project); ?>"
    >
      <?= esc_html($project->post_title); ?>
    </a>
  <?php endforeach; ?>
</nav>
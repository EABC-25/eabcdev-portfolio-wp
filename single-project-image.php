<?php

if (!defined('ABSPATH')) {
    exit;
}

$project_id = get_the_ID();
$project_name_slug = get_query_var('name');
$project_url = eabcdev_portfolio_get_project_url($project_id);

$image_slug = isset($_GET['image']) 
  ? sanitize_title(wp_unslash($_GET['image'])) : '';
$project_image_slug = get_query_var('project_image');
$image = $image_slug 
  ? eabcdev_portfolio_get_project_image($project_id, $image_slug) : null;

get_header(); 
?>
<section class="window">
  <section class="window-tab">
    <div class="window-tab-header">
      <h1>project</h1>
    </div>
    <section class="window-content first-column">
      project content
    </section>
  </section>
  <section class="window-tab">
    <div class="window-tab-header"><h1>project-name</h1></div>
    <section class="window-content second-column">
      project name content
    </section>
  </section>
  <section class="window-tab colored">
    <div class="window-tab-header"><h1>project-images</h1></div>
    <section class="window-content third-column">
      project images content
      <?php var_dump($image_slug);
        var_dump($image);
      ?>
    </section>
  </section>
</section>

<?php get_footer();
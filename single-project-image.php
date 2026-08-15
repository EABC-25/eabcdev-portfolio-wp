<?php

if (!defined('ABSPATH')) {
    exit;
}

$project_id = get_the_ID();
$project_name_slug = get_query_var('name');
$project_image_slug = get_query_var('project_image');

$project_url = eabcdev_portfolio_get_project_url($project_id);
$image = eabcdev_portfolio_get_project_image(
  $project_id,
  $project_image_slug
);

get_header(); 
?>
<section class="window">
  <section class="window-tab">
    <div class="window-tab-header">
      <h1>project</h1>
    </div>
    <section class="window-content" id="first-column">
      project content
    </section>
  </section>
  <section class="window-tab">
    <div class="window-tab-header"><h1>project-name</h1></div>
    <section class="window-content" id="second-column">
      project name content
    </section>
  </section>
  <section class="window-tab">
    <div class="window-tab-header"><h1>project-images</h1></div>
    <section class="window-content" id="third-column">
      project images content
    </section>
  </section>
</section>

<?php get_footer();
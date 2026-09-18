<?php

  if (!defined('ABSPATH')) {
    exit;
  }

  $project_id = $args['project-id'];
  $images = $args['images'];
  $colored = $args['colored'];
  $project_title = get_the_title($project_id);
  $project_content = get_the_content($project_id);
  $project_featured_image = get_the_post_thumbnail( $project_id, 'medium' );
  $project_taxonomies = eabcdev_portfolio_get_project_taxonomies($project_id);
  $project_extra_info = eabcdev_portfolio_get_project_extra_info($project_id);
  $type = $project_taxonomies['type'];
  $languages = $project_taxonomies['languages'];
  $technologies = $project_taxonomies['technologies'];
  $status = $project_taxonomies['status'];
?>
<section 
  class="window-tab <?php echo $colored ? "colored" : "" ?>" 
  id="second-column"
>
  <div class="window-tab-header">
    <h1><?php echo esc_html($project_title); ?></h1>
  </div>

  <section class="window-content second-column">
    <section>
      <h1><?php echo esc_html($project_title); ?></h1>
      <p>
        <?php echo esc_html(wp_strip_all_tags($project_content)); ?>
      </p>
      <div class="project-name-taxonomies">
        <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
        'class' => 'language',
        'values' => $languages,
        ]); ?>
        <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
        'class' => 'technology',
        'values' => $technologies,
        ]); ?>
        <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
        'class' => 'type',
        'values' => $type,
        ]); ?>
        <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
        'class' => 'status',
        'values' => $status,
        ]); ?>
      </div>
      <?php echo $project_featured_image ?>
      <?php if ($images && $images !== 'NO DISPLAY') : ?>
        <h1>Project Images:</h1>
        <?php foreach ($images as $image) : ?>
          <?php 
            $image_url = eabcdev_portfolio_get_project_image_url($project_id, $image['slug']);  
          ?>
          <a href="<?php echo esc_url($image_url); ?>">
            <?php 
              echo wp_get_attachment_image($image['image_id'], 'medium')
            ?>
          </a>
        <?php endforeach; ?>
      <?php elseif ($images === 'NO DISPLAY') :?>
        <p>Please go to images tab -------></p>
      <?php else :?>
        <p>This project does not have images.</p>
      <?php endif; ?>
    </section>
  </section>
</section>
<?php

  if (!defined('ABSPATH')) {
    exit;
  }

  $project_id = $args['project-id'];
  $images = $args['images'];
  $colored = $args['colored'];
  $project_title = get_the_title($project_id);
  $project_content = get_the_content($project_id);
  $project_featured_image_url = get_the_post_thumbnail_url($project_id);
  $project_featured_image = get_the_post_thumbnail($project_id, "medium");
  $project_taxonomies = eabcdev_portfolio_get_project_taxonomies($project_id);
  $project_extra_info = eabcdev_portfolio_get_project_extra_info($project_id);
  $type = $project_taxonomies['type'];
  $languages = $project_taxonomies['languages'];
  $technologies = $project_taxonomies['technologies'];
  $status = $project_taxonomies['status'];
  $github_link = get_post_meta($project_id, 'project_github_link', true);
  $demo_link = get_post_meta($project_id, 'project_demo_link', true);
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
      <section class="project-name">
        <section class="project-name-main">
          <div class="project-name-featured-image" >
            <?php echo $project_featured_image; ?>
          </div>
          <h1 class="project-name-title">
            <?php echo esc_html($project_title); ?>
          </h1>
          <p class="project-name-content">
            <?php echo esc_html(wp_strip_all_tags($project_content)); ?>
          </p>
          <ul class="project-name-extra-info">
            <?php foreach($project_extra_info as $info) : ?>
              <li><?php echo esc_html($info); ?></li>
            <?php endforeach; ?>
          </ul>
        </section>
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
        <div class="project-name-links">
          <p>
            <a 
              href="<?php echo esc_url($github_link); ?>" 
              target="_blank"
              rel="noopener noreferrer">
              Github Link
            </a>
          </p>
          <p>
            <a 
              href="<?php echo esc_url($demo_link); ?>" 
              target="_blank"
              rel="noopener noreferrer">
              Demo Link
            </a>
          </p>
        </div>
        <div class="project-name-images-heading">
          <h1>
            <?php 
              if ($images === 'NO DISPLAY') {
                echo 'Project Images in next tab ----->';
              } else {
                echo 'Project Images:';
              }
            ?>
          </h1>
        </div>
        <div class="project-name-images">
          <?php if ($images && $images !== 'NO DISPLAY') : ?>
            <?php foreach ($images as $image) : ?>
              <?php 
                $image_url = eabcdev_portfolio_get_project_image_url($project_id, $image['slug']);  
              ?>
              <div class="project-name-image">
                <a href="<?php echo esc_url($image_url); ?>">
                  <?php echo wp_get_attachment_image($image['image_id'], 'medium')?>
                </a>
              </div>   
            <?php endforeach; ?>
          <?php else :?>
            <p>This project does not have images.</p>
          <?php endif; ?>
        </div>
      </section>
    </section>
  </section>
</section>
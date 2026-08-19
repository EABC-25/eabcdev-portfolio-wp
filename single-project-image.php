<?php

if (!defined('ABSPATH')) {
    exit;
}

$project_id = get_the_ID();
$project_name_slug = get_query_var('name');
$project_url = eabcdev_portfolio_get_project_url($project_id);

$image_slug = isset($_GET['image']) 
  ? sanitize_title(wp_unslash($_GET['image'])) : '';
$image = $image_slug 
  ? eabcdev_portfolio_get_project_image($project_id, $image_slug) : null;
$images = eabcdev_portfolio_get_project_images($project_id);

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
      <div class="gallery">
        <div class="featured">
          <?php echo wp_get_attachment_image($image['image_id'], 'large') ?>
        </div>
        <div class="slider-container">
          <div class="slider">
            <?php if ($images) : ?>
              <?php foreach ($images as $image_single) : ?>
                <?php 
                  $thumbnail = wp_get_attachment_image($image_single['image_id'], 'small');

                  $large_image = wp_get_attachment_image_url($image_single['image_id'], 'large');
                ?>
                <div 
                  class="<?php echo $image_slug === $image_single['slug'] ? 'card full-opacity': 'card' ?>"
                  data-image-slug="<?php echo esc_attr($image_single['slug']); ?>"
                  data-large-image="<?php echo esc_url($large_image); ?>"            
                >
                  <?php echo $thumbnail; ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </section>
</section>

<?php get_footer();
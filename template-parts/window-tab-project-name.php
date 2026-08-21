<?php

  if (!defined('ABSPATH')) {
    exit;
  }

  $project_id = $args['project-id'];
  $project_name_slug = $args['project-name-slug'];
  $images = $args['images'];
  $colored = $args['colored'];
?>
<section 
  class="window-tab <?php echo $colored ? "colored" : "" ?>" 
  id="second-column"
>
  <div class="window-tab-header">
    <h1><?php echo esc_html($project_name_slug); ?></h1>
  </div>

  <section class="window-content">
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
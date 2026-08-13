<?php
  if (!defined('ABSPATH')) {
    exit;
  }

  $project_name = get_query_var('name');
  $project_id = get_the_ID();
  $images = eabcdev_portfolio_get_project_images($project_id);
?>

<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) :
      the_post();
?>
<article class="window">
  <section class="window-tab">
  <div class="window-header">
    <div class="window-title full-margin not-current">
       <!-- TODO: sanitize h1 ?-->
      <a href="<?php echo esc_url('/projects');?>">
        <h1>Projects</h1>
      </a>
    </div>
    <div class="window-title">
       <!-- TODO: sanitize h1 ?-->
      <h1><?php the_title(); ?></h1>
      <a href="<?php echo esc_url('/projects');?>">x</a>
    </div>
  </div>

  <section class="window-contents">
    <?php echo sanitize_title($project_name); ?>
    <?php if ($images) : ?>
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
    <?php else :?>
      <p>This project does not have images.</p>
    <?php endif; ?>
  </section>
</section>
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
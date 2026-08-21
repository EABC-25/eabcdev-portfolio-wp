<?php
  if (!defined('ABSPATH')) {
    exit;
  }

  $project_name_slug = get_query_var('name');
  $project_id = get_the_ID();
  $images = eabcdev_portfolio_get_project_images($project_id);
?>

<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) :
      the_post();
?>
<section class="window">
  <?php get_template_part('template-parts/window-tab', 'project', [
    'colored' => false
  ]); ?>
  <?php get_template_part('template-parts/window-tab', 'project-name', [
    'project-id' => $project_id,
    'project-name-slug' => $project_name_slug,
    'images' => $images,
    'colored' => true,
  ]); ?>
  <section class="window-tab" id="third-column">
  </section>
</section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
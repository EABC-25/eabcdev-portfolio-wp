<?php

if (!defined('ABSPATH')) {
    exit;
}

$project_name_slug = get_query_var('name');
$project_image_slug = get_query_var('project_image');

$image = eabcdev_portfolio_get_project_image(
  get_the_ID(),
  $project_image_slug
);

get_header(); 
?>

<article class="window-tab">
  <div class="window-header">
    <div class="window-title full-margin not-current">
       <!-- TODO: sanitize h1 ?-->
      <a href="<?php echo esc_url('/projects');?>">
        <h1>Projects</h1>
      </a>
    </div>
    <div class="window-title full-margin not-current">
       <!-- TODO: sanitize h1 ?-->
      <h1><?php the_title(); ?></h1>
      <a href="<?php echo esc_url('/projects');?>">x</a>
    </div>
    <div class="window-title ">
       <!-- TODO: sanitize h1 ?-->
      <h1><?php echo esc_html($project_image_slug) ?></h1>
      <!-- FIX: BUILD QUERY BACK TO PROJECT_NAME -->
      <a href="<?php echo esc_url($project_name_slug);?>">x</a>
    </div>
  </div>

  <section class="window-contents">
    <?php if ($image) : ?>
        <?php echo wp_get_attachment_image(
            $image['image_id'], 'large'
        );?>
    <?php endif; ?>
  </section>
</article>

<?php get_footer();
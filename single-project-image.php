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
<article class="window">
  <div class="window-absolute-container">
    <section class="window-tab absolute furled">
      <?php get_template_part('template-parts/sub-header', 'project'); ?>
    </section>
    <button id="window-absolute-button"></button>
  </div>

  <section class="window-tab">
  <div class="window-header">
    <!-- <div class="window-title full-margin not-current">
      <a href="<?php echo esc_url('/projects');?>">
        <h1>Projects</h1>
      </a>
    </div> -->
    <div class="window-title full-margin not-current">
      <a href="<?php echo $project_url; ?>"><h1>
        <?php echo eabcdev_portfolio_substr_trailing_dots(esc_html(get_the_title()), 0, 8); ?>
      </h1></a>
    </div>
    <div class="window-title full-width">
      <h1><?php echo eabcdev_portfolio_substr_trailing_dots(esc_html($project_image_slug), 0, 8); ?></h1>
      <a href="<?php echo $project_url; ?>">x</a>
    </div>
  </div>

  <section class="window-contents">
    <?php if ($image) : ?>
        <?php echo wp_get_attachment_image(
            $image['image_id'], 'large', false, array( 'class' => 'fit' )
        );?>
    <?php endif; ?>
  </section>
  </section>
</article>

<?php get_footer();
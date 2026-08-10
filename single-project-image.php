<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<?php get_header(); 

$project_image = get_query_var('project_image');

$images_json = get_post_meta(
    get_the_ID(),
    'project_images',
    true
);

$images = $images_json ? json_decode($images_json, true) : [];

$requested_image = null;

foreach($images as $image) {
    if(
        isset($image['slug']) &&
        $image['slug'] === $project_image
    ) {
        $requested_image = $image;
        break;
    }
}
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
      <h1><?php echo esc_html($project_image) ?></h1>
      <a href="<?php echo esc_url('/projects');?>">x</a>
    </div>
  </div>

  <section class="window-contents">
    <?php if ($requested_image) : ?>
        <?php echo wp_get_attachment_image(
            $requested_image['image_id'], 'large'
        );?>
    <?php else : ?>
        <p>Image not found.</p>
    <?php endif; ?>
    
  </section>
</article>

<?php get_footer();
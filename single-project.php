<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $s = $_SERVER['REQUEST_URI'];
?>

<?php get_header(); ?>

<?php
  if (have_posts()) :
    while (have_posts()) :
      the_post();
?>

<article class="window-tab">
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
    <?php echo esc_url($s); ?>
    
  </section>
</article>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php
  if (!defined('ABSPATH')) {
    exit;
  }

  $fl = $args['fl'];
?>

<div class="project-icon">
  <span class="fl"><?php echo esc_html($fl); ?></span>
  <?php echo eabcdev_portfolio_icon('projects'); ?>
</div>
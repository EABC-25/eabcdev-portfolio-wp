<?php
  if (!defined('ABSPATH')) {
    exit;
  }

  $class = $args['class'];
  $values = $args['values'];
?>

<div class="taxonomy <?php echo esc_attr($class); ?>">
  <?php if (!$values || is_wp_error($values)) :?>
      
  <?php else : ?>
    <?php foreach ($values as $value) : ?>
      <h2>
        <?php echo esc_html($value->name)?>
      </h2>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
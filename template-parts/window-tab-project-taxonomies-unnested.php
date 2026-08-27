<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $class = $args['class'];
  $values = $args['values'];
?>

<div class="<?php echo esc_attr($class); ?>"> 
  <?php if (!$values || is_wp_error($values)) :?>
      
  <?php else : ?>
    <?php foreach ($values as $value) : ?>
      <h1>
        <?php echo esc_html($value->name)?>
      </h1>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
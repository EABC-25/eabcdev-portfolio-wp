<?php

if (!defined('ABSPATH')) {
    exit;
}
class EABCDEV_Portfolio_Primary_Menu_Walker extends Walker_Nav_Menu {
  public function start_el(
    &$output,
    $item,
    $depth = 0,
    $args = null,
    $id = 0
  ) {
    $icon = sanitize_key($item->post_name);

    $svg = eabcdev_portfolio_icon($icon);

    // array filter will remove empty classes[0]
    $classes = implode(' ', array_filter($item->classes));
    
    // I ctually want to reduce bloat and remove all these classes, but for now lets keep it
    $output .= sprintf(
      '<li class="%s">
        <a href="%s">
          %s
          <span class="screen-reader-text">%s</span>
        </a>
      </li>',
      esc_attr($classes),
      esc_url($item->url),
      $svg,
      esc_html($item->title)
    );
  }
}
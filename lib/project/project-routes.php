<?php

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_project_query_vars($vars) {
  $vars[] = 'project_image';

  return $vars;
}

add_filter(
  'query_vars',
  'eabcdev_portfolio_project_query_vars'
);

function eabcdev_portfolio_project_rewrite_rules() {
  add_rewrite_rule(
    'projects/([^/]+)/([^/]+)/?$',
    'index.php?post_type=project&name=$matches[1]&project_image=$matches[2]',
    'top'
  );
}

add_action('init', 'eabcdev_portfolio_project_rewrite_rules');

function eabcdev_portfolio_project_image_template($template) {
  $project_image = get_query_var('project_image');

  if(!$project_image) {
    return $template;
  }

  $image_template = locate_template('single-project-image.php');

  if($image_template) {
    return $image_template;
  }

  return $template;
}

add_filter('template_include', 'eabcdev_portfolio_project_image_template');

// add_action('init', function () {
//     global $wp_rewrite;

//     $rules = $wp_rewrite->wp_rewrite_rules();

//     echo '<pre>';

//     foreach ($rules as $rule => $query) {
//         if (str_contains($rule, 'projects')) {
//             var_dump($rule, $query);
//         }
//     }

//     echo '</pre>';

//     exit;
// });
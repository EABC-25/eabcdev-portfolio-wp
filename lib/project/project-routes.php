<?php

if (!defined('ABSPATH')) {
    exit;
}

function eabcdev_portfolio_project_query_vars($vars) {
  $vars[] = 'project_images';

  return $vars;
}

add_filter(
  'query_vars',
  'eabcdev_portfolio_project_query_vars'
);

function eabcdev_portfolio_project_rewrite_rules() {
  $post_type = get_post_type_object('project');

  if(!$post_type || !$post_type->rewrite) {
    return;
  }

  $slug = $post_type->rewrite['slug'];

  add_rewrite_rule(
    '^' . $slug . '/([^/]+)/images/?$',
    'index.php?post_type=project&name=$matches[1]&project_images=true',
    'top'
  );
}

add_action('init', 'eabcdev_portfolio_project_rewrite_rules');

function eabcdev_portfolio_project_image_template($template) {
  $project_images = get_query_var('project_images');

  if(!$project_images) {
    return $template;
  }

  $project_id = get_the_ID();

  if (
    !$project_id ||
    get_post_type($project_id) !== 'project'
  ) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    return get_404_template();
  }

  $image_slug = isset($_GET['image']) ? sanitize_title(wp_unslash($_GET['image'])) : "";

  // /images/ AS !isset($_GET['image]) is ""
  // /images/?image= also gives ""
  // therefore "" should then immediately route to single-project-image.php wherein it should display the very first image in the gallery as default
  if ($image_slug === "") {
    $image_template = locate_template('single-project-image.php');
    if ($image_template) {
      return $image_template;
    }

    return $template;
  }

  

  // this will check for $image_slug in $project_id, so if one doesn't match the other -> $image=null -> route to 404 page
  $image = eabcdev_portfolio_get_project_image(
    $project_id,
    $image_slug
  );

  if (!$image) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    return get_404_template();
  }

  $image_template = locate_template('single-project-image.php');

  if($image_template) {
    return $image_template;
  }

  // this is index.php or another fallback
  return $template;
}

add_filter('template_include', 'eabcdev_portfolio_project_image_template');

// TO CHECK ALL REWRITE RULES:
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
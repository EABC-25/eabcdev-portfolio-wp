<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $post_type = get_post_type();
  $post_slug = get_post_type_object($post_type)->rewrite['slug'];
  $projects = get_posts([
    'post_type'=>'project',
    'posts_per_page'=> -1,
    'orderby'=>'menu_order'
  ]);
  $colored = $args['colored']
?>
<section 
  class="window-tab <?php echo $colored ? "colored" : "" ?>" 
  id="first-column"
>
  <div class="window-tab-header">
    <h1>
      <?php echo esc_html(ucfirst($post_slug))?>
    </h1>
  </div>
  <section class="window-content first-column">
    <section>
      <section class="projects-table">
        <div class="projects-filters"></div>
        <ul class="projects-list">
          <?php foreach ($projects as $project) : 
              $taxonomies = eabcdev_portfolio_get_project_taxonomies($project->ID);
              
              $project_link = get_permalink($project);
              $excerpt = get_the_excerpt($project);

              $type = $taxonomies['type'];
              $languages = $taxonomies['languages'];
              $technologies = $taxonomies['technologies'];
              $status = $taxonomies['status'];
              $project_fl = mb_substr($project->post_title, 0, 1)
          ?>
            <li>
              <div class="folder-top-layout">
                <div class="left">
                  <div class="project-name">
                  <h1>
                    <?php echo esc_html($project->post_title); ?>
                  </h1>
                </div>
                </div>
                <div class="right"></div>
              </div>
              <div class="folder-pane">
                <div class="project-info">
                  <p class="project-excerpt">
                    <?php echo esc_html($excerpt); ?>
                  </p>
                  <a class="project-link" href="<?php echo esc_url($project_link); ?>">Open Project >></a>
                </div>
                <div  class="project-taxonomies">
                  <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                  'class' => 'language',
                  'values' => $languages,
                  ]); ?>
                  <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                  'class' => 'technology',
                  'values' => $technologies,
                  ]); ?>
                  <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                  'class' => 'type',
                  'values' => $type,
                  ]); ?>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    </section>
  </section>
</section>
  


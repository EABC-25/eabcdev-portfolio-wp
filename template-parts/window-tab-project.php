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
        <ul class="projects-fields">
          <li>
            <div class="name">
    
            </div>
          <div class="type">
            <h1>
              Type
            </h1>
          </div>
          <div class="language">
            <h1>
              Languages
            </h1>
          </div>
          <div class="technology">
            <h1>
              Technologies
            </h1>
          </div>
          <div class="stat">
            <h1>
              Status
            </h1>
          </div>
          </li>
        </ul>
        <ul class="projects-list">
          <?php foreach ($projects as $project) : 
              $taxonomies = eabcdev_portfolio_get_project_taxonomies($project->ID);
              
              $type = $taxonomies['type'];
              $languages = $taxonomies['languages'];
              $technologies = $taxonomies['technologies'];
              $status = $taxonomies['status'];
              $project_fl = mb_substr($project->post_title, 0, 1)
          ?>
          <div class="relative">
            <li>
              <div class="name">
                <div class="project-list-header">
                  <h2>
                    <?php echo esc_html($project->post_title); ?>
                  </h2>
                </div>
              </div>
              <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                'class' => 'type',
                'values' => $type,
              ]); ?>
              <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                'class' => 'language',
                'values' => $languages,
              ]); ?>
              <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                'class' => 'technology',
                'values' => $technologies,
              ]); ?>
              <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                'class' => 'stat',
                'values' => $status,
              ]); ?>
            </li>
          </div> 
          <?php endforeach; ?>
          <div class="project-last">
            <li>
              <div class="name">
                <div class="project-list-header-closer">
                </div>
              </div>
              <div class="type"></div>
              <div class="language"></div>
              <div class="technology"></div>
              <div class="stat"></div>
            </li> 
          </div>
        </ul>
      </section>
    </section>
  </section>
</section>
  


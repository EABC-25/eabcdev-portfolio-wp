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
  <section class="window-content">
    <article>
      <section class="project-table">
        <ul class="names-column">
          <li class="field" id="name">
            <p>Name</p>
          </li>
          <?php foreach ($projects as $project) : ?>
            <li class="value" id="name">
              <a href="<?php echo get_permalink($project); ?>">
                <?php echo esc_html($project->post_title); ?>
              </a>
            </li>
          <?php endforeach; ?>
          <?php for ($count = 0; $count <= 20; $count++) :?>
            <li class="value" id="name">
              <p>testsssssssssssssssss ssssssssssssssssssssssssssssssssssssssssssssssssssssss</p>
            </li>
          <?php endfor; ?>
        </ul>
        <ul class="types-column">
          <li class="field" id="type">
            <p>Type</p>
          </li>
        </ul>
        <ul class="languages-column">
          <li class="field" id="language">
            <p>Languages</p>
          </li>
        </ul>
        <ul class="technologies-column">
          <li class="field" id="technology">
            <p>Technologies</p>
          </li>
        </ul>
        <ul class="status-column">
          <li class="field" id="stat">
            <p>Status</p>
          </li>
        </ul>
      </section>
    </article>
  </section>
</section>
  


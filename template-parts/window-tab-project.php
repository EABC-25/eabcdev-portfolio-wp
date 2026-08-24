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
      <div class="window-wide-screen">
        <section class="projects-table">
        <section class="projects-fields">
          <div class="name">
            <h1>
              Name
            </h1>
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
        </section>
        <ul class="projects-list">
          <?php foreach ($projects as $project) : ?>
            <li>
              <div class="name">
                <a href="<?php echo get_permalink($project); ?>">
                  <h1>
                    <?php echo esc_html($project->post_title); ?>
                  </h1>
                </a>
              </div>
              <div class="type">
                <h1>
                  test type
                </h1>
              </div>
              <div class="language">
                <h1>
                  test language test language test language test language test language
                </h1>
              </div>
              <div class="technology">
                <h1>
                  test technology
                </h1>
              </div>
              <div class="stat">
                <h1>
                  test stat
                </h1>
              </div>
            </li>
          <?php endforeach; ?>
          <?php for ($i = 0; $i <= 30; $i++) : ?>
          <li>
            <div class="name">
              <h1>
                test name
              </h1>
            </div>
            <div class="type">
              <h1>
                test type
              </h1>
            </div>
            <div class="language">
              <h1>
                test language test language test language test language test language
              </h1>
            </div>
            <div class="technology">
              <h1>
                test technology
              </h1>
            </div>
            <div class="stat">
              <h1>
                test stat
              </h1>
            </div>
          </li>
        <?php endfor; ?>
        </ul>
      </section>
      </div>
    </section>
  </section>
</section>
  


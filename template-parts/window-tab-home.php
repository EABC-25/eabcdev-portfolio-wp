<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $colored = $args['colored'];
  $hero = get_theme_file_uri('assets/images/hero.png');
  $latest_projects = get_posts([
    'post_type'=>'project',
    'post_status'=>'publish',
    'posts_per_page'=> 3,
    'fields'=>'ids',
    'orderby'=>'menu_order',
    'order'=>'ASC',
  ]);

  $latest_projects = array_map(function ($project_id) {
    return [
      'id'=>$project_id,
      'featured_image'=>get_the_post_thumbnail_url($project_id, 'medium'),
      'title'=>get_the_title($project_id),
      'permalink'=>get_permalink($project_id),
      'languages'=>wp_get_post_terms(
        $project_id,
        'project_language',
        ['fields'=>'all']
      ),
    ];
  }, $latest_projects)
?>
<section 
  class="window-tab <?php echo $colored ? "colored" : "" ?>" 
  id="first-column"
>
  <div class="window-tab-header">
    <h1>
      Home
    </h1>
  </div>
  <section class="window-content first-column">
    <section>
      <section class="eabcdev-home">
        <section class="eabcdev-home-hero">
          <div class="eabcdev-home-image">
            <img src="<?php echo esc_url($hero); ?>" alt="eabcdev image">
          </div>
          <div class="eabcdev-home-title">
            <h1>Hi, I'm EABCDEV!</h1>
          </div>
          <div class="eabcdev-home-excerpt">
            <p>Gamer, Rider, Coder</p>
          </div>
        </section> 
        <section class="eabcdev-home-latest"> 
          <div class="eabcdev-home-latest-container">
            <div class="eabcdev-home-latest-slider-btns">
              <button class="slider-btn-left" type="button"><</button>
              <button class="slider-btn-right" type="button">></button>
            </div>
            <div class="eabcdev-home-latest-slider-frame">
              <div class="slider-container">
                <ul class="slider-switch eabcdev-home-latest-list-slider">
                  <?php if (! empty($latest_projects)) : ?>
                    <?php foreach ($latest_projects as $project) : ?>
                      <?php  ?>
                    <?php endforeach; ?>
                  <?php else: ?>
                  <?php endif; ?>
                  <li>
                    <div class="eabcdev-home-folder-top-container">
                      <div class="folder-top-layout">
                        <div class="left">
                          <div class="project-title">
                            <h1>
                              test 1
                            </h1>
                          </div>
                        </div>
                        <div class="right"></div>
                      </div>
                    </div>           
                    <div class="folder-pane eabcdev-home-folder-pane">
                      <div>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex alias voluptatum, nulla nisi id asperiores illum eius nostrum debitis ut dolorum consectetur aliquam rerum nam libero. Tempore adipisci ex molestiae, facere aut nisi quia doloremque quibusdam nulla ipsum inventore sequi, eaque eius, facilis velit cumque minus possimus labore ducimus deleniti.
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="eabcdev-home-folder-top-container">
                      <div class="folder-top-layout">
                        <div class="left">
                          <div class="project-title">
                            <h1>
                              test 2
                            </h1>
                          </div>
                        </div>
                        <div class="right"></div>
                      </div>
                    </div>           
                    <div class="folder-pane eabcdev-home-folder-pane">
                      <div>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex alias voluptatum, nulla nisi id asperiores illum eius nostrum debitis ut dolorum consectetur aliquam rerum nam libero. Tempore adipisci ex molestiae, facere aut nisi quia doloremque quibusdam nulla ipsum inventore sequi, eaque eius, facilis velit cumque minus possimus labore ducimus deleniti.
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="eabcdev-home-folder-top-container">
                      <div class="folder-top-layout">
                        <div class="left">
                          <div class="project-title">
                            <h1>
                              test 3
                            </h1>
                          </div>
                        </div>
                        <div class="right"></div>
                      </div>
                    </div>           
                    <div class="folder-pane eabcdev-home-folder-pane">
                      <div>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex alias voluptatum, nulla nisi id asperiores illum eius nostrum debitis ut dolorum consectetur aliquam rerum nam libero. Tempore adipisci ex molestiae, facere aut nisi quia doloremque quibusdam nulla ipsum inventore sequi, eaque eius, facilis velit cumque minus possimus labore ducimus deleniti.
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>          
          </div>
        </section>
      </section>
    </section>
  </section>
</section>
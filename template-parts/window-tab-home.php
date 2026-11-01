<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $colored = $args['colored'];
  $hero = get_theme_file_uri('assets/images/hero_2.png');
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
      'featured_image_url'=>get_the_post_thumbnail_url($project_id),
      'title'=>get_the_title($project_id),
      'excerpt'=>get_the_excerpt($project_id),
      'project_link'=>get_permalink($project_id),
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
          <div class="eabcdev-home-logo">
            <div class="badge">
              <img src="<?php echo esc_url($hero); ?>" alt="eabcdev image">
            </div>
            <div class="eabcdev-home-intro">
              <h1>Hi, I'm EABCDEV!</h1>
              <p>Gamer, Rider, Coder.</p>
            </div>
          </div>
        </section> 
        <section class="eabcdev-home-latest"> 
          <div class="eabcdev-home-latest-container">
            <div class="eabcdev-home-latest-slider-frame">
              <div class="slider-container">
                <ul class="slider-switch eabcdev-home-latest-list">
                  <?php if (! empty($latest_projects)) : ?>
                    <?php foreach ($latest_projects as $project) : ?>
                      <li>
                        <div class="eabcdev-home-folder-top-container">
                          <div class="folder-top-layout">
                            <div class="left">
                              <div class="project-title">
                                <h1>
                                  <?php echo esc_html($project['title']); ?>
                                </h1>
                              </div>
                            </div>
                            <div class="right"></div>
                          </div>
                        </div>           
                        <div class="folder-pane eabcdev-home-folder-pane">
                          <div class="project-info latest-project-info" style="
                            background-image: 
                            linear-gradient(rgba(46,46,46,0.7), rgba(46,46,46,0.7)),
                            url('<?php echo esc_url($project['featured_image_url']); ?>');
                            background-size: cover;
                            background-position: center;
                            background-repeat: no-repeat;
                          ">
                            <p class="project-excerpt">
                              <?php echo esc_html($project['excerpt']); ?>
                            </p>
                            <a class="project-link" href="<?php echo esc_url($project['project_link']); ?>">...View More</a>
                          </div>
                          <div class="project-taxonomies latest-projects">
                            <?php get_template_part('template-parts/window-tab', 'project-taxonomies-unnested', [
                            'class' => 'language',
                            'values' => $project['languages'],
                            ]); ?>
                          </div>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  <?php else: ?>
                  <?php endif; ?>
                </ul>
              </div>
            </div>          
            <div class="eabcdev-home-latest-slider-btns">
              <button class="slider-btn-one" type="button">1</button>
              <button class="slider-btn-two" type="button">2</button>
              <button class="slider-btn-three" type="button">3</button>
            </div>
          </div>
        </section>
      </section>
    </section>
  </section>
</section>
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
        <div class="eabcdev-home-jumbotron">
          <div class="eabcdev-home-jumbotron-logo">
            <img src="<?php echo esc_url($hero); ?>" alt="eabcdev-logo">
          </div>
        </div>
        <div class="eabcdev-home-base">
          <h1>EABCDEV</h1>
          <p>Gamer, Rider, Coder.</p>
          <article class="eabcdev-home-latest-projects">
            <h1>My latest projects:</h1>
          </article>
        </div>
      </section>
    </section>
  </section>
</section>
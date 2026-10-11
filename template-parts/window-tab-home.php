<?php
  if (!defined('ABSPATH')) {
    exit;
  }
  $colored = $args['colored'];
  $hero = get_theme_file_uri('assets/images/hero.png')
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
          <div class="eabcdev-home-latest-list">
            
          </div>
          <h1 class="eabcdev-home-latest-tag">Latest projects:</h1>
        </section>
      </section>
    </section>
  </section>
</section>
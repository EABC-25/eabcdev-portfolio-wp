<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<?php get_header(); ?>
<section class="window">
    <?php get_template_part('template-parts/window-tab', 'project', [
        'colored' => true
    ]); ?>       
    <section class="window-tab">
    </section>
    <section class="window-tab">
    </section>
</section>

<?php get_footer(); ?>
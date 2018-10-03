<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php if(get_field('page_intro_title') || get_field('page_intro')): ?>
        <article class="brief">
          <h2 class="underline-header"><?php the_field('page_intro_title'); ?></h2>
          <?php the_field('page_intro'); ?>
        </article>
      <?php endif; ?>

      <?php
        $partners = new WP_Query(array(
          'post_type' => 'staff',
          'posts_per_page' => -1,
          'post_status' => 'publish',
          'category_name' => 'partners'
        ));
        if($partners->have_posts()): ?>
          <section class="staff">
            <h2>Partners</h2>
            <div class="row">
              <?php $p = 0; while($partners->have_posts()): $partners->the_post(); ?>
                <?php if($p % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                <?php get_template_part('partials/attorney-summary', 'loop'); ?>
              <?php $p++; endwhile; ?>
            </div>
          </section>
      <?php endif; wp_reset_postdata(); ?>

      <?php 
        $associates = new WP_Query(array(
          'post_type' => 'staff',
          'posts_per_page' => -1,
          'post_status' => 'publish',
          'category_name' => 'associates'
        ));
        if($associates->have_posts()): ?>
          <section class="staff">
            <h2>Associates</h2>
            <div class="row">
              <?php $a = 0; while($associates->have_posts()): $associates->the_post(); ?>
                <?php if($a % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                <?php get_template_part('partials/attorney-summary', 'loop'); ?>
              <?php $a++; endwhile; ?>
            </div>
          </section>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </main>
<?php get_footer(); ?>
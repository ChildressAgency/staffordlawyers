<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-7">
          <?php get_search_form(); ?>

          <?php if(get_field('first_section_title') || get_field('first_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('first_section_title'); ?></h2>
              <?php the_field('first_section_content'); ?>
            </article>
          <?php endif; ?>
        </div>
        <div class="col-sm-5">
          <?php get_template_part('partials/consultation', 'form'); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <img src="<?php the_field('team_image'); ?>" class="img-responsive" style="margin-top:40px;" alt="Stafford Lawyers" />
        </div>
        <div class="col-sm-5">
          <?php if(get_field('second_section_title') || get_field('second_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('second_section_title'); ?></h2>
              <?php the_field('second_section_content'); ?>
            </article>
            <a href="<?php echo home_url('attorneys'); ?>" class="btn-main">Learn About Our Attorneys</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>

  <?php 
    $practice_areas = get_field('practice_areas');
    if($practice_areas): ?>
      <section id="practice-areas">
        <div class="container">
          <h2>Practice Areas</h2>
          <div class="row">
            <?php foreach($practice_areas as $practice_area): ?>

              <div class="col-sm-6 col-md-4">
                <div class="practice-area" style="background-image:url(<?php echo get_the_post_thumbnail_url($practice_area->ID, 'full'); ?>); <?php echo get_field('featured_image_css', $practice_area->ID); ?>">
                  <h3><?php echo get_the_title($practice_area->ID); ?></h3>
                  <a href="<?php echo get_the_permalink($practice_area->ID); ?>" class="btn-main btn-alt">Learn More</a>
                  <div class="practice-area-overlay"></div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>
          <a href="#" class="view-all">View All</a>
        </div>
      </section>
  <?php endif; ?>

  <section id="hp-contact">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <?php if(get_field('third_section_title') || get_field('third_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('third_section_title'); ?></h2>
              <?php the_field('third_section_content'); ?>
            </article>
            <a href="<?php echo home_url('contact-us'); ?>" class="btn-main">Contact Us</a>
          <?php endif; ?>
        </div>
        <div class="col-sm-6">
          <?php if(get_field('google_map_iframe', 'option')): ?>
            <div class="embed-responsive embed-responsive-4by3">
              <?php the_field('google_map_iframe', 'option'); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php
    $recent_posts = new WP_Query(array('posts_per_page' => 3, 'post_status' => 'publish'));
    if($recent_posts->have_posts()): ?>
      <section id="blog-posts">
        <div class="container">
          <h2>Blog Posts</h2>
          <?php
            while($recent_posts->have_posts()): 
              $recent_posts->the_post();
              get_template_part('partials/post-summary', 'loop');
            endwhile;
          ?>
          <a href="<?php echo home_url('blog'); ?>" class="view-more">View More Posts</a>
        </div>
      </section>
  <?php endif; wp_reset_postdata(); ?>
<?php get_footer(); ?>
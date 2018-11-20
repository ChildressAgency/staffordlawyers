<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article>
          <?php the_post_thumbnail('full', array('class' => 'img-responsive center-block')); ?>
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
          <a href="<?php echo home_url('attorneys-staff'); ?>" class="btn-main">Meet Our Attorneys</a>
        </article>
      <?php endwhile; else: ?>
        <p>Sorry, the page you were looking for was not found.</p>
      <?php endif; ?>
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

<?php get_footer(); ?>
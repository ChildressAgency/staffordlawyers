<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <?php
        $practice_areas = new WP_Query(array(
          'post_type' => 'practice_areas',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        ));

        if($practice_areas->have_posts()): ?>
          <section id="areas-of-practice">
            <div class="row">
              <?php $pa = 0; while($practice_areas->have_posts()): $practice_areas->the_post(); ?>
                <?php if($pa % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                <div class="col-sm-6">
                  <?php 
                    $area_title = get_the_title(); 
                    $area_slug = sanitize_title($area_title);

                    $area_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                  ?>
                  <article class="pic-accordion">
                    <a href="#<?php echo $area_slug; ?>" class="pic-accordion-title collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?php echo $area_slug; ?>" style="background-image:url(<?php echo $area_image; ?>);">
                      <h2><?php echo $area_title; ?></h2>
                      <span class="click-to-open">click to open<i class="fas fa-angle-down"></i></span>
                      <div class="pic-accordion-overlay"></div>
                    </a>
                    <div id="<?php echo $area_slug; ?>" class="collapse">
                      <a href="#<?php echo $area_slug; ?>" class="pic-accordion-title-2 collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?php echo $area_slug; ?>">
                        <?php echo $area_title; ?>
                      </a>
                      <div class="pic-accordion-body">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn-main">Learn More</a>
                      </div>
                    </div>
                  </article>
                </div>
              <?php $pa++; endwhile; ?>
            </div>
          </section>
      <?php endif; ?>

      <?php get_template_part('partials/consultation', 'form'); ?>
    </div>
  </main>
<?php get_footer(); ?>
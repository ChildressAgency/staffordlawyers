<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>
    </div>
  </main>

  <?php if(have_rows('testimonials')): ?>
    <section id="client-reviews" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/up-columns.jpg); background-position:bottom center; background-size:contain;">
      <div class="container">
        <?php while(have_rows('testimonials')): the_row(); ?>
          <div class="client-review">
            <?php the_sub_field('testimonial'); ?>
            <cite>&mdash;<?php the_sub_field('testimonial_author'); ?></cite>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endif; ?>
<?php get_footer(); ?>
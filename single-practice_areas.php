<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article>
          <?php the_post_thumbnail('full', array('class' => 'img-responsive center-block')); ?>
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
        </article>
      <?php endwhile; else: ?>
        <p>Sorry, the page you were looking for was not found.</p>
      <?php endif; ?>
    </div>
  </main>
  <?php 
    $practice_areas_page = get_page_by_path('practice_areas');
    $practice_areas_page_id = $practice_areas_page->ID;
    if(get_field('ready_to_contact_section_title', $practice_areas_page_id) || get_field('ready_to_contact_section', $practice_areas_page_id)): ?>
      <section id="ready-to-contact" style="background-image:url(<?php the_field('ready_to_contact_section_image', $practice_areas_page_id); ?>); <?php the_field('ready_to_contact_section_image_css', $practice_areas_page_id); ?>">
        <div class="container">
          <div class="section-caption">
            <h3><?php the_field('ready_to_contact_section_title', $practice_areas_page_id); ?></h3>
            <?php the_field('ready_to_contact_section', $practice_areas_page_id); ?>
            <a href="<?php echo home_url('contact-us'); ?>" class="btn-main">Contact Us</a>
          </div>
        </div>
        <div class="overlay"></div>
      </section>
  <?php endif; ?>
<?php get_footer(); ?>
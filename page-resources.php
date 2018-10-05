<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <?php if(have_rows('resources_sections')): while(have_rows('resources_sections')): the_row(); ?>
        <section class="resources">
          <h2><?php the_sub_field('resource_section_title'); ?></h2>
          <?php $resource_section_image = get_field('resource_section_image'); ?>
          <img src="<?php echo $resource_section_image['url']; ?>" class="img-responsive center-block" alt="<?php echo $resource_section_image['alt']; ?>" />
          <?php the_sub_field('resource_section_content'); ?>
        </section>
      <?php endwhile; endif; ?>

    </div>
  </main>
<?php get_footer(); ?>
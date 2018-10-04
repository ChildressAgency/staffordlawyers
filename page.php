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
<?php get_footer(); ?>
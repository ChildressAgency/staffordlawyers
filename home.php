<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>
      <h2>Blog Posts</h2>
      <?php
        if(have_posts()){
          while(have_posts()){
            the_post();
            get_template_part('partials/post-summary', 'loop');
          }
        }
        else{
          echo '<p>Sorry, there is nothing to display.</p>';
        } wp_pagenavi();
      ?>
    </div>
  </main>
<?php get_footer(); ?>
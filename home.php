<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <h2>Blog Posts</h2>
      <?php
        if(have_posts()){
          while(have_posts()){
            the_post();
            get_template_part('partials/post-summary', 'loop');
          }
        }
        else{
          echo '<p>Sorry, there are currently no blog posts.</p>';
        }
      ???>
    </div>
  </main>
<?php get_footer(); ?>
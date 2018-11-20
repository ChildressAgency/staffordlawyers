<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>
      
      <?php
        if(have_posts()){
          if(is_singular()){
            while(have_posts()){
              the_post();

              echo '<article>';
              the_post_thumbnail('full', array('class' => 'img-responsive center-block'));
              echo '<h2>' . get_the_title() . '</h2>';
              the_content();
              echo '</article>';
            }
          }
          else{
            while(have_posts()){
              the_post();
              
              get_template_part('partials/post-summary', 'loop');
            }
          }
        }
        else{
          echo '<p>Sorry, there are no posts in this category.</p>';
        }
      ?>
    </div>
  </main>
<?php get_footer(); ?>
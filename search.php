<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <h2>Showing results for <?php echo get_search_query(); ?></h2>
      <?php 
        if(have_posts()){
          while(have_posts()){
            the_post();

            get_template_part('partials/post-summary', 'loop');
          }
        }
        else{
          echo '<p>Sorry, no results were found.</p>';
        } wp_pagenavi();
      ?>
    </div>
  </main>
<?php get_footer(); ?>
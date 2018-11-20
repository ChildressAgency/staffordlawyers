<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article class="blog-post">
          <?php the_post_thumbnail('full', array('class' => 'img-responsive center-block')); ?>
          <header class="post-header">
            <h2><?php the_title(); ?></h2>
            <?php get_template_part('partials/post-header', 'meta'); ?>
          </header>
          <?php the_content(); ?>
          <footer class="post-footer">
            <?php 
              if(get_the_tag_list()){
                echo get_the_tag_list('<p class="tag-list">#', ', #', '</p>');
              }
            ?>
            <div class="share">
              <p>Share:</p>
              <?php 
                if(function_exists('ADDTOANY_SHARE_SAVE_KIT')){
                  ADDTOANY_SHARE_SAVE_KIT(array('user_current_page' => true));
                }
              ?>
            </div>
          </footer>
        </article>
      <?php endwhile; endif; ?>
    </div>
  </main>
<?php get_footer(); ?>
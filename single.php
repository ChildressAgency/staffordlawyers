<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <?php
        $most_recent_post = new WP_Query(array(
          'posts_per_page' => 1,
          'post_status' => 'publish'
        ));
        $skip_posts = [];
        if($most_recent_post->have_posts()): while($most_recent_post->have_posts()): $most_recent_post->the_post(); ?>
          <?php $skip_posts[] = get_the_ID(); ?>
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

      <section id="previous-next-posts">
        <div class="row">
          <div class="col-sm-6">
            <?php 
              $adjacent_post = get_previous_post();
              if(!empty($adjacent_post)){
                include(locate_template('partials/post-summary-block.php', false, false));
                $skip_posts[] = $adjacent_post->ID;
              }
            ?>
          </div>
          <div class="col-sm-6">
            <?php
              $adjacent_post = get_next_post();
              if(!empty($adjacent_post)){
                include(locate_template('partials/post-summary-block.php', false, false));
                $skip_posts[] = $adjacent_post->ID;
              }
            ?>
          </div>
        </div>
      </section>

      <?php
        $more_posts = new WP_Query(array(
          'posts_per_page' => 3,
          'post_status' => 'publish',
          'post__not_in' => $skip_posts
        ));
        if($more_posts->have_posts()): ?>
          <section id="blog-posts">
            <div class="container">
              <h2>Blog Posts</h2>
              <?php 
                while($more_posts->have_posts()): 
                  $more_posts->the_post();
                  get_template_part('partials/post-summary', 'loop');
                endwhile;
              ?>
              <a href="<?php echo home_url('blog'); ?>" class="view-more">View More Posts</a>
            </div>
          </section>
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </main>
<?php get_footer(); ?>
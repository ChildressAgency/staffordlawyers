<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <div class="panel-group" id="library" role="tablist" aria-multiselectable="true">
        <?php
          $library_article_types = get_terms(array('taxonomy', => 'staff'));

          if($library_article_types):
            foreach($library_article_types as $article_type):
              $articles = new WP_Query(array(
                'post_type' => 'library',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'category_name' => $article_type->slug
              ));

              if($articles->have_posts()): ?>

                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="<?php echo $article_type->slug; ?>-heading">
                    <h2 class="panel-title">
                      <a href="#<?php echo $article_type->slug; ?>-library" role="button" data-toggle="collapse" data-parent="#library" aria-expanded="false" aria-controls="<?php echo $article_type->slug; ?>-library" class="collapsed">
                        <span><?php echo $article_type->name; ?></span>
                      </a>
                    </h2>
                  </div>
                  <div id="<?php echo $article_type->slug; ?>-library" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $article_type->slug; ?>-heading">
                    <div class="panel-body<?php echo ($articles->post_count > 1) ? ' slider-panel' : ''; ?>">
                      <?php while($articles->have_posts()): the_post(); ?>
                        <article class="blog-post">
                          <?php
                            if(has_post_thumbnail()){
                              the_post_thumbnail('full', array('class' => 'img-responsive center-block'));
                            }
                          ?>
                          <header class="post-header">
                            <h2><?php the_title(); ?></h2>
                            <?php get_template_part('partials/post-header', 'meta'); ?>
                          </header>
                          <?php the_excerpt(); ?>
                          <a href="<?php the_permalink(); ?>" class="btn-main">Read More</a>
                        </article>                       
                      <?php endwhile; ?>
                    </div>
                  </div>
                </div>

              <?php endif; 
            endforeach;
          endif;
        ?>
      </div>
    </div>
  </main>
<?php get_footer(); ?>
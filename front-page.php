<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-7">
          <div class="search-form">
            <?php get_search_form(); ?>
          </div>

          <?php if(get_field('first_section_title') || get_field('first_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('first_section_title'); ?></h2>
              <?php the_field('first_section_content'); ?>
            </article>
          <?php endif; ?>
        </div>
        <div class="col-sm-5">
          <?php echo do_shortcode('[schedule-consultation-contact-form]'); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <img src="<?php the_field('team_image'); ?>" class="img-responsive" style="margin-top:40px;" alt="Stafford Lawyers" />
        </div>
        <div class="col-sm-5">
          <?php if(get_field('second_section_title') || get_field('second_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('second_section_title'); ?></h2>
              <?php the_field('second_section_content'); ?>
            </article>
            <a href="<?php echo home_url('attorneys'); ?>" class="btn-main">Learn About Our Attorneys</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>

  <?php 
    $practice_areas = get_field('practice_areas');
    if($practice_areas): ?>
      <section id="practice-areas">
        <div class="container">
          <h2>Practice Areas</h2>
          <div class="row">
            <?php foreach($practice_areas as $practice_area): ?>

              <div class="col-sm-6 col-md-4">
                <div class="practice-area" style="background-image:url(<?php echo get_the_post_thumbnail_url($practice_area->ID, 'full'); ?>); <?php echo get_field('featured_image_css', $practice_area->ID); ?>">
                  <h3><?php echo get_the_title($practice_area->ID); ?></h3>
                  <a href="<?php echo get_the_permalink($practice_area->ID); ?>" class="btn-main btn-alt">Learn More</a>
                  <div class="practice-area-overlay"></div>
                </div>
              </div>

            <?php endforeach; ?>
          </div>
          <a href="#" class="view-all">View All</a>
        </div>
      </section>
  <?php endif; ?>

  <section id="hp-contact">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <?php if(get_field('third_section_title') || get_field('third_section_content')): ?>
            <article class="brief narrow-brief">
              <h2 class="underlined-header"><?php the_field('third_section_title'); ?></h2>
              <?php the_field('third_section_content'); ?>
            </article>
            <a href="<?php echo home_url('contact-us'); ?>" class="btn-main">Contact Us</a>
          <?php endif; ?>
        </div>
        <div class="col-sm-6">
          <?php if(get_field('google_map_iframe', 'option')): ?>
            <div class="embed-responsive embed-responsive-4by3">
              <?php the_field('google_map_iframe', 'option'); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <section id="blog-posts">
    <div class="container">
      <h2>Blog Posts</h2>

      <div class="row">
        <div class="col-sm-5">
          <img src="images/lawyer-family.jpg" class="img-responsive center-block" alt="" />
        </div>
        <div class="col-sm-7">
          <div class="post-summary">
            <h3>Is child custody law in Virginia unfair to fathers?</h3>
            <p class="post-meta">Posted on March 26, 2012 by <a href="#">Ken Hodge</a> in <a href="#">Blog</a></p>
            <p class="post-excerpt">"In determining custody, the court shall give primary consideration to the best interests of the child. The court shall assure minor children of frequent and continuing contact with both parents, when appropriate, and encourage parents to share in the responsibilities of rearing...</p>
            <a href="#" class="btn-main">Read More</a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-5">
          <img src="images/hands-folded-meeting.jpg" class="img-responsive center-block" alt="" />
        </div>
        <div class="col-sm-7">
          <div class="post-summary">
            <h3>"Separate property" in divorce may become marital</h3>
            <p class="post-meta">Posted on March 26, 2012 by <a href="#">Ken Hodge</a> in <a href="#">Blog</a></p>
            <p class="post-excerpt">Ken Hodge recently wrote an article outlining how separate property, i.e., property owned by one spouse prior to the marriage, can be treated by the Court as marital property to the extent that it increased in value during the marriage. This is an aspect of Virginia divorce law that...</p>
            <a href="#" class="btn-main">Read More</a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-5">
          <img src="images/family.jpg" class="img-responsive center-block" alt="" />
        </div>
        <div class="col-sm-7">
          <div class="post-summary">
            <h3>Benefits of settling child custody cases outside of court</h3>
            <p class="post-meta">Posted on May 5, 2010 by <a href="#">Ken Hodge</a> in <a href="#">Blog</a></p>
            <p class="post-excerpt">Some people think it strange to hear an attorney talk about the benefits of staying out of court. But in child custody and visitation caes, it is absolutely essential that the client consider the risks and costs associated with litigation, and also the possible benefits of resolving...</p>
            <a href="#" class="btn-main">Read More</a>
          </div>
        </div>
      </div>

      <a href="#" class="view-more">View More Posts</a>
    </div>
  </section>
<?php get_footer(); ?>
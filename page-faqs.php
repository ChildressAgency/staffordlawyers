<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php 
        if(get_field('page_intro_title') || get_field('page_intro')): ?>
          <article class="brief">
            <h2 class="underlined-header"><?php the_field('page_intro_title'); ?></h2>
            <?php the_field('page_intro'); ?>
          </article>
      <?php endif; ?>

      <section id="intro-search">
        <?php get_search_form(); ?>
      </section>

      <?php if(have_rows('faq_sections')): ?>
        <div class="faqs">
          <?php while(have_rows('faq_sections')): the_row(); ?>
            <section class="pic-accordion">
              <?php 
                $section_title = get_sub_field('faq_section_title'); 
                $section_slug = sanitize_title($section_title);
              ?>
              <a href="#<?php echo $section_slug; ?>" class="pic-accordion-title collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?php echo $section_slug; ?>" style="background-image:url(<?php the_sub_field('faq_section_image'); ?>); <?php the_sub_field('faq_section_image_css'); ?>">
                <h2><?php echo $section_title; ?></h2>
                <span class="click-to-open">click to open<i class="fas fa-angle-down"></i></span>
                <div class="pic-accordion-overlay"></div>
              </a>
              <div class="panel-group collapse" id="<?php echo $section_slug; ?>" role="tablist" aria-multiselectable="true">
                <a href="#<?php echo $section_slug; ?>" class="pic-accordion-title-2 collapsed" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?php echo $section_slug; ?>">
                  <?php echo $section_title; ?>
                </a>

                <?php if(have_rows('faqs')): $f = 0; while(have_rows('faqs')): the_row(); ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="<?php echo $section_slug; ?>-q-<?php echo $f; ?>">
                      <h3 class="panel-title">
                        <a href="#<?php echo $section_slug; ?>-a-<?php echo $f; ?>" role="button" data-toggle="collapse" data-parent="#<?php echo $section_slug; ?>" aria-expanded="false" aria-controls="<?php echo $section_slug; ?>-a-<?php echo $f; ?>" class="collapsed">
                          <span><?php the_sub_field('question'); ?></span>
                        </a>
                      </h3>
                    </div>
                    <div id="<?php echo $section_slug; ?>-a-<?php echo $f; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $section_slug; ?>-q-<?php echo $f; ?>">
                      <div class="panel-body">
                        <?php the_sub_field('answer'); ?>
                      </div>
                    </div>
                  </div>
                <?php $f++; endwhile; endif; ?>

              </div>
            </section>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>

      <section id="request-appointment">
        <?php echo do_shortcode('[request_consultation_form]'); ?>
      </section>
    </div>
  </main>
<?php get_footer(); ?>
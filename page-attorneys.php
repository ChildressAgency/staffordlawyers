<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials/page-intro', 'block'); ?>

      <?php
        $partners = new WP_Query(array(
          'post_type' => 'staff',
          'posts_per_page' => -1,
          'post_status' => 'publish',
          'category_name' => 'partners'
        ));
        if($partners->have_posts()): ?>
          <section class="staff">
            <h2>Partners</h2>
            <div class="row">
              <?php $p = 0; while($partners->have_posts()): $partners->the_post(); ?>
                <?php if($p % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                <?php get_template_part('partials/attorney-summary', 'loop'); ?>
              <?php $p++; endwhile; ?>
            </div>
          </section>
      <?php endif; wp_reset_postdata(); ?>

      <?php 
        $associates = new WP_Query(array(
          'post_type' => 'staff',
          'posts_per_page' => -1,
          'post_status' => 'publish',
          'category_name' => 'associates'
        ));
        if($associates->have_posts()): ?>
          <section class="staff">
            <h2>Associates</h2>
            <div class="row">
              <?php $a = 0; while($associates->have_posts()): $associates->the_post(); ?>
                <?php if($a % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                <?php get_template_part('partials/attorney-summary', 'loop'); ?>
              <?php $a++; endwhile; ?>
            </div>
          </section>
      <?php endif; wp_reset_postdata(); ?>

      <?php
        $partners_term = get_term_by('slug', 'partners', 'staff');
        $associates_term = get_term_by('slug', 'associates', 'staff');
        $skip_staff_type[] = $partners_term->term_id;
        $skip_staff_type[] = $associates_term->term_id;

        $other_staff_types = get_terms(array(
          'taxonomy' => 'staff',
          'exclude' => $skip_staff_type
        ));

        if($other_staff_types):
          foreach($other_staff_types as $staff_type):
            $staff = new WP_Query(array(
              'post_type' => 'staff',
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'category_name' => $staff_type->slug
            ));

            if($staff_type->have_posts()): ?>
              <section class="staff">
                <h2><?php echo $staff_type->name; ?></h2>
                <div class="row">
                  <?php $st = 0; while($staff_type->have_posts()): $staff_type->the_post(); ?>
                    <?php if($st % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                    <?php get_template_part('partials/attorney-summary', 'loop'); ?>
                  <?php $st++; endwhile; ?>
                </div>
              </section>
            <?php endif; wp_reset_postdata(); ?>
      <?php endforeach; endif; ?>
    </div>
  </main>
<?php get_footer(); ?>
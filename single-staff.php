<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
  <main id="main">
    <div class="container">
      <article class="attorney-profile">
        <h2><?php the_title(); ?></h2>
        <div class="row">
          <div class="col-sm-5">
            <?php 
              if(has_post_thumbnail()){
                the_post_thumbnail('full', array('class' => 'img-responsive'));
              }
              else{
                echo '<img src="' . get_stylesheet_directory_uri() . '/images/image_coming_soon.png" class="img-responsive" alt="' . get_the_title() . '" />';
              }
            ?>
            <table class="attorney-contact-info">
              <tbody>
                  <tr>
                    <th scope="row">Address:</th>
                    <td><?php 
                      echo get_field('staff_address1') ? get_field('staff_address1') : get_field('address1', 'option') .'<br />';
                      echo get_field('staff_address2') ? get_field('staff_address2') : get_field('address2', 'option') . '<br />';
                      echo get_field('staff_city_state_zip') ? get_field('staff_city_state_zip') : get_field('city_state_zip', 'option'); ?>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">Phone:</th>
                    <td><?php echo get_field('staff_phone') ? get_field('staff_phone') : get_field('phone', 'option'); ?></td>
                  </tr>
                <?php if(get_field('staff_email')): ?>
                  <tr>
                    <th scope="row">Email:</th>
                    <td><a href="mailto:<?php the_field('staff_email'); ?>"><?php the_field('staff_email'); ?></a></td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="col-sm-7">
            <?php if(have_rows('staff_profile_fields')): while(have_rows('staff_profile_fields')): the_row(); ?>
              <h3><?php the_sub_field('profile_field_title'); ?></h3>
              <?php the_sub_field('profile_field_content'); ?>
            <?php endwhile; endif; ?>
          </div>
        </div>
      </article>
    </div>
  </main>

  <?php if(have_rows('staff_member_testimonials')): ?>
    <section id="client-reviews" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/columns.jpg); background-position:left center;">
      <div class="container">
        <h2>Client Reviews</h2>
        <?php while(have_rows('staff_member_testimonials')): the_row(); ?>
          <div class="client-review">
            <?php the_sub_field('staff_member_testimonial'); ?>
            <cite>&mdash;<?php the_sub_field('staff_member_testimonial_author'); ?></cite>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endif; ?>

<?php endwhile; else: ?>
  <p>Sorry, this staff member does not have a profile setup yet.</p>
<?php endif; ?>
<?php get_footer(); ?>
<div class="col-sm-6">
  <div class="attorney">
    <div class="row">
      <div class="col-sm-6">
        <?php 
          if(has_post_thumbnail()){
            the_post_thumbnail('full', array('class' => 'img-responsive'));
          }
          else{
            echo '<img src="' . get_stylesheet_directory_uri() . '/images/profile-placeholder.jpg" class="img-responsive" alt="' . get_the_title() . '" />';
          }
        ?>
      </div>
      <div class="col-sm-6">
        <div class="attorney-summary">
          <h3><?php the_title(); ?></h3>
            <p>
              <?php 
                echo get_field('staff_address1') ? get_field('staff_address1') : get_field('address1', 'option') . '<br />'; 
                echo get_field('staff_address2') ? get_field('staff_address2') : get_field('address2', 'option') . '<br />';
                echo get_field('staff_city_state_zip') ? get_field('staff_city_state_zip') : get_field('city_state_zip', 'option');
              ?>
            </p>
          <p><?php echo get_field('staff_phone') ? get_field('staff_phone') : get_field('phone', 'option'); ?></p>
          <?php if(get_field('staff_email')): ?>
            <p><a href="mailto:<?php the_field('staff_email'); ?>"><?php the_field('staff_email'); ?></a></p>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="btn-main">Profile Page</a>
        </div>
      </div>
    </div>
  </div>
</div>

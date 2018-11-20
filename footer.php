  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <h3>Browse our Site</h3>
          <?php 
            $footer_nav_args = array(
              'theme_location' => 'footer-nav', 
              'menu' => '',
              'container' => 'nav',
              'container_id' => 'footer-nav',
              'container_class' => '',
              'menu_class' => 'footer-menu list-unstyled',
              'menu_id' => '',
              'echo' => true,
              'fallback_cb' => 'staffordlawyers_footer_fallback_menu',
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth' => 1,
              'walker' => new wp_bootstrap_navwalker()
            );
            wp_nav_menu($footer_nav_args);
          ?>
        </div>
        <div class="col-sm-4">
          <h3>Contact Us</h3>
          <p><?php the_field('company_name', 'option'); ?></p>
          <p><?php the_field('address_1', 'option'); ?><br /><?php the_field('address_2', 'option'); ?><br /><?php the_field('city_state_zip', 'option'); ?></p>
          <p><strong>Phone: </strong><?php the_field('phone', 'option'); ?><br /><strong>Fax: </strong><?php the_field('fax', 'option'); ?></p>
          <p><a href="<?php echo home_url('disclaimer'); ?>">Click here</a> to view the disclaimer.</p>
        </div>
        <div class="col-sm-4">
          <h3>Follow Us</h3>
          <div class="social">
            <?php if(get_field('facebook', 'option')): ?>
              <a href="<?php the_field('facebook', 'option'); ?>" class="facebook text-hide" target="_blank">Facebook<i class="fab fa-facebook"></i></a>
            <?php endif; if(get_field('twitter', 'option')): ?>
              <a href="<?php the_field('twitter', 'option'); ?>" class="twitter text-hide" target="_blank">Twitter<i class="fab fa-twitter"></i></a>
            <?php endif; if(get_field('google_plus', 'option')): ?>
              <a href="<?php the_field('google_plus', 'option'); ?>" class="google-plus text-hide" target="_blank">Google+<i class="fab fa-google-plus-g"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <p class="copyright">&copy; <?php echo date('Y'); ?> <?php the_field('company_name', 'option'); ?> | All Right Reserved | Web Design by <a href="https://childressagency.com" target="blank">the Childress Agency</a></p>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>

</html>
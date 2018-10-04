<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <article class="brief">
        <h2 class="underlined-header">Contact Us</h2>
        <h3><?php the_field('company_name', 'option'); ?></h3>
        <table class="attorney-contact-info">
          <tbody>
            <?php if(get_field('address1', 'option') || get_field('city_stat_zip', 'option')): ?>
              <tr>
                <th scope="row">Address:</th>
                <td><?php 
                  echo get_field('address1', 'option') ? get_field('address1', 'option') . '<br />' : '';
                  echo get_field('address2', 'option') ? get_field('address2', 'option') . '<br />' : '';
                  echo get_field('city_state_zip', 'option') ? get_field('city_state_zip') : ''; ?>
                </td>
              </tr>
            <?php endif; ?>
            <?php if(get_field('phone', 'option')): ?>
              <tr>
                <th scope="row">Phone:</th>
                <td><?php the_field('phone', 'option'); ?></td>
              </tr>
            <?php endif; ?>
            <?php if(get_field('fax', 'option')): ?>
              <tr>
                <th scope="row">Fax:</th>
                <td><?php the_field('fax', 'option'); ?></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </article>

      <?php if(get_field('google_map_iframe')): ?>
        <section id="google-map">
          <div class="embed-responsive embed-responsive-4by3">
            <?php the_field('google_map_iframe'); ?>
          </div>
        </section>
      <?php endif; ?>

      <section id="contact-form">
        <h2>Contact Us</h2>
        <?php
          if(have_posts()){
            while(have_posts()){
              the_post();
              the_content();
            }
          }
        ?>
      </section>
    </div>
  </main>
<?php get_footer(); ?>
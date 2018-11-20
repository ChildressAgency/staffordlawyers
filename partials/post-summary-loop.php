<div class="row blog-post">
  <div class="col-sm-5">
    <?php the_post_thumbnail('full', array('class' => 'img-responsive center-block')); ?>
  </div>
  <div class="col-sm-7">
    <div class="post-summary">
      <h3><?php the_title(); ?></h3>
      <?php get_template_part('partials/post-header', 'meta'); ?>
      <div class="post-excerpt"><?php the_excerpt(); ?></div>
      <a href="<?php the_permalink(); ?>" class="btn-main">Read More</a>
    </div>
  </div>
</div>

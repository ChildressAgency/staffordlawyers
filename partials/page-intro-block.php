<?php if(get_field('page_intro_title') || get_field('page_intro')): ?>
  <article class="brief">
    <h2 class="underline-header"><?php the_field('page_intro_title'); ?></h2>
    <?php the_field('page_intro'); ?>
  </article>
<?php endif; ?>

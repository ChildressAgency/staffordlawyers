<?php 
if(is_home() || is_archive()){
  $intro_page = get_page_by_path('blog');
}
else if(is_single('practice_areas')){
  $intro_page = get_page_by_path('practice-areas');
}
else if(is_single('library')){
  $intro_page = get_page_by_path('library');
}

if(isset($intro_page) && $intro_page !== ''){
  $intro_page_id = $intro_page->ID;
}
else{
  $intro_page_id = get_the_ID();
}

if(get_field('page_intro_title', $intro_page_id) || get_field('page_intro', $intro_page_id)): ?>
  <article class="brief">
    <h2 class="underlined-header"><?php the_field('page_intro_title', $intro_page_id); ?></h2>
    <?php the_field('page_intro', $intro_page_id); ?>
  </article>
<?php endif; ?>

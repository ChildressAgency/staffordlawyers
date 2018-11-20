<article class="blog-post">
  <?php echo get_the_post_thumbnail($adjacent_post->ID, 'full', array('class' => 'img-responsive center-block')); ?>
  <header class="post-header">
    <h2><?php echo $adjacent_post->post_title; ?></h2>
    <?php
      $adjacent_post_date = get_the_date('F j, Y', $adjacent_post->ID);
      $adjacent_post_author_archive_link = get_author_posts_url($adjacent_post->post_author);
      $adjacent_post_author_name = get_the_author_meta('display_name', $adjacent_post->post_author);

      $adjacent_post_cats = get_the_category($adjacent_post->ID);
      $adjacent_post_cat_links = [];
      foreach($adjacent_post_cats as $adjacent_post_cat){
        $adjacent_post_cat_links[] = '<a href="' . get_category_link($adjacent_post_cat) . '">' . $adjacent_post_cat->name . '</a>';
      }
      $adjacent_post_cats_list = implode(', ', $adjacent_post_cat_links);
    ?>
    <p>Posted on <?php echo $adjacent_post_date; ?> by <a href="<?php echo $adjacent_post_author_archive_link; ?>"><?php echo $adjacent_post_author_name; ?></a> in <?php echo $adjacent_post_cats_list; ?></p>
  </header>
  <?php echo $adjacent_post->post_excerpt; ?>
  <a href="<?php echo get_permalink($adjacent_post->ID); ?>" class="read-article">Read Article.</a>
  <footer class="post-footer">
    <?php 
      if(get_the_tag_list('', '', '', $adjacent_post->ID)){
        echo get_the_tag_list('<p class="tag-list">#', ', #', '</p>', $adjacent_post->ID);
      }
    ?>
  </footer>
</article>

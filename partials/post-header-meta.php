<?php 
  $cur_cats = get_the_category();
  $cur_cat_name = $cur_cats[0]->name;
  $cur_cat_id = $cur_cats[0]->ID;
  $cur_cat_archive_link = get_category_link($cur_cat_id);
  $post_date = get_the_date();
  $author_archive_link = get_author_posts_url(get_the_author_meta('ID'));
?>
<p class="post-meta">Posted on <?php echo $post_date; ?> by <a href="<?php echo author_archive_link; ?>"><?php the_author(); ?></a> in <a href="<?php echo $cur_cat_archive_link; ?>"><?php echo $cur_cat_name; ?></a></p>

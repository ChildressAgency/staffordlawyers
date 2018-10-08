<?php 
  if(is_post_type_archive()){
    //$post_type = get_post_type();
    //var_dump(get_queried_object());
    $post_taxonomy = get_post_taxonomies();
    $post_tax = $post_taxonomy[0];
    $cur_cats = get_the_terms(get_the_ID(), $post_tax);

    $cat_links = [];
    foreach($cur_cats as $cur_cat){
      $cat_links[] = '<a href="' . get_term_link($cur_cat) . '">' . $cur_cat->name . '</a>';
    }
    $cat_list = implode(', ', $cat_links);
  }
  else{
    $cur_cats = get_the_category();

    $cat_links = [];
    foreach($cur_cats as $cur_cat){
      $cat_links[] = '<a href="' . get_category_link($cur_cat->ID) . '">' . $cur_cat->name . '</a>';
    }

    $cat_list = implode(', ', $cat_links);
  }

  $post_date = get_the_date();
  $author_archive_link = get_author_posts_url(get_the_author_meta('ID'));
?>
<p class="post-meta">Posted on <?php echo $post_date; ?> by <a href="<?php echo $author_archive_link; ?>"><?php the_author(); ?></a> in <?php echo $cat_list; ?></p>

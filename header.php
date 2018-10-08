<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <title><?php echo get_bloginfo('name'); ?></title>

  <?php wp_head(); ?>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body <?php body_class(); ?>>
  <div class="masthead">
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          <a href="<?php echo home_url(); ?>" class="brand-logo">
            <?php
              if(function_exists('the_custom_logo')){
                $custom_logo_id = get_theme_mod('custom_logo');
                $custom_logo = wp_get_attachment_image_src($custom_logo_id, 'full');
              }
            ?>
            <img src="<?php echo $custom_logo[0]; ?>" class="img-responsive center-block" alt="Logo" />
          </a>
        </div>
        <div class="col-sm-10">
          <h1 class="brand-title"><?php the_field('company_name', 'option'); ?><small>Attorneys At Law</small></h1>
        </div>
      </div>
    </div>
  </div>
  <nav id="header-nav">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <?php
        $header_nav_args = array(
          'theme_location' => 'header-nav',
          'menu' => '',
          'container' => 'div',
          'container_id' => 'navbar',
          'container_class' => 'navbar-collapse collapse',
          'menu_class' => 'nav nav-justified',
          'menu_id' => '',
          'echo' => true,
          'fallback_cb' => 'staffordlawyers_header_fallback_menu',
          'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth' => 2,
          'walker' => new wp_bootstrap_navwalker()
        );
        wp_nav_menu($header_nav_args);
      ?>
    </div>
  </nav>

<?php if(is_front_page() && get_field('hero_carousel')): ?>
  <?php $hero_carousel = get_field('hero_carousel'); ?>

  <div id="hero-carousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="hover">
    <?php if(count($hero_carousel) > 1): ?>
      <ol class="carousel-indicators">
        <?php for($i = 0; $i < count($hero_carousel); $i++): ?>
          <li data-target="#hero-carousel" data-slide-to="<?php echo $i; ?>"<?php if($i == 0){ echo ' class="active"'; } ?>></li>
        <?php endfor; ?>
      </ol>
    <?php endif; ?>

    <div class="carousel-inner" role="listbox">

      <?php $c = 0; foreach($hero_carousel as $slide): ?>
        <div class="item<?php if($c==0){ echo ' active'; } ?>" style="background-image:url(<?php echo $slide['slide_image']; ?>); <?php echo $slide['slide_image_css']; ?>">
          <div class="container">
            <div class="carousel-caption">
              <?php 
                if($slide['slide_title']){
                  echo '<h1>' . $slide['slide_title'] . '</h1>';
                }

                if($slide['slide_subtitle']){
                  echo '<h4>' . $slide['slide_subtitle'] . '</h4>';
                }

                if($slide['slide_caption']){
                  echo '<p>' . $slide['slide_caption'] . '</p>';
                }

                if($slide['slide_link']){
                  echo '<a href="' . $slide['slide_link']['url'] . '" class="btn-main btn-transparent" target="' . $slide['slide_link']['target'] . '">' . $slide['slide_link']['title'] . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="slide-overlay"></div>
        </div>
      <?php $c++; endforeach; ?>

    </div>
  </div>
<?php else: ?>
  <?php
    $hero_image = get_field('default_hero_image', 'option');
    $hero_image_css = get_field('default_hero_image_css', 'option');
    if(get_field('hero_image')){
      $hero_image = get_field('hero_image');
      if(get_field('hero_image_css')){
        $hero_image_css = get_field('hero_image_css');
      }
    }
  ?>
  <div class="hero" style="background-image:url(<?php echo $hero_image; ?>); <?php echo $hero_image_css; ?>">
    <?php 
      if(is_singular('library') || is_post_type_archive('library')){
        $library_main_page = get_page_by_path('library');
        $library_page_id = $library_main_page->ID;
        echo '<h1 class="hero-caption">' . get_field('hero_title', $library_page_id) . '</h1>';
      }
      else if(is_singular('practice_areas') || is_post_type_archive('practice_areas')){
        $practice_main_page = get_page_by_path('practice-areas');
        $practice_page_id = $practice_main_page->ID;
        echo '<h1 class="hero-caption">' . get_field('hero_title', $practice_page_id) . '</h1>';
      }
      else if(is_singular('staff') || is_post_type_archive('staff')){
        $staff_main_page = get_page_by_path('attorneys-staff');
        $staff_page_id = $staff_main_page->ID;
        echo '<h1 class="hero-caption">' . get_field('hero_title', $staff_page_id) . '</h1>';
      }
      else if(is_home() || is_archive() && !is_post_type_archive()){
        $blog_main_page = get_page_by_path('blog');
        $blog_page_id = $blog_main_page->ID;
        echo '<h1 class="hero-caption">' .get_field('hero_title', $blog_page_id) . '</h1>';
      }
      else if(get_field('hero_title')){
        echo '<h1 class="hero-caption">' . get_field('hero_title') . '</h1>';
      }
      else{
        echo '<h1 class="hero-caption">' . get_the_title() . '</h1>';
      }
    ?>
    <div class="hero-overlay"></div>
  </div>
<?php endif; ?>
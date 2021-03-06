<?php

add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'staffordlawyers_scripts', 100);
function staffordlawyers_scripts(){
  wp_register_script(
    'bootstrap-script', 
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 
    array('jquery'), 
    '', 
    true
  );

  wp_register_script(
    'slick',
    get_template_directory_uri() . '/js/slick/slick.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'staffordlawyers-scripts', 
    get_template_directory_uri() . '/js/staffordlawyers-scripts.js',
    array('jquery'), 
    '', 
    true
  ); 
  
  wp_enqueue_script('bootstrap-script');
  if(is_page('library')){
    wp_enqueue_script('slick');
  }
  wp_enqueue_script('staffordlawyers-scripts'); 
}

add_action('wp_enqueue_scripts', 'staffordlawyers_styles');
function staffordlawyers_styles(){
  wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
  wp_register_style('google-fonts', '//fonts.googleapis.com/css?family=EB+Garamond:400,700|Lato:400,700|Open+Sans:400,600,700');
  wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
  wp_register_style('slick-css', get_template_directory_uri() . '/js/slick/slick.css');
  wp_register_style('staffordlawyers', get_template_directory_uri() . '/style.css');
  
  wp_enqueue_style('bootstrap-css');
  wp_enqueue_style('google-fonts');
  wp_enqueue_style('fontawesome');
  if(is_page('library')){
    wp_enqueue_style('slick-css');
  }
  wp_enqueue_style('staffordlawyers');
}

//add meta to enqueued styles
add_filter('style_loader_tag', 'staffordlawyers_add_css_meta', 10, 2);
function staffordlawyers_add_css_meta($link, $handle){
  if($handle == 'fontawesome'){
    $link = str_replace('/>', ' integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous " />', $link);
  }
  return $link;
}

add_theme_support('post-thumbnails');
add_theme_support('custom-logo');

register_nav_menu( 'header-nav', 'Header Navigation' );
register_nav_menu('footer-nav', 'Footer Navigation');
/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
                                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
        
        //$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */

			 $item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '&nbsp;<span class="' . esc_attr( $item->attr_title ) . '"></span>';
			}

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

function staffordlawyers_header_fallback_menu(){ ?>
  <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav nav-justified">
      <li <?php if(is_front_page()){ echo ' class="active"'; } ?>><a href="<?php echo home_url(); ?>">Home</a></li>
      <li <?php if(is_page('practice')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('practice'); ?>">Practice</a></li>
      <li <?Php if(is_page('firm-profile')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('firm-profile'); ?>">Firm Profile</a></li>
      <li <?php if(is_page('attorneys-staff')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('attorneys-staff'); ?>">Attorneys & Staff</a></li>
      <li <?php if(is_page('library')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('library'); ?>">Library</a></li>
      <li <?php if(is_page('testimonials')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('testimonials'); ?>">Testimonials</a></li>
      <li <?php if(is_page('faqs')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('faqs'); ?>">FAQs</a></li>
      <li <?php if(is_page('resources')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('resources'); ?>">Resources</a></li>
      <li <?php if(is_home()){ ' class="active"'; } ?>><a href="<?php echo home_url('blog'); ?>">Blog</a></li>
      <li <?php if(is_page('contact-us')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('contact-us'); ?>">Contact Us</a></li>
    </ul>
  </div>
<?php }

function staffordlawyers_footer_fallback_menu(){ ?>
  <nav id="footer-nav">
    <ul class="footer-menu list-unstyled">
      <li><a href="<?php echo home_url(); ?>">Home</a></li>
      <li><a href="<?php echo home_url('practice'); ?>">Practice</a></li>
      <li><a href="<?php echo home_url('firm-profile'); ?>">Firm Profile</a></li>
      <li><a href="<?php echo home_url('attorneys-staff'); ?>"">Attorneys & Staff</a></li>
      <li><a href="<?php echo home_url('library'); ?>">Library</a></li>
      <li><a href="<?php echo home_url('testimonials'); ?>">Testimonials</a></li>
      <li><a href="<?php echo home_url('faqs'); ?>">FAQs</a></li>
      <li><a href="<?php echo home_url('resources'); ?>">Resources</a></li>
      <li><a href="<?php echo home_url('blog'); ?>">Blog</a></li>
      <li><a href="<?php echo home_url('contact-us'); ?>">Contact Us</a></li>
    </ul>
  </nav>
<?php }

add_action('init', 'staffordlawyers_create_post_types');
function staffordlawyers_create_post_types(){
  $staff_labels = array(
    'name' => 'Staff',
    'singular_name' => 'Staff',
    'menu_name' => 'Staff',
    'add_new_item' => 'Add New Staff Member',
    'search_items' => 'Search Staff',
    'edit_item' => 'Edit Staff Member',
    'view_item' => 'View Staff Member',
    'all_items' => 'All Staff',
    'new_item' => 'New Staff Member',
    'not_found' => 'No Staff Members Found'
  );
  $staff_args = array(
    'labels' => $staff_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-businessman',
    'query_var' => 'staff',
    'has_archive' => true,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'thumbnail',
      'revisions',
      'excerpt'
    )
  );
  register_post_type('staff', $staff_args);

  register_taxonomy('positions',
    'staff',
    array(
      'hierarchical' => true,
      'show_admin_column' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Positions',
        'singular_name' => 'Position'
      )
    )
  );

  $library_labels = array(
    'name' => 'Library',
    'singular_name' => 'Library',
    'menu_name' => 'Library',
    'add_new_item' => 'Add New Library Article',
    'search_items' => 'Search Library',
    'edit_item' => 'Edit Library Article',
    'view_item' => 'View Library Article',
    'all_items' => 'All Library Articles',
    'new_item' => 'New Library Article',
    'not_found' => 'No Library Articles Found'
  );
  $library_args = array(
    'labels' => $library_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-book-alt',
    'query_var' => 'library',
    //'has_archive' => true,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'thumbnail',
      'revisions',
      'excerpt',
      'author'
    )
  );
  register_post_type('library', $library_args);

  register_taxonomy('article_category',
    'library',
    array(
      'hierarchical' => true,
      'show_admin_column' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Article Categories',
        'singular_name' => 'Article Category'
      )
    )
  );

  $practice_areas_labels = array(
    'name' => 'Practice Areas',
    'singular_name' => 'Practice Area',
    'menu_name' => 'Practice Areas',
    'add_new_item' => 'Add New Practice Area',
    'search_items' => 'Search Practice Areas',
    'edit_item' => 'Edit Practice Area',
    'view_item' => 'View Practice Area',
    'all_items' => 'All Practice Areas',
    'new_item' => 'New Practice Area',
    'not_found' => 'Practice Area Not Found'
  );
  $practice_areas_args = array(
    'labels' => $practice_areas_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 7,
    'menu_icon' => 'dashicons-heart',
    'query_var' => 'practice_areas',
    'has_archive' => true,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'thumbnail',
      'revisions',
      'excerpt'
    )
  );
  register_post_type('practice_areas', $practice_areas_args);

  register_taxonomy('library_article_types',
    'practice_ares',
    array(
      'hierarchical',
      'show_admin_column' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Library Article Types',
        'singular_name' => 'Library Article'
      )
    )
  );
}

if(function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title' => 'General Settings',
    'menu_title' => 'General Settings',
    'menu_slug' => 'general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));
}
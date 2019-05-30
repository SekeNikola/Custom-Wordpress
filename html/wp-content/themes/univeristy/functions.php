<?php

// Page Banner
function pageBanner($args = NULL) {

  if (!$args['title']) {
    $args['title'] = get_the_title();
  }

  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!$args['photo']) {
    if (get_field('page_banner_background_image')) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php }


function univeristy_files(){
  // true in script means that it will load at the end of the body
  // Avoid cashing during development, Insted NULL, '1.0',  write NULL, microtime(),
  wp_enqueue_script('main-univerity-js', get_theme_file_uri('./js/scripts-bundled.js'), NULL, microtime(), true);
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDjY02obEsV4JgCIaBzcy1yqS4ulCTG8rs', NULL, '1.0', true);
  wp_enqueue_style('custom-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('univeristy_main_style', get_stylesheet_uri(), NULL, microtime());
  wp_localize_script('main-univerity-js', 'univeristyData', array(
    'root_url'=> get_site_url()
  ));
};

add_action('wp_enqueue_scripts', 'univeristy_files');

function univeristy_features(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  // TRUE at the and is should WP crop the image
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
  // Adding menu to wordpress admin
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
};
  add_action('after_setup_theme', 'univeristy_features');


  function univeristy_adjust_queries($query){
    $today = date('Ymd');

    if(!is_admin() and is_post_type_archive('campus') and $query-> is_main_query()){
      $query -> set('posts_per_page', -1);
    }

    if(!is_admin() and is_post_type_archive('program') and $query-> is_main_query()){
      $query -> set('orderby', 'title');
      $query -> set('order', 'ASC');
      $query -> set('posts_per_page', -1);
    }

    // if(only apply on the front end not on dashboard)
    if(!is_admin() and is_post_type_archive('event') and $query-> is_main_query()){
      $query -> set('meta_key', 'event_date');
      $query -> set('orderby', 'meta_value_num');
      $query -> set('order', 'ASC');
      $query -> set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
        ));
    }
  }
  add_action('pre_get_posts', 'univeristy_adjust_queries');

  function universityMapKey($api){
    $api['key'] = 'AIzaSyDjY02obEsV4JgCIaBzcy1yqS4ulCTG8rs';
    return $api;
  }
  add_filter('acf/fields/google_map/api', 'universityMapKey');
  ?>
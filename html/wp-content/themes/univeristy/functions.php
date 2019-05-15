<?php
function univeristy_files(){
  // true in script means that it will load at the end of the body
  // Avoid cashing during development, Insted NULL, '1.0',  write NULL, microtime(),
  wp_enqueue_script('slider', get_theme_file_uri('./js/scripts-bundled.js'), NULL, microtime(), true);
  wp_enqueue_style('custom-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('univeristy_main_style', get_stylesheet_uri(), NULL, microtime());
};
add_action('wp_enqueue_scripts', 'univeristy_files');

function univeristy_features(){
  add_theme_support('title-tag');
  // Adding menu to wordpress admin
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
};
  add_action('after_setup_theme', 'univeristy_features');


  function univeristy_adjust_queries($query){
    $today = date('Ymd');
    // if(only apply on the front end not on dashboard)
    if(!is_admin() and is_post_type_archive() and $query-> is_main_query()){
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
  add_action('pre_get_posts', 'univeristy_adjust_queries')
?>
<?php 
function univeristy_files(){
  // true in script means that it will load at the end of the body
  // Avoid cashing during development, Insted NULL, '1.0',  write NULL, microtime(), 
  wp_enqueue_script('slider', get_theme_file_uri('./js/scripts-bundled.js'), NULL, microtime(), true);
  wp_enqueue_style('custom-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('univeristy_main_style', get_stylesheet_uri(), NULL, microtime());
};
add_action('wp_enqueue_scripts', 'univeristy_files')
?>
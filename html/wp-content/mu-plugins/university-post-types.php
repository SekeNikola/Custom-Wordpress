<?php
function university_post_types()
{
  // Events Post Type
  register_post_type('event', array(
    'supports' => array('title', 'editor', 'excerpt'),
    'capability_type' => 'event',
    'map_meta_cap' => true,
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-calendar',
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
  ));
  // Program Post Type
  register_post_type('program', array(
    'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-awards',
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
  ));

  // Professors Post Type
  register_post_type('professor', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor','thumbnail'),
    'public' => true,
    'menu_icon' => 'dashicons-welcome-learn-more',
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
  ));

  // Campust Post Type
  register_post_type('campus', array(
    'capability_type' => 'campus',
    'map_meta_cap' => true,
    'supports' => array('title', 'editor','thumbnail'),
    'rewrite' => array('slug' => 'campuses'),
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-location-alt',
    'labels' => array(
      'name' => 'Campus',
      'add_new_item' => 'Add New Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus'
    ),
  ));
}
add_action('init', 'university_post_types');
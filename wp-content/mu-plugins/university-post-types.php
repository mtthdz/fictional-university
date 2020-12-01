<?php

function university_post_types() {


  // event post type
  register_post_type('event', array(
    // we need to add rest api as the new block editor uses js; without this, we'd have the classic block editor
    'show_in_rest' => true, 
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));


  // program post type
  register_post_type('program', array(
    // we need to add rest api as the new block editor uses js; without this, we'd have the classic block editor
    'show_in_rest' => true, 
    'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Programs'
    ),
    'menu_icon' => 'dashicons-awards'
  ));  


  // professor post type
  register_post_type('professor', array(
    // we need to add rest api as the new block editor uses js; without this, we'd have the classic block editor
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ));    
}

add_action('init', 'university_post_types');
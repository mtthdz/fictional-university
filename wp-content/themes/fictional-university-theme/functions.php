<?php 

// css and js import fn
function university_files() {
  // file name, file location, dependencies, version, load at end of markup
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

function university_features() {
  // how to add menu options to wordpress admin
  // register_nav_menu('headerMenuLocation', 'header Menu Location');
  add_theme_support('title-tag');
}

// parameters: first when to call the fn, and then the fn
// we dont use () for university_files because we're not running it here and now
// php will handle the fn run
add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme', 'university_features');

?>
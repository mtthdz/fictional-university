<?php 

// css and js import fn
function university_files() {
  // file name, file location, dependencies, version, load at end of markup
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  
  // for webpack
  if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
    wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
  } else {
    wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.bc49dbb23afb98cfc0f7.js'), NULL, '1.0', true);
    wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.bc49dbb23afb98cfc0f7.css'));
  }

  
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
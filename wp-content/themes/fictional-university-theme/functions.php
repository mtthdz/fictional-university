<?php 

// css and js import fn
function university_files() {
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

// parameters: first when to call the fn, and then the fn
// we dont use () for university_files because we're not running it here and now
// php will handle the fn run
add_action('wp_enqueue_scripts', 'university_files');

?>
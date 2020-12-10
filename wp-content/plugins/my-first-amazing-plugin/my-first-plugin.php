<?php
/*
Plugin Name: My First Plugin
Description: Nice.
*/

function amazingContentEdits($content) {
  $content = $content . '<p>All content belongs to Fictional University.</p>';
  return $content;
}

add_filter('the_content', 'amazingContentEdits');
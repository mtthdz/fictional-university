<?php
/*
Plugin Name: My First Plugin
Description: Adds footer note to all posts
*/

function amazingContentEdits($content) {
  $content = $content . '<p>All content belongs to Fictional University.</p>';
  $content = str_replace('Lorem', '****', $content);
  return $content;
}

add_filter('the_content', 'amazingContentEdits');
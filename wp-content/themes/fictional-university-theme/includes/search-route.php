<?php 

function universityRegisterSearch() {
  // 3 args: namespace (i.e. /wp/v2/), route, and an array 
  register_rest_route('university/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // safer to use than just 'GET'
    'callback' => 'universitySearchResults'
  ));
}

function universitySearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'professor', 'program', 'event'),
    // s is for search
    // $data is what the user is looking up in the search bar
    's' => sanitize_text_field($data['term'])
  ));

  $results = array(
    'generalInfo' => array(),
    'professors' => array(),
    'programs' => array(),
    'events' => array()
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();
    
    if(get_post_type() == 'post' OR get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type(),
        'authorName' => get_the_author()
      ));
    } else if(get_post_type() == 'professor') {
      array_push($results['professors'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    } else if(get_post_type() == 'program') {
      array_push($results['programs'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    } else if(get_post_type() == 'event') {
      array_push($results['events'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }
  }

  return $results;
}

add_action('rest_api_init', 'universityRegisterSearch');

?>
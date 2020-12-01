<?php 

function universityRegisterSearch() {
  // 3 args: namespace (i.e. /wp/v2/), route, and an array 
  register_rest_route('university/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // safer to use than just 'GET'
    'callback' => 'universitySearchResults'
  ));
}

function universitySearchResults($data) {
  $professors = new WP_Query(array(
    'post_type' => 'professor',
    // s is for search
    // $data is what the user is looking up in the search bar
    's' => $data['term'] 
  ));

  $professorResults = array();

  while($professors->have_posts()) {
    $professors->the_post();
    array_push($professorResults, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink()
    ));
  }

  return $professorResults;
}

add_action('rest_api_init', 'universityRegisterSearch');

?>
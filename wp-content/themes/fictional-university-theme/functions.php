<?php 

// how to add in php module
require get_theme_file_path('/includes/search-route.php');

// setting parameter to null will make it optionalp
function pageBanner($args = NULL) {
  if(!$args['title']) {
    $args['title'] = get_the_title();
  }

  if(!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if(!$args['photo']) {
    if(get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
  ?>

  <div class="page-banner">
      <div 
        class="page-banner__bg-image" 
        style="background-image: url(<?php echo $args['photo']; ?>);">
      </div>

      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>

        <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
        </div>
      </div>  
  </div>
  <?php 
}

// css and js import fn
function university_files() {
  // file name, file location, dependencies, version, load at end of markup
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  
  // for webpack
  if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
    wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
  } else {
    wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.9678b4003190d41dd438.js'), NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.96051b88f6f73a92c4c0.js'), NULL, '1.0', true);
    wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.96051b88f6f73a92c4c0.css'));
  }

  // for REST API call
  // three params: name/handle of file, a name, and an array ofdata
  wp_localize_script('main-university-js', 'universityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}

function university_features() {
  // how to add menu options to wordpress admin
  // register_nav_menu('headerMenuLocation', 'header Menu Location');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}

function university_adjust_queries($query) {
  if(!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // the third conditional will make sure we're not messing with a custom query
  if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      ))
    );
  }
}

// how to add custom field for REST API
function university_custom_rest() {
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author();}
  ));
}


// redirect subscriber accounts out of admin and onto homepage
function redirectSubsToFrontend() {
  $ourCurrentUser = wp_get_current_user();
  
  if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

// remove admin bar for subscriber accounts
function noSubsAdminBar() {
  $ourCurrentUser = wp_get_current_user();
  
  if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// change login logo link to site, from wordpress.org
function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

// we need to manually run css on the login page
function ourLoginCSS() {
  wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.96051b88f6f73a92c4c0.css'));
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

function ourLoginTitle() {
  return get_bloginfo('name');
}


// parameters: first when to call the fn, and then the fn
// we dont use () for university_files because we're not running it here and now
// php will handle the fn run
add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme', 'university_features');
add_action('pre_get_posts', 'university_adjust_queries');
add_action('rest_api_init', 'university_custom_rest');
add_action('admin_init', 'redirectSubsToFrontend');
add_action('wp_loaded', 'noSubsAdminBar');
add_filter('login_headerurl', 'ourHeaderUrl');
add_action('login_enqueue_scripts', 'ourLoginCSS');
add_filter('login_headertitle', 'ourLoginTitle');
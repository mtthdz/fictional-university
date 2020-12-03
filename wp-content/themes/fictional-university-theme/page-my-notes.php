<!-- this is a page, not a post -->

<?php 

  if(!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/')));
    exit;
  }

  get_header();

  // wordpress specific parameter
  while(have_posts()) {
    // wordpress specific function to get all info of the next post
    the_post(); 
    pageBanner();
    ?>

    <div class="container container--narrow page-section">
    custom code will go here
    </div>

  <?php }

  get_footer();
?>
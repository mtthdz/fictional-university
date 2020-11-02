<!-- single.php is only for individual posts, not pages -->
<!-- page.php is for individual pages -->

<?php 

  get_header();

  // wordpress specific parameter
  while(have_posts()) {
    // wordpress specific function to get all info of the next post
    the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
  <?php }

  get_footer();
?>
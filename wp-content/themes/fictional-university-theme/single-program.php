<!-- wordpress will look for this file when we create custom post types -->

<?php 

  get_header();

  // wordpress specific parameter
  while(have_posts()) {
    // wordpress specific function to get all info of the next post
    the_post(); ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>Come back to this</p>
        </div>
      </div>  
    </div>   

    <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
            <i class="fa fa-home" aria-hidden="true"></i> All Programs
          </a>
          <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>

      <div class="generic-content"><?php the_content(); ?></div>

      <?php
      // professors query
        $relatedProfessors = new WP_Query(array(
          // setting -1 will load ALL posts
          'posts_per_page' => -1,
          'post_type' => 'professor',
          'orderby' => 'title',
          'order' => 'ASC', // or DESC for descending
          'meta_query' => array(
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if($relatedProfessors->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';

          echo '<ul class="professor-cards">';
          while($relatedProfessors->have_posts()) {
            // get all event posts loaded 
            $relatedProfessors->the_post();?>
            <li class="professor-card__list-item">
              <a class="professor-card" href="<?php the_permalink(); ?>">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="">
                <span class="professor-card__name"><?php the_title(); ?></span>
              </a>
            </li>
          <?php }          
          echo '</ul>';
        }
        // we need this fn to reset the global post object, ie. the get_the_ID() fn
        // we need to reset as we change the global post object when using the ID function for the professors query
        // resetting the global post object will change the ID back to the page ID
        wp_reset_postdata();
        
        // events query
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
          // setting -1 will load ALL posts
          'posts_per_page' => 2,
          'post_type' => 'event',
          'meta_key' => 'event_date',
          // you need to declare meta_key to use meta_value
          'orderby' => 'meta_value_num',
          'order' => 'ASC', // or DESC for descending
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            ),
            array(
              'key' => 'related_programs',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            )
          )
        ));

        if($homepageEvents->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

          while($homepageEvents->have_posts()) {
            // get all event posts loaded 
            $homepageEvents->the_post();?>
            <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month">
                  <?php
                    // the event_date param is from our custom fields plugin
                    $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('M');
                  ?>
                </span>
                <span class="event-summary__day">
                  <?php
                    // the event_date param is from our custom fields plugin
                    $eventDate = new DateTime(get_field('event_date'));
                    echo $eventDate->format('d');
                  ?>                  
                </span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p>
                  <?php
                    if(has_excerpt()) {
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 18);
                    }
                  ?> 
                  <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
                </p>
              </div>
            </div>
          <?php }          
        }
      ?>
    </div>

  <?php }

  get_footer();
?>
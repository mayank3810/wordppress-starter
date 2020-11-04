<?php get_header();

while(have_posts()){
    the_post();
    pageBanner();
    ?>
  <div class="container container--narrow page-section">
 
  <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" 
            aria-hidden="true"></i> All Campuses </a> <span class="metabox__main">
           <?php the_title(); ?> </span></p>
          </div>

  <div class="generic-content"><?php the_content(); ?></div>
<?php
 // custom query for related proffesor
$relatedPrograms = new WP_Query(array(
  'posts_per_page' => -1,     // -1 will return all pages that match the arguments below
  'post_type' => 'program',
  'orderby' => 'title', //default date
  'order' => 'ASC' ,        //default desc
  'meta_query' => array(   //to filter out past posts
    array(
        'key' => 'related_campus',
        'compare' => 'LIKE',        // to print related program
        'value' => '"' . get_the_ID() . '"',
    )
  ),
));
//Custom Query End
    if($relatedPrograms -> have_posts()) {

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Program avaliable at this campus</h2>';
        echo '<ul class="min-list link-list">';
        while($relatedPrograms -> have_posts()){
          $relatedPrograms -> the_post(); ?>
          <li>
          <a href="<?php the_permalink() ?>"><?php the_title(); ?>
          </a>
          </li>
           
       <?php }
       echo '</ul>';
    }

    wp_reset_postdata(); //always use this when using multiple custom query on one page
              ?>

  </div>
    <?php
}
get_footer();
?>
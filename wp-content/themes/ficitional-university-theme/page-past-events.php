<?php
get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events'
));
?>

  <?php 
  //old method in which we create if statements for each conditions
//   if(is_category()){
//       single_cat_title();
//   }
//   if (is_author()){
//         echo "Posts By " ;the_author();
//   }?>



<div class="container container--narrow page-section">
<?php

$today = date('Ymd');
        $pastEvents = new WP_Query(array(
          'paged' => get_query_var('paged', 1), //for pagination to work
          'post_type' => 'event',
          'meta_key' => 'event_date' ,
          'orderby' => 'meta_value_num', //default date
          'order' => 'ASC' ,        //default desc
          'meta_query' => array(   //to filter out past posts
            array(
              'key' => 'event_date',
              'compare' => '<' ,
              'value' => $today,
              'type' => 'numeric',
            )
          ),
        ));

while($pastEvents -> have_posts()) {
    $pastEvents -> the_post();
    get_template_part('template-parts/content-event');

 }
/// Made pagination work
  echo paginate_links(array(
      'total' => $pastEvents -> max_num_pages,
  ));
?>

</div>

<?php get_footer();
?>
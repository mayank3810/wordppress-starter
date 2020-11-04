<?php
get_header();
pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => 'We have several campuses choose one with your ease'
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
<ul class="link-list min-list">
<?php 
while(have_posts()) {
  the_post(); ?>

  <li><a href="<?php the_permalink() ?>"><?php the_title(); 
  $mapLocation = get_field('map_location');
  print_r($mapLocation);
  echo $mapLocation['lng']; ?></a></li>

<?php }
  echo paginate_links();
?>

</ul>
</div>

<?php get_footer();
?>
<?php
get_header();
pageBanner(array(
  'title' => 'All Programs',
  'subtitle' => 'There Is Something for every one have a look around'
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

  <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

<?php }
  echo paginate_links();
?>

</ul>
</div>

<?php get_footer();
?>
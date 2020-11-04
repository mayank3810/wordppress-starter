<?php
get_header();
pageBanner(array(
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description(),
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
while(have_posts()) {
  the_post(); ?>
  <div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    <div class="metabox">
    <p>Posted By <?php the_author_posts_link(); ?>  <?php the_time('n-j-y'); ?> in <?php echo get_the_category_list(', '); ?></p>
    </div>
      
    <div class="generic-content">
      <?php the_excerpt(); ?> 
      <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a>
    </div>
  </div>
<?php }
  echo paginate_links();
?>

</div>

<?php get_footer();
?>
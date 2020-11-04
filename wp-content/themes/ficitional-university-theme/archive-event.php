<?php
get_header();
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See Whats Going On In Our World'
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
  the_post(); 
  get_template_part('template-parts/content-event');
}
  echo paginate_links();
?>
<hr class="section-break">
<p> Looking for Our Past Checkout this? <a href="<?php echo site_url('/past-events')?>">Click Here</a></p>

</div>

<?php get_footer();
?>
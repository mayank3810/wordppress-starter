<?php get_header();

while (have_posts()) {
  the_post();
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg')?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title();?></h1>
      <div class="page-banner__intro">
        <p>Learn how the school of your dreams got started.</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

    <?php
    $isChild = wp_get_post_parent_id(get_the_ID());
     if($isChild){
       ?>


    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href=<?php the_permalink($isChild);?>><i class="fa fa-home" aria-hidden="true">
      </i> Back to <?php echo get_the_title($isChild);?></a>
         <span class="metabox__main"><?php the_title();?></span></p>
    </div>
    <?php
  }?>
<?php
$childPage= get_pages(array(
  'child_of' => get_the_ID()
));
if($isChild or $childPage){
?>



    <div class="page-links">
      <h2 class="page-links__title"><a href=<?php the_permalink($isChild);?>><?php echo get_the_title($isChild);?></a></h2>
      <ul class="min-list">
        <?php
        if($isChild){
          $findChildOf = $isChild;
        }
        else {
          $findChildOf = get_the_ID();
        }

          wp_list_pages(array(
          'title_li' => NULL,
          'child_of' => $findChildOf,
          'sort_column' => 'menu_order'
        ));?>
      </ul>
    </div>
<?php  }?>
    <div class="generic-content">
      <?php the_content();?>
    </div>

    <?php

}
get_footer();
?>

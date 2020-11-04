<?php

require get_theme_file_path('/inc/search-route.php');

// we can create as many register rest field to return differnt properties that we can achive usiing php
function university_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {return get_the_author();}
    ));
}

add_action('rest_api_init', 'university_custom_rest');

//Load Without Automatic reloade
// function University_Files(){
//     wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0' , true);
//     wp_enqueue_style('GoogleFont' , '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
//     wp_enqueue_style('FontAwesom' , '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
//     wp_enqueue_style('University_main_stylesheet' , get_stylesheet_uri());

// }

function pageBanner($args = NULL) {
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!$args['photo']) {
        if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes'] ['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>
    <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 
    echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
  </div>

<?php }

function University_Files(){
    wp_enqueue_style('GoogleFont' , '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('FontAwesom' , '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    // wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0' , true);
    if(strstr($_SERVER['SERVER_NAME'] , 'localhost')){
        wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0' , true);
    } else {
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/vendors~scripts.a6d527facd974cdcaf68.js'), NULL, '1.0' , true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.cf42f053cf8fe3f127cd.js'));
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/styles.cf42f053cf8fe3f127cd.css'));
    }

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url()
    ));
    

}

add_action('wp_enqueue_scripts', 'University_Files');

function university_features(){
    register_nav_menu('headerMenuLocation' , 'Header Menu Location');
    register_nav_menu('footerLocationOne' , 'Footer Location One');
    register_nav_menu('footerLocationTwo' , 'Footer Location Two');
    add_theme_support('title-tag'); //adds custom title for each page
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape' , '400' , '260' , true);
    add_image_size('professorPortrait' , '480' , '650' , true);
    add_image_size('pageBanner' , '1500' , '350' , true);
}
add_action('after_setup_theme', 'university_features');

function university_adjust_queries($query) {

    if (!is_admin() AND is_post_type_archive('campus') AND is_main_query()) {
        $query -> set('posts_per_page' , -1);
    }

    if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
        $query -> set('order_by' , 'title');
        $query -> set('order' , 'DESC');
        $query -> set('posts_per_page' , -1);
    }
    
    if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
        $today = date('Ymd');
        $query -> set('meta_key' , 'event_date');
        $query -> set('order_by' , 'meta_value_num');
        $query -> set('order' , 'DESC');
        $query -> set('meta_query' , array(
            'key' => 'event_date',
            'compare' => '>=' ,
            'value' => $today,
            'type' => 'numeric',
          ));  
    }
}

add_action('pre_get_posts', 'university_adjust_queries');

?>

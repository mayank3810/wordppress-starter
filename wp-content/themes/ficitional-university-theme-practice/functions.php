<?php

function University_Files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0' , true);
    wp_enqueue_style('GoogleFont' , '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('FontAwesom' , '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('University_main_stylesheet' , get_stylesheet_uri());

}

add_action('wp_enqueue_scripts', 'University_Files');

function university_features(){
    add_theme_support('title-tag'); //adds custom title for each page
}
add_action('after_setup_theme', 'university_features');
?>
<?php

function educrat_child_enqueue_styles() {
	wp_enqueue_style( 'educrat-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'educrat_child_enqueue_styles', 100 );

//registering bootstrap
function mytheme_enqueue_style()
{
	wp_enqueue_style('style', get_template_directory_uri() . '/custom-style.css');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_style');

//registering custom-styles
function wpbootstrap_enqueue_styles()
{
	wp_enqueue_style('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
	wp_enqueue_style('my-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');


//custom-templates
// require get_template_directory() . '/custom/course.php';

?>
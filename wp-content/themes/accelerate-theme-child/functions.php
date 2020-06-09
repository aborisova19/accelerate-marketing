<?php
/**
* Accelerate Marketing Child functions and definitions
*
* @link http://codex.wordpress.org/Theme_Development
* @link http://codex.wordpress.org/Child_Themes
*
* @package WordPress
* @subpackage Accelerate Marketing
* @since Accelerate Marketing 2.0
*/

// Enqueue scripts and styles
function accelerate_child_scripts(){
	wp_enqueue_style( 'accelerate-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'accelerate-style' ));
    wp_enqueue_style('accelerate-child-google-fonts', '//fonts.googleapis.com/css2?family=Londrina+Solid:wght@400;900&display=swap');
} 
add_action( 'wp_enqueue_scripts', 'accelerate_child_scripts' );

// Add burger menu on mobile
function burger_menu_scripts() {
    wp_enqueue_script( 'burger-menu-script', get_stylesheet_directory_uri() . '/scripts/burger-menu-script.js', array( 'jquery' ) );  
}
add_action( 'wp_enqueue_scripts', 'burger_menu_scripts' );


// Add custom post types
function create_custom_post_types() {
    register_post_type( 'case_studies',
        array(
            'labels' => array(
                'name' => __( 'Case Studies' ),
                'singular_name' => __( 'Case Study' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'case-studies' ),
        )
    );

    register_post_type( 'about_pages',
        array(
            'labels' => array(
                'name' => __( 'About pages' ),
                'singular_name' => __( 'About page' )
            ),
            'public' => true,
            'rewrite' => array( 'slug' => 'services' ),
        )
    );
}
add_action( 'init', 'create_custom_post_types' );


add_filter( 'body_class','accelerate_child_body_classes' );
function accelerate_child_body_classes( $classes ) {
 if (is_page('contact-us') ) {
   $classes[] = 'contact';
 }
    
   return $classes;
     
}

function accelerate_theme_child_widget_init() {
	
	register_sidebar( array(
	    'name' =>__( 'Homepage sidebar', 'accelerate-theme-child'),
	    'id' => 'sidebar-2',
	    'description' => __( 'Appears on the static front page template', 'accelerate-theme-child' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'accelerate_theme_child_widget_init' );


add_action( 'pre_get_posts', function( $query ) {

    // Check that it is the query we want to change: front-end search query
    if( $query->is_main_query() && ! is_admin() && $query->is_search() ) {

        // Change the query parameters
        $query->set( 'posts_per_page', 10 );

    }

} );

function wpgood_nav_search( $items, $args ) {
    $items .= '<li>' . get_search_form( false ) . '</li>';
    return $items;
    }
    add_filter( 'wp_nav_menu_items','wpgood_nav_search', 10, 2 );
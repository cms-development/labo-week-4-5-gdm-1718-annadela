<?php
  wp_enqueue_scripts();
  wp_enqueue_style('style', get_stylesheet_uri());

//dynamisch logo
function themename_custom_logo_setup() {
 $defaults = array(
 'height'      => 100,
 'width'       => 400,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

//dynamisch menu
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
     )
   );
}
add_action( 'init', 'register_my_menus' );

//widgets
function themename_widgets_init() {
  register_sidebar( array(
      'name'          => __( 'Primary Sidebar', 'theme_name' ),
      'id'            => 'sidebar-1',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
	) );
	register_sidebar( array(
			'name'          => __( 'Footer Primary Sidebar', 'theme_name' ),
			'id'            => 'sidebar-2 ',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Second Sidebar', 'theme_name' ),
		'id'            => 'sidebar-3 ',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
) );
}
add_action('widgets_init', 'themename_widgets_init');

//post-type creatures
// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Creatures', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Creature', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Creatures', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Creature', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'creatures', $args );

}
add_action( 'init', 'custom_post_type', 0 );

// // for react
// function  sections_endpoint( $request_data ) {
// 	$args = array(
// 			'post_type' => 'creatures',
// 			'posts_per_page'=>-1, 
// 			'numberposts'=>-1
// 	);
// 	$posts = get_posts($args);
// 	foreach ($posts as $key => $post) {
// 			$posts[$key]->acf = get_fields($post->id);
// 	}
// 	return  $posts;
// }
// // add_action( 'rest_api_init', function () {
// // 	register_rest_route( 'sections/v1', '/creatures/', array(
// // 			'methods' => 'GET',
// // 			'callback' => 'sections_endpoint'
// // 	));
// // });

// add_action( 'rest_api_init', function () {
// 	register_rest_route( 'sections/v1', '/creatures/', array(
// 			'methods' => 'POST',
// 			'callback' => 'sections_endpoint'
// 	));
// });


function create() {
	$exlude = ['acf-field-group', 'acf-field'];
	$include = ["page"];
	$post_types = array_diff(get_post_types(["_builtin" => false], 'names'), $exlude);

	array_push($post_types, $include);

	foreach ($post_types as $post_type) {
		register_rest_field($post_type, 'acf', [
			'get_callback' => 'expose_AFC_fields',
			'schama' => null,
		]);
	}
}

function expose_AFC_fields($object) {
	$ID = $object['id'];
	return get_fields($ID);
}

add_action('rest_api_init', 'create');
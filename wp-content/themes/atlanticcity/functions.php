<?php
/* Theme Support */
add_theme_support('html-5');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('title-tag');
add_theme_support( 'woocommerce' );
add_filter('show_admin_bar', '__return_false');

/* functions update 12/7/2023 */

/* Register custom post types and custom taxonomies */
/*require_once 'inc/register-taxonomy-game.php';*/

/* Bootstrap Nav Walker */
/*require_once 'inc/bootstrap-nav-walker.php';*/

/* Register Widgets */
/*require_once 'inc/register-button-widget.php';*/

/* Register menus */
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
		)
	);
}
add_action('init', 'register_my_menus');
add_filter( 'big_image_size_threshold', '__return_false' );
/* Hide posts from menu */
function hide_post_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'hide_post_menu');

/* Load assets */
function load_assets($entries) {
	$assets = file_get_contents(get_stylesheet_directory() . '/assets.json');
	$assets = json_decode($assets);
	foreach ( $assets as $chunk => $files ) {
		foreach ($entries as $entry) {
			if ( $chunk == $entry ) {
				foreach ($files as $type => $asset) {
					switch ($type) {
						case 'js':
							wp_enqueue_script($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset, array(), false, true);
							break;
						case 'css':
							wp_enqueue_style($chunk, get_stylesheet_directory_uri() . '/dist/' . $asset);
					}
				}
			}
		}
	}
}


/* Register sidebar */
register_sidebar(array(
	'name' => 'sidebar',
	'id' => 'my-sidebar',
	'before_widget' => '<div id="%1$s" class="col-12 col-md mb-3 mb-md-0 widget %2$s">',
	'after_widget'  => '</div>',
));

/* Remove prefix */
function remove_archive_prefix($title) {
    return preg_replace('/^\w+: /', '', $title);
}
add_filter('get_the_archive_title', 'remove_archive_prefix');

/* Excerpt size */
function tn_custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'tn_custom_excerpt_length', 999);

/* Reduce terms to names */
function reduce_to_names($term) {
    return $term->name;
}

/* Change posts per page */
function change_posts_per_page( $query ) {
	if (is_post_type_archive('comments-matches')) {
		$query->set('posts_per_page', '5');
	}
}
add_action('pre_get_posts', 'change_posts_per_page');

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


function wpdocs_codex_fotos_init() {
    $labels = array(
        'name'                  => _x( 'fotos', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'foto', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'fotos', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'foto', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New foto', 'textdomain' ),
        'new_item'              => __( 'New foto', 'textdomain' ),
        'edit_item'             => __( 'Edit foto', 'textdomain' ),
        'view_item'             => __( 'View foto', 'textdomain' ),
        'all_items'             => __( 'All fotos', 'textdomain' ),
        'search_items'          => __( 'Search fotos', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent fotos:', 'textdomain' ),
        'not_found'             => __( 'No fotos found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No fotos found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'foto Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'foto archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into foto', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this foto', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter fotos list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'fotos list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'fotos list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'foto' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'foto', $args );
}
 
add_action( 'init', 'wpdocs_codex_fotos_init' );

function wpdocs_codex_videos_init() {
    $labels = array(
        'name'                  => _x( 'videos', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'video', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'videos', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'video', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New video', 'textdomain' ),
        'new_item'              => __( 'New video', 'textdomain' ),
        'edit_item'             => __( 'Edit video', 'textdomain' ),
        'view_item'             => __( 'View video', 'textdomain' ),
        'all_items'             => __( 'All video', 'textdomain' ),
        'search_items'          => __( 'Search video', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent video:', 'textdomain' ),
        'not_found'             => __( 'No video found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No video found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'video Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'video archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into video', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this video', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter fotos list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'video list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'video list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'video' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'video', $args );
}
 
add_action( 'init', 'wpdocs_codex_videos_init' );

/*pagination*/
function powernature_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo '<div class="navigation">';
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.635 32.635" xml:space="preserve"><g><path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5 S32.411,16.817,32.135,16.817z"/><path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136 c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354 s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/></g></svg>','decorlux'),
        'next_text' => __('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.635 32.635" xml:space="preserve"><g><path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5 S32.411,16.817,32.135,16.817z"/><path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136 c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354 s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/></g></svg>','decorlux'),
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1
    ));
    echo '</div>';
}

add_action('wp_ajax_nopriv_send_mydata', 'send_mydata');

// Hook para usuarios logueados
add_action('wp_ajax_send_mydata', 'send_mydata');

// Función que procesa la llamada AJAX
function send_mydata(){
	global $wpdb;
    // Check parameters
	$title  = isset( $_POST['value'] ) ? $_POST['value'] : false;
	//all posts
	$mypostsTitle = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_title LIKE '%s'", '%'. $wpdb->esc_like( $title ) .'%') );	
	//$mymediasTitle = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE guid LIKE '%s'", '%'. $wpdb->esc_like( $title ) .'%') );
	$listPosts = array();
	$medias = array();
	$videos = array();
	foreach ($mypostsTitle as $post) {		
		$date = explode(" ", $post->post_date)[0];
		$newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
		$hora = explode(" ", $post->post_date)[1];
		$newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
		if ($post->post_type == "post") {	
			array_push($listPosts, array('id' => $post->ID, 'name' => $post->post_title, "link" => get_permalink($post->ID), "imagen" => get_the_post_thumbnail_url($post->ID), "category" => get_the_category( $post->ID )[0]->name, "dia" => $newdate, "hora" => $newhora));
		}	
		if ($post->post_type == "foto") {	
			array_push($medias, array('id' => $post->ID, 'name' => $post->post_title, "link" => get_permalink($post->ID), "imagen" => get_the_post_thumbnail_url($post->ID), "category" => get_the_category( $post->ID )[0]->name, "dia" => $newdate, "hora" => $newhora));
		}
		if ($post->post_type == "video") {	
			array_push($videos, array('id' => $post->ID, 'name' => $post->post_title, "link" => get_permalink($post->ID), "imagen" => get_the_post_thumbnail_url($post->ID), "category" => get_the_category( $post->ID )[0]->name, "dia" => $newdate, "hora" => $newhora));
		}		
	}
	/*foreach ($mymediasTitle as $post) {		
		if ($post->post_type == "attachment") {
			if (strpos($post->guid, ".mp4") || strpos($post->guid, ".avi")) {
				array_push($videos, array('id' => $post->ID, 'name' => $post->post_title, "link" => $post->guid));
			} else {
				array_push($medias, array('id' => $post->ID, 'name' => $post->post_title, "link" => $post->guid));
			}		
		}
	}*/
	//print_r($mypostsTitle);
	wp_send_json(array("posts" => $listPosts, "medias" => $medias, "videos" => $videos));
    //wp_send_json(  );
}


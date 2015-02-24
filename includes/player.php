<?php
class Player_Post_Type{
	const POST_TYPE = 'player';

	public static function init(){
		self::register_post_type();
		self::register_meta();

	}

	public static function register_post_type(){
		$labels = array(
			'name'                => __( 'Players', 'text-domain' ),
			'singular_name'       => __( 'Player', 'text-domain' ),
			'add_new'             => _x( 'Add New Player', 'text-domain', 'text-domain' ),
			'add_new_item'        => __( 'Add New Player', 'text-domain' ),
			'edit_item'           => __( 'Edit Player', 'text-domain' ),
			'new_item'            => __( 'New Player', 'text-domain' ),
			'view_item'           => __( 'View Player', 'text-domain' ),
			'search_items'        => __( 'Search Players', 'text-domain' ),
			'not_found'           => __( 'No Players found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Players found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent Player:', 'text-domain' ),
			'menu_name'           => __( 'Players', 'text-domain' ),
		);
		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'description'         => 'description',
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'query_var'           => 'players',
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title', 'editor', 'thumbnail',
				'excerpt', 'revisions', 'position', 'admin-box')
		);
		register_post_type( self::POST_TYPE, $args );
	}

	public static function register_meta(){
		add_metadata_group( 'position', 'Position', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'position', 'position', 'Positon', 'text', array(
 			'description' => 'The Players Position.'
		));
		add_post_type_support( 'player', 'position' );
	}
}

add_action( 'init', array( 'Player_Post_Type' , 'init') ) ;
<?php
class League_Post_Type{
	const POST_TYPE = 'league';

	public static function init(){
		self::register_post_type();
		self::register_meta();

	}

	public static function register_post_type(){
		$labels = array(
			'name'                => __( 'Leagues', 'text-domain' ),
			'singular_name'       => __( 'League', 'text-domain' ),
			'add_new'             => _x( 'Add New League', 'text-domain', 'text-domain' ),
			'add_new_item'        => __( 'Add New League', 'text-domain' ),
			'edit_item'           => __( 'Edit League', 'text-domain' ),
			'new_item'            => __( 'New League', 'text-domain' ),
			'view_item'           => __( 'View League', 'text-domain' ),
			'search_items'        => __( 'Search Leagues', 'text-domain' ),
			'not_found'           => __( 'No Leagues found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Leagues found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent League:', 'text-domain' ),
			'menu_name'           => __( 'Leagues', 'text-domain' ),
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
			'query_var'           => 'teams',
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title', 'editor', 'thumbnail',
				'excerpt', 'revisions','league-teams')
		);
		register_post_type( self::POST_TYPE, $args );
	}
	public static function register_meta(){
		add_metadata_group( 'league-teams', 'Match', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'league-teams', 'league-teams', 'All Teams In League', 'text', array(
 			'description' => 'This is a the league teams.'
		));
		add_post_type_support( 'league', 'league-teams' );
	}
}
add_action( 'init', array( 'League_Post_Type' , 'init') ) ;
<?php
class Team_Post_Type{
	const POST_TYPE = 'team';

	public static function init(){
		self::register_post_type();
		self::register_meta();

	}

	public static function register_post_type(){
		$labels = array(
			'name'                => __( 'Teams', 'text-domain' ),
			'singular_name'       => __( 'Team', 'text-domain' ),
			'add_new'             => _x( 'Add New Team', 'text-domain', 'text-domain' ),
			'add_new_item'        => __( 'Add New Team', 'text-domain' ),
			'edit_item'           => __( 'Edit Team', 'text-domain' ),
			'new_item'            => __( 'New Team', 'text-domain' ),
			'view_item'           => __( 'View Team', 'text-domain' ),
			'search_items'        => __( 'Search Teams', 'text-domain' ),
			'not_found'           => __( 'No Teams found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Teams found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent Team:', 'text-domain' ),
			'menu_name'           => __( 'Teams', 'text-domain' ),
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
				'excerpt', 'revisions','team-members', 'admin-box')
		);
		register_post_type( self::POST_TYPE, $args );
	}
	public static function register_meta(){
		add_metadata_group( 'team-members', 'Team Members', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'team-memebers', 'team-member', 'Member', 'text', array(
 			'description' => 'This is a team member.'
		));
		add_post_type_support( 'team', 'team_member' );
	}
}
add_action( 'init', array( 'Team_Post_Type' , 'init') ) ;
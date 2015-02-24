<?php
class Team_Post_Type{
	const POST_TYPE = 'team';

	public static function init(){
		self::register_post_type();
		self::register_meta();
		add_filter( 'template_include', array( __CLASS__, 'template_include' ) );
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
			'menu_name'           => __( 'Teams', 'text-domain' )
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
			'rewrite'             => array( 'slug' => 'team' ),
			'capability_type'     => 'post',
			'supports'            => array(
				'title', 'editor', 'thumbnail',
				'excerpt', 'revisions', 'position')
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
		add_post_type_support( 'position', 'position' );
	}

	public static function template_include($template){
		$path = __DIR__;
		if( is_singular(Team_Post_Type::POST_TYPE ) )
			$template = apply_filters( 'single_team', $path . '/templates/single-team.php' );
		elseif( is_archive(Team_Post_Type::POST_TYPE ) )
			$template = apply_filters( 'archive_team', $path . '/templates/archive-team.php' );

		return $template;
	}
}

add_action( 'init', array( 'Team_Post_Type' , 'init') ) ;

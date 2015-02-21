<?php
class Match_Post_Type{
	const POST_TYPE = 'match';

	public static function init(){
		self::register_post_type();
		self::register_meta();

	}

	public static function register_post_type(){
		$labels = array(
			'name'                => __( 'Matchs', 'text-domain' ),
			'singular_name'       => __( 'Match', 'text-domain' ),
			'add_new'             => _x( 'Add New Match', 'text-domain', 'text-domain' ),
			'add_new_item'        => __( 'Add New Match', 'text-domain' ),
			'edit_item'           => __( 'Edit Match', 'text-domain' ),
			'new_item'            => __( 'New Match', 'text-domain' ),
			'view_item'           => __( 'View Match', 'text-domain' ),
			'search_items'        => __( 'Search Matchs', 'text-domain' ),
			'not_found'           => __( 'No Matchs found', 'text-domain' ),
			'not_found_in_trash'  => __( 'No Matchs found in Trash', 'text-domain' ),
			'parent_item_colon'   => __( 'Parent Match:', 'text-domain' ),
			'menu_name'           => __( 'Matchs', 'text-domain' ),
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
			'query_var'           => 'matches',
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title', 'editor', 'thumbnail',
				'excerpt', 'revisions','match-up', 'result')
		);
		register_post_type( self::POST_TYPE, $args );
	}
	public static function register_meta(){
		add_metadata_group('result' , 'Result', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'result', 'home-team-score', 'Home Team Score', 'text', array(
 			'default_value' => '0',
 			'sanitize_callbacks' => array( function( $field, $old, $new, $post_id ){
 				$new = ereg_replace("[^0-9]", "", $new);
				return $new;
			} )
		));
		add_metadata_field( 'result', 'away-team-score', 'Away Team Score', 'text', array(
 			'default_value' => '0',
 			'sanitize_callbacks' => array( function( $field, $old, $new, $post_id ){
 				$new = ereg_replace("[^0-9]", "", $new);
				return $new;
			} )
		));
		add_metadata_group( 'match-up', 'Match', array(
			'capability' => 'edit_posts'
		));
		add_metadata_field( 'match-up', 'home-team', 'Home Team', 'text', array(
 			'description' => 'This is a the home team.'
		));
		add_metadata_field( 'match-up', 'away-team', 'Away Team', 'text', array(
 			'description' => 'This is a the away team.'
		));
		add_post_type_support( 'match', 'match-up' );
		add_post_type_support( 'match', 'result' );
	}
}
add_action( 'init', array( 'Match_Post_Type' , 'init') ) ;
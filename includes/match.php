<?php
class Match_Post_Type{

	const POST_TYPE = 'match';

	public static function init(){
		self::register_post_type();
		self::register_meta();
		add_filter( 'template_include', array( __CLASS__, 'template_include' ) );
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
 			'sanitize_callbacks' => array( 'voce_numeric_value' )
		));
		add_metadata_field( 'result', 'away-team-score', 'Away Team Score', 'text', array(
 			'default_value' => '0',
 			'sanitize_callbacks' => array( 'voce_numeric_value' )
		));
		add_post_type_support( 'match', 'result' );
	}

	public static function template_include($template){
		$path = __DIR__ . 'wp-content/plugins/team-press';
		if( is_singular(Match_Post_Type::POST_TYPE) ){
			$template = apply_filters( 'single_match', $path . '/templates/single-match.php' );
		} else {
			if(is_archive(Match_Post_Type::POST_TYPE)){
				$template = apply_filters( 'archive_match', $path . '/templates/archive-match.php' );
			}
		}
		return $template;
	}

	public static function display_home_score(){
		$home_team_score = Voce_Meta_API::GetInstance()->get_meta_value( get_the_id(), 'result', 'home-team-score' );
		return $home_team_score;
	}

	public static function display_away_score(){
		$away_team_score = Voce_Meta_API::GetInstance()->get_meta_value( get_the_id(), 'result', 'away-team-score' );
		return $away_team_score;
	}
}

add_action( 'init', array( 'Match_Post_Type' , 'init') ) ;
